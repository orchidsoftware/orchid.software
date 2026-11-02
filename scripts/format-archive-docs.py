#!/usr/bin/env python3
import argparse
import html
import json
from pathlib import Path
import re
import subprocess
import tempfile
import textwrap

CORRECTIONS = {
    'accomodates': 'accommodates', 'accoording': 'according', 'acessible': 'accessible',
    'cheeper': 'cheaper', 'comand': 'command', 'Commans': 'Commands',
    'complection': 'completion', 'completeley': 'completely', 'Dashbord': 'Dashboard',
    'Datatime': 'Datetime', 'directiory': 'directory', 'discribed': 'described',
    'diversed': 'diverse', 'enouhg': 'enough', 'equired': 'required',
    'Extention': 'Extension', 'firt': 'first', 'fisrt': 'first', 'highligt': 'highlight',
    'hierarcy': 'hierarchy', 'inclided': 'included', 'metod': 'method',
    'nesessary': 'necessary', 'notatin': 'notation', 'noticable': 'noticeable',
    'optios': 'options', 'recomend': 'recommend', 'recomended': 'recommended',
    'recources': 'resources', 'reqested': 'requested', 'rigths': 'rights',
    'standartization': 'standardization', 'successfull': 'successful',
    'thte': 'the', 'thw': 'the', 'titile': 'title', 'Titile': 'Title',
    'usefull': 'useful', 'useing': 'using', 'wil': 'will', 'acccess': 'access',
    'ot': 'or', 'subTitile': 'subTitle',
}


def correct_spelling(text):
    for wrong, correct in CORRECTIONS.items():
        text = re.sub(r'(?<![A-Za-z])' + wrong + r'(?![A-Za-z])', correct, text)
    return text


def normalize(text, navigation_helper=False):
    text = correct_spelling(text)
    output = []
    fence = None
    metadata = text.startswith('---\n')
    previous_heading = 1
    for index, original in enumerate(text.splitlines()):
        line = re.sub(r'^[ \t\u00a0]+', lambda m: m[0].replace('\u00a0', ' '), original.rstrip())
        if index == 0 and metadata:
            output.append(line)
            continue
        if metadata and line == '---':
            metadata = False
            output.append(line)
            continue
        delimiter = re.match(r'^\s*(`{3,}|~{3,})(.*)$', line)
        if delimiter:
            marker, language = delimiter.groups()
            if fence is None:
                fence = marker[0]
                if not language.strip():
                    line = marker + 'text'
            elif marker[0] == fence:
                fence = None
            output.append(line)
            continue
        if fence:
            output.append(line)
            continue
        if not metadata:
            if navigation_helper:
                line = line.lstrip()
            parts = re.split(r'(`+[^`]*`+)', line)
            for part_index in range(0, len(parts), 2):
                part = parts[part_index]
                part = re.sub(r'<h4\b[^>]*>(.*?)</h4>', r'## \1', part)
                part = re.sub(r'<a\b[^>]*href="([^"]+)"[^>]*>(.*?)</a>',
                              lambda m: '[' + html.unescape(m[2]) + '](' + m[1] + ')', part)
                part = re.sub(r'<li\b[^>]*>', '- ', part).replace('</li>', '')
                part = re.sub(r'</?(?:ul|p)\b[^>]*>', '', part)
                parts[part_index] = part.replace('<img>', '`<img>`')
            line = ''.join(parts)
            if re.match(r'^\s*\*\*[^*]+\*\*\s*$', line):
                line = '## ' + line.strip().strip('*')
            if line == '## Обновление зависимостей' and previous_heading == 2:
                line = '### Обновление зависимостей'
            heading = re.match(r'^(#{1,6})\s+(.*)$', line)
            if heading:
                level = min(max(2, len(heading[1])), previous_heading + 1)
                previous_heading = level
                line = '#' * level + ' ' + heading[2]
            line = re.sub(r'\[(here|More|here\.)\]\(([^)]+)\)',
                          lambda m: '[' + ('Inputmask options' if 'Inputmask' in m[2] else
                                          'Blade component documentation' if '/docs/blade' in m[2] else
                                          'Related issue' if '/issues/' in m[2] else
                                          'Documentation') + '](' + m[2] + ')', line)
        if len(line) > 115 and not line.lstrip().startswith('|'):
            prefix = re.match(r'^(\s*(?:>\s*)*(?:(?:[-+*]|\d+[.)])\s+)?)', line)[1]
            continuation = prefix if '>' in prefix else ' ' * len(prefix)
            if metadata:
                continuation = '  '
            line = textwrap.fill(line, width=115, subsequent_indent=continuation,
                                 break_long_words=False, break_on_hyphens=False,
                                 replace_whitespace=False, drop_whitespace=True)
        output.append(line)
    for index in range(1, len(output) - 1):
        if output[index] or not output[index + 1].lstrip().startswith('>'):
            continue
        previous = index - 1
        while previous >= 0 and output[previous]:
            if output[previous].lstrip().startswith('>'):
                output[index] = '>'
                break
            previous -= 1
    return '\n'.join(output).rstrip() + '\n'


def format_files(files, project):
    config = json.loads((project / '.markdownlint-cli2.jsonc').read_text())
    config['globs'] = []
    config['ignores'] = []
    with tempfile.TemporaryDirectory(prefix='orchid-markdown-') as temporary:
        configuration = Path(temporary) / 'lint.jsonc'
        configuration.write_text(json.dumps(config))
        command = ['npx', '--yes', '--cache', '/tmp/orchid-lint-npm-cache',
                   'markdownlint-cli2@0.24.0', '--config', str(configuration), '--fix']
        for _ in range(5):
            before = [path.read_text() for path in files]
            for path, text in zip(files, before):
                formatted = normalize(text, path.name == 'documentation.md')
                if formatted != text:
                    path.write_text(formatted)
            result = subprocess.run(command + [str(path.resolve()) for path in files], cwd=temporary, capture_output=True, text=True)
            print('\n'.join(line for line in result.stdout.splitlines() if not line.startswith('Finding: ')))
            if result.stderr:
                print(result.stderr, end='')
            if result.returncode not in (0, 1):
                return result.returncode
            if before == [path.read_text() for path in files]:
                return result.returncode
    raise RuntimeError('Archive formatting did not converge')


def normalize_navigation(value):
    if not isinstance(value, dict):
        return value
    result = {correct_spelling(key): normalize_navigation(child) for key, child in value.items()}
    if len(result) != len(value):
        raise ValueError('Corrected navigation labels collide')
    return result


def main():
    parser = argparse.ArgumentParser()
    parser.add_argument('--root', type=Path, default=Path(__file__).resolve().parents[1])
    parser.add_argument('--project', type=Path, default=Path(__file__).resolve().parents[1])
    parser.add_argument('--self-check', action='store_true')
    args = parser.parse_args()
    if args.self_check:
        assert '```php\n$literal = "<img>";\n```' in normalize('---\ntitle: Example\n---\n\n```php\n$literal = "<img>";\n```\n')
        assert normalize('An `<img>` tag and a `<p>` tag.') == normalize(normalize('An `<img>` tag and a `<p>` tag.'))
        assert '\n- [Guide](/en/docs/screens)' in normalize('<ul>\n    <li><a href="/en/docs/screens">Guide</a></li>\n</ul>', True)
        assert '[Guide](/en/docs/screens)' in normalize('<a href="/en/docs/screens">Guide</a>')
        assert normalize(normalize('---\ntitle: Example\n---\n\n# Heading\n\n**Reminder**\n')) == normalize('---\ntitle: Example\n---\n\n# Heading\n\n**Reminder**\n')
        print('Normalization checks passed.')
        return 0
    for version in range(2, 14):
        navigation = args.root / 'docs' / f'{version}.x' / 'navigation.json'
        if navigation.exists():
            value = normalize_navigation(json.loads(navigation.read_text()))
            navigation.write_text(json.dumps(value, ensure_ascii=False, indent=4) + '\n')
    files = sorted(path for version in range(2, 14)
                   for path in (args.root / 'docs' / f'{version}.x').rglob('*.md'))
    return format_files(files, args.project)


if __name__ == '__main__':
    raise SystemExit(main())
