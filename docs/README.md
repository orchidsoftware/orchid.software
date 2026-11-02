# Versioned documentation

Documentation lives in `docs/{version}/{locale}/{page}.md`. Each version has its own `navigation.json`, grouped by
locale and section. Community and design guidelines remain in `docs/en` and `docs/ru` because they are not platform
releases.

The website opens the latest stable version, 14.x, by default. Version 15.x is a development section with introductory
pages only, not a recovered documentation snapshot. Its source implementation is the platform `15.0-dev` branch. It
appears in the switcher with a development label. A version has a permanent URL such as `/en/docs/13.x/screens`.
Historical pages retain their original APIs and examples.

## Recovery sources

[sources.json](sources.json) records the exact repository, commit, original directory, page counts, and image sources
for every recovered archive. It also records pages recovered from an earlier commit of the same major version.

| Version | Source |
| --- | --- |
| 2.x | `orchidsoftware/platform` tag `2.2.7`. |
| 3.x | `orchidsoftware/platform` tag `3.11.0`. |
| 4.x | Website snapshot before commit `5e53fe3d7`, the explicit 5.0 documentation update. |
| 5.x | Website snapshot before commit `3cb8459be`, the explicit 6.0 documentation update. |
| 6.x | Website commit `2f38e303b`, the explicit 6.4.0 documentation update. |
| 7.x, 8.x, 9.x, 10.x, 13.x | Corresponding website tags `7.0`, `8.0`, `9.0`, `10.0`, and `13.0`. |
| 11.x | Website snapshot before commit `2a85d1c5c`, which adds the 12.0 upgrade guide. |
| 12.x | Website snapshot before commit `11d1e92fc`, which adds the 13.0 upgrade guide. |
| 14.x | Current website working copy based on `f334e9875`, preserving its current documentation and navigation. |

The archives contain 832 historical pages. The current 14.x directory contains 80 pages. The website publishes English
and Russian. Historical Spanish, Filipino, and Portuguese translations are preserved in 2.x and 3.x as source files,
with their original locale names.

The available 1.x platform tags have no documentation directory. No verified 1.x snapshot was recovered. Versions
without a dedicated website tag use the dated snapshots above. These are historical documentation snapshots, not a
claim that every page describes the final patch release of that major version. Existing translations can lag behind
the English documentation.

## Format adaptations

The recovery starts from the pinned historical sources. Formatting and confirmed spelling errors are corrected
without changing legacy API names. It makes these adaptations for the current website renderer:

- Plain Markdown page headings become YAML `title` metadata. The duplicate heading and its underline are removed.
- Old Jigsaw layout metadata is removed. It does not describe the article and cannot select a current Blade component.
- Historical image URLs point to the same image bytes in `public/img`. Three images absent from the current assets are
  restored under `public/img/docs-archive`. A deleted illustration still referenced by the Spanish 3.x documentation
  comes from the last website snapshot before its deletion.
- Six old Blade icon catalogs become Markdown pages containing their original paragraphs. Their generated search
  controls and icon loops depend on the old Jigsaw runtime and are omitted. The affected paths are listed in
  `sources.json`.
- Navigation uses the historical menu when available. Missing menu targets are omitted. Existing articles absent from
  that menu appear under an additional articles group. The old HTML menu helper `documentation.md` remains in the
  archive but is not included as an article in the sidebar.

The English 3.x blog tutorial was deleted during that version's lifetime. It is restored from its last 3.x revision.
Three deleted 2.x clinic and package tutorials are restored from their original 2.x revisions. Those originals are
unfinished stubs, which is recorded in `sources.json`.

The English 4.x forms article links to `tutorial_blog`, but no 4.x source for that article was found. Its existing 3.x
source describes the older API, so it remains in the 3.x archive. The unresolved 4.x target is recorded in
`sources.json`. External services referenced by historical pages can also have disappeared. The restoration does not
replace historical API instructions with current ones.

The renderer labels links to unrecovered articles as unavailable and leaves their text visible. It does not send
readers to a different version silently. External historical links remain unchanged.

## Verify the website

Run the documentation checks from the website directory:

```sh
php tests/documentation.php
php artisan export
php tests/static-documentation.php
```

The checks render every English and Russian documentation page, validate version navigation, exercise legacy URLs, and
verify static export paths. The static check reads the exported HTML, follows local links, and verifies canonical
targets, reciprocal language alternates, indexing rules, and sitemap entries. The normal `php artisan export` includes
all versioned pages and the latest unversioned
URLs.

## Reproduce the historical archives

Install the website's Composer dependencies, Python 3, and Node.js with npm. Make the `orchidsoftware/platform` Git
history available in a sibling
`platform` checkout, then run:

```sh
php scripts/restore-docs.php
```

For another platform checkout location, pass its path:

```sh
php scripts/restore-docs.php /path/to/platform
```

The script reads pinned local Git commits. It formats a temporary copy with the pinned Markdown formatter before
comparing and writing the recovered files. The formatter may download its npm package on its first run. It restores
missing files and verifies existing files
against their recovered contents. It stops rather than overwrite a modified file. It leaves 14.x and the unversioned
community and design sections alone.

Archival formatting and spelling corrections are reproducible with `python3 scripts/format-archive-docs.py`. The
formatter also has a `--self-check` mode. Existing legacy API identifiers and published URLs retain their spelling.

Edit the newest documentation directly in its version directory and update that version's `navigation.json`. To add a
future major version, add a new version directory with its own pages and navigation. On a stable release, update
`Documentation::latest()` to promote the new version to the default. Higher versions remain development sections until
promoted. Do not copy new API examples into an older archive.

## Search indexing

Stable documentation uses the established unversioned URLs, such as `/en/docs/screens`, as its canonical URLs. Menus,
article links, language links, and the stable version selector use these URLs. Numbered stable URLs remain available
as permanent redirects in Laravel and immediate HTML redirects in the static export, without duplicate article
content. Static redirects retain query strings and fragments when JavaScript is enabled.

Archives and development documentation have `noindex, follow` and their own canonical URLs. They are excluded from the
sitemap, as are redirect pages. The sitemap includes only unique, indexable canonical URLs and does not invent
modification dates. Historical articles are not canonicalized to different content in the latest version.
