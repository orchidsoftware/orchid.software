@extends('layout')

@section('title', 'Дизайн-система')
@section('description', 'Живые компоненты и CSS-токены сайта Orchid: цвет, типографика и композиция.')

@section('body')
    @php
        $groups = [
            'Назначение' => ['purpose' => 'Назначение'],
            'Основы' => ['colors' => 'Цвет', 'type' => 'Типографика', 'geometry' => 'Геометрия'],
            'Компоненты' => ['actions' => 'Действия', 'cards' => 'Карточки', 'documentation' => 'Документация', 'brand' => 'Бренд'],
        ];
        $colors = [
            ['label' => 'Фон', 'token' => '--color-canvas', 'class' => 'canvas'],
            ['label' => 'Поверхность', 'token' => '--color-surface', 'class' => 'surface'],
            ['label' => 'Текст', 'token' => '--color-ink', 'class' => 'ink'],
            ['label' => 'Вторичный', 'token' => '--color-ink-muted', 'class' => 'muted'],
            ['label' => 'Акцент', 'token' => '--color-accent', 'class' => 'accent'],
            ['label' => 'Код', 'token' => '--color-code', 'class' => 'code'],
        ];
        $spaces = [
            ['label' => 'Текст', 'token' => '--space-2', 'class' => 'text', 'usedAt' => 'Короткие отступы и меню'],
            ['label' => 'Базовый', 'token' => '--space-4', 'class' => 'base', 'usedAt' => 'Абзацы и шапка'],
            ['label' => 'Сетка', 'token' => '--space-5', 'class' => 'grid', 'usedAt' => 'Обычный промежуток сетки'],
            ['label' => 'Компонент', 'token' => '--space-7', 'class' => 'card', 'usedAt' => 'Отступ карточки на широком экране'],
        ];
    @endphp

    <div class="masthead shell">
        <header class="header">@include('header-menu')</header>
    </div>
    <main class="catalog shell">
        <header class="intro">
            <h1 class="section-title">Дизайн-<span class="text-accent">система</span></h1>
            <p class="section-description">Цвет, типографика и компоненты сайта Orchid.<br>Живые образцы из действующих стилей.</p>
        </header>
        <nav class="index" data-catalog-nav aria-label="Разделы дизайн-системы">
            @foreach($groups as $links)
                @foreach($links as $id => $name)
                    <a href="#{{ $id }}" @if($id === 'purpose') aria-current="location" @endif>{{ $name }}</a>
                @endforeach
            @endforeach
        </nav>
        <section id="purpose" class="section" aria-labelledby="purpose-title">
            <div class="section-heading"><h2 id="purpose-title">Назначение и приоритет</h2></div>
            <p class="description">Сайт помогает понять Orchid и начать работу. В документации главное — чтение и поиск ответов.</p>
            <div class="description">
                <p><strong>Целевой переход.</strong> Documentation и Browse Issues ведут к задаче раздела.</p>
                <p><strong>Навигация.</strong> Меню, оглавление и подвал помогают найти нужное место.</p>
                <p><strong>Вспомогательное действие.</strong> Suggest Edit помогает исправить статью, не отвлекая от чтения.</p>
            </div>
            <dl class="metrics">
                <div><dt>Мышь и трекпад</dt><dd>Спокойное наведение и отклик нажатия.</dd></div>
                <div><dt>Касание</dt><dd>Нажатие без оставшейся подсветки наведения.</dd></div>
                <div><dt>Клавиатура</dt><dd>Отчётливый контур текущей цели, включая внешнюю клавиатуру.</dd></div>
                <div><dt>Поиск и текущее положение</dt><dd>Поиск документации доступен в десктопной шапке. Ввод обозначен кареткой и границей; текущий раздел отмечен постоянно.</dd></div>
            </dl>
        </section>
                <section id="colors" class="section" aria-labelledby="colors-title">
                    <div class="section-heading"><h2 id="colors-title">Цвет</h2><a class="source" href="/en/docs">Сайт и документация ↗</a></div>
                    <div class="themes">
                        @foreach(['theme-dark' => 'Сайт', 'theme-paper' => 'Документация'] as $theme => $label)
                            <article class="card palette {{ $theme }}">
                                <header class="palette-heading"><h3>{{ $label }}</h3><code>.{{ $theme }}</code></header>
                                <dl class="colors">
                                    @foreach($colors as $color)
                                        <div class="color">
                                            <div class="swatch {{ $color['class'] }}" aria-hidden="true"></div>
                                            <dt>{{ $color['label'] }}</dt>
                                            <dd><output data-token-value="{{ $color['token'] }}"></output><code>{{ $color['token'] }}</code></dd>
                                        </div>
                                    @endforeach
                                </dl>
                                <div class="contrast">
                                    <p class="contrast-heading">Текст на фоне карточки</p>
                                    <dl class="contrast-list">
                                        @foreach(['ink' => 'Основной текст', 'muted' => 'Вторичный текст', 'accent' => 'Акцентный текст'] as $role => $roleLabel)
                                            <div class="contrast-pair">
                                                <dt class="contrast-text contrast-{{ $role }}">{{ $roleLabel }}</dt>
                                                <dd><output data-palette-contrast>—</output></dd>
                                            </div>
                                        @endforeach
                                    </dl>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    <p class="note">Семантические имена общие. Значения меняются вместе с контекстом и читаются из CSS.</p>
                    <p class="note">Контраст рассчитан по цветам текста и фона этих карточек. Ориентир для обычного текста — <a href="https://www.w3.org/WAI/WCAG22/Understanding/contrast-minimum.html" class="source">4,5:1</a>. Градиенты и состояния элементов проверяются отдельно в своём контексте.</p>
                </section>
                <section id="type" class="section" aria-labelledby="type-title">
                    <div class="section-heading"><h2 id="type-title">Типографика</h2><a class="source" href="/">На главной ↗</a></div>
                    <div class="card table">
                        <div class="type-row"><div class="label">Главный заголовок<code>.display</code></div><div class="type-preview"><p id="catalog-type-hero" class="display">Enhance your Laravel</p></div><output class="value" data-type-metric="catalog-type-hero"></output></div>
                        <div class="type-row"><div class="label">Заголовок карточки<code>.heading</code></div><div class="type-preview"><h3 id="catalog-type-card" class="heading">Quick Start</h3></div><output class="value" data-type-metric="catalog-type-card"></output></div>
                        <div class="type-row"><div class="label">Вводный текст<code>.intro-text</code></div><div class="type-preview"><p id="catalog-type-lead" class="intro-text">Focus on what matters most.</p></div><output class="value" data-type-metric="catalog-type-lead"></output></div>
                        <div class="type-row"><div class="label">Основной текст<code>body</code></div><div class="type-preview"><p id="catalog-type-body">Build your application with Orchid.</p></div><output class="value" data-type-metric="catalog-type-body"></output></div>
                        <div class="type-row"><div class="label">Подпись<code>small</code></div><div class="type-preview"><small id="catalog-type-small">English / Russian</small></div><output class="value" data-type-metric="catalog-type-small"></output></div>
                    </div>
                    <div class="fonts">
                        <div><span>Интерфейс</span><code>--font-sans</code><details><summary>Стек шрифтов</summary><output data-token-value="--font-sans"></output></details></div>
                        <div><span>Код</span><code>--font-mono</code><details><summary>Стек шрифтов</summary><output data-token-value="--font-mono"></output></details></div>
                    </div>
                </section>
                <section id="geometry" class="section" aria-labelledby="geometry-title">
                    <div class="section-heading"><h2 id="geometry-title">Геометрия</h2><a class="source" href="/">Сетка главной ↗</a></div>
                    <dl class="card table spaces">
                        @foreach($spaces as $space)
                            <div class="space"><dt>{{ $space['label'] }}<code>{{ $space['token'] }}</code></dt><dd class="sample"><span class="bar space-{{ $space['class'] }}" aria-hidden="true"></span><output data-token-value="{{ $space['token'] }}"></output></dd><dd class="usage">{{ $space['usedAt'] }}</dd></div>
                        @endforeach
                    </dl>
                    <p class="note">Примеры отступов. Сетка и внутренние поля адаптируются к ширине экрана.</p>
                    <dl class="metrics"><div><dt>Карточка <code>--radius-card</code></dt><dd><output data-token-value="--radius-card"></output></dd></div><div><dt>Шапка <code>--radius-header</code></dt><dd><output data-token-value="--radius-header"></output></dd></div><div><dt>Контейнер <code>--measure-shell</code></dt><dd><output data-token-value="--measure-shell"></output></dd></div><div><dt>Тень карточки <code>--shadow-card</code></dt><dd><output data-token-value="--shadow-card"></output></dd></div></dl>
                </section>
                <section id="actions" class="section" aria-labelledby="actions-title">
                    <div class="section-heading"><h2 id="actions-title">Действия</h2><a class="source" href="/en/discussions">В сообществе ↗</a></div>
                    <div class="card table">
                        <div class="action-row"><div class="action-preview"><a class="button" href="/en/docs">Documentation</a></div><div class="label">Перейти к документации<code>.button</code><p>Основной путь из шапки к началу работы.</p></div></div>
                        <div class="action-row"><div class="action-preview"><a class="button" href="https://github.com/orchidsoftware/platform/issues" target="_blank" rel="noopener">Browse Issues</a> <a class="button" href="https://github.com/orgs/orchidsoftware/discussions" target="_blank" rel="noopener">Browse Discussions</a></div><div class="label">Обратиться к сообществу<code>.button</code><p>Равнозначные переходы к спискам GitHub.</p></div></div>
                        <div class="action-row"><div class="action-preview"><a class="action" href="/en/license">View License</a></div><div class="label">Текстовое действие<code>.action</code></div></div>
                        <div class="action-row"><div class="action-preview"><a class="action" href="#documentation">Образец в статье ↓</a></div><div class="label">Вспомогательное действие Suggest Edit<code>.button.quiet</code><code>&lt;x-docs-edit :href="$edit" /&gt;</code><p>Помогает исправить статью на GitHub. На широком экране находится рядом с заголовком; на узком экране скрыто.</p></div></div>
                    </div>
                    <dl class="metrics"><div><dt>Фокус <code>--focus-width</code></dt><dd><output data-token-value="--focus-width"></output></dd></div><div><dt>Отклик <code>--duration-feedback</code></dt><dd><output data-token-value="--duration-feedback"></output></dd></div></dl>
                    <dl class="metrics">
                        <div><dt>Нейтральная кнопка<code>.button</code></dt><dd>Наведение и нажатие меняют фон и границу. Клавиатурный фокус обозначен контуром.</dd></div>
                        <div><dt>Текстовое действие<code>.action</code></dt><dd>Акцент и подчеркивание появляются при наведении, нажатии и клавиатурном фокусе.</dd></div>
                        <div><dt>Вспомогательное действие<code>.button.quiet</code></dt><dd>Без постоянной заливки. Наведение и нажатие усиливают текст и фон; фокус обозначен контуром.</dd></div>
                        <div><dt>Ссылка в тексте статьи<code>.article p &gt; a</code></dt><dd>Подчеркивание сохраняется. Наведение и нажатие добавляют цветовой акцент; фокус обозначен контуром.</dd></div>
                    </dl>
                </section>
                <section id="cards" class="section" aria-labelledby="cards-title">
                    <div class="section-heading"><h2 id="cards-title">Карточки</h2><a class="source" href="/">На главной ↗</a></div>
                    <div class="specimen"><div class="card-preview">
            <div class="feature-preview feature-grid">
                <div class="feature-item">
                <x-quick-start/>
                </div>
            </div>
                    </div><aside class="specimen-note"><h3>Quick Start</h3><p>Заголовок, описание и ссылка на всю карточку. Фирменная иллюстрация остаётся частью композиции.</p><code>.card</code><code>.feature</code><code>.quick-start</code><code>&lt;x-quick-start /&gt;</code><p>Главная и каталог используют один Blade-компонент с его исходными размерами и стилями.</p></aside></div>
                </section>
                <section id="documentation" class="section" aria-labelledby="documentation-title">
                    <div class="section-heading"><h2 id="documentation-title">Документация</h2><a class="source" href="/en/docs/screens">Страница Screens ↗</a></div>
                    <p class="description">Статья: заголовок, навигация и вспомогательная ссылка Suggest Edit. На узком экране ссылка скрыта.</p>
            <div class="docs-preview docs-layout theme-paper">
                <aside class="sidebar">
                    <nav class="docs-menu" aria-label="Пример меню документации">
                        <div class="group">
                            <p class="title">The Basics</p>
                            <ul class="list">
                                <li class="item"><a class="link" href="#documentation" aria-current="page">Screens</a></li>
                                <li class="item"><a class="link" href="/en/docs/rows">Rows</a></li>
                                <li class="item"><a class="link" href="/en/docs/table">Tables</a></li>
                            </ul>
                        </div>
                    </nav>
                </aside>
                <div class="reading">
                    <article class="article">
                        <header class="headline">
                            <h3>Screens</h3>
                            <x-docs-edit href="https://github.com/orchidsoftware/orchid.software/edit/master/docs/en/docs/screens.md" />
                        </header>
                        <p>Screens are responsible for displaying information and processing user actions. Each screen has a <code>query()</code> method and a <code>layout()</code> method.</p>
                        <blockquote><p>A screen describes the data and layout of a page.</p></blockquote>
                        <pre><code><span class="hl-keyword">public function</span> <span class="hl-function">query</span>(): <span class="hl-keyword">array</span>
{
    <span class="hl-keyword">return</span> [<span class="hl-value">'name'</span> =&gt; <span class="hl-value">'Orchid'</span>];
}</code></pre>
                        <h4>Screen methods</h4>
                        <table>
                            <thead><tr><th>Method</th><th>Purpose</th></tr></thead>
                            <tbody><tr><td><code>query()</code></td><td>Prepare the data.</td></tr><tr><td><code>layout()</code></td><td>Define the page layout.</td></tr></tbody>
                        </table>
                        <hr>
                        <picture alt="Orchid administration screen. Нажмите, чтобы увеличить.">
                            <img src="/img/next/screen.jpg" alt="Orchid administration screen" loading="lazy">
                        </picture>
                    </article>
                </div>
            </div>
                    <div class="banner-preview"><p class="label">Видеоуроки дополняют документацию. Действие относится к баннеру.<code>&lt;x-docs-banner /&gt;</code></p><x-docs-banner /></div>
                </section>
                <section id="brand" class="section" aria-labelledby="brand-title">
                    <div class="section-heading"><h2 id="brand-title">Бренд</h2><a class="source" href="/">На главной ↗</a></div>
                    <div class="card brand-sample"><div><img class="brand-logo" src="/img/next/logo-full.svg" alt="Orchid"><p class="label">Логотип<code>/img/next/logo-full.svg</code></p></div><div><p class="section-title">Say <span class="text-accent">goodbye</span></p><p class="label">Фирменный градиент<code>.text-accent · --gradient-accent</code></p></div></div>
                    <p class="note"><a href="/en#product-preview" class="source">Превью интерфейса на главной ↗</a> использует реальный скриншот. Ссылка открывает исходное изображение для просмотра деталей.</p>
                </section>
    </main>
@endsection
