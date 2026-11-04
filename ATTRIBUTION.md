# Attribution

This package has several owners, and each part keeps its own licence.

| Part | Owner | Licence |
|---|---|---|
| `resources/assets/svg/files/twemoji/` | Twitter, Inc. and other contributors (2014–2021); Jason Sofonia & Justine De Caires (2022–present), the jdecked/twemoji maintainers | CC-BY 4.0 |
| Everything else: the PHP, configuration, translations, tests and documentation | Simtabi LLC | MIT, see [`LICENSE`](LICENSE) |

The MIT licence in `LICENSE` covers ONLY the package code. Each emoji asset retains its original licence. Simtabi LLC packages and redistributes the emoji; it did not draw them and claims no authorship of them.

## Twemoji (Twitter/X)

- **Set directory**: `resources/assets/svg/files/twemoji/`
- **Source**: <https://github.com/jdecked/twemoji>
- **Upstream version**: npm `@twemoji/svg` 15.0.0, repository tag `v15.1.0`
  (the two version independently; `resources/assets/svg/config.json` holds both)
- **Licence (code)**: MIT
- **Licence (assets)**: CC-BY 4.0, <https://creativecommons.org/licenses/by/4.0/>
- **Attribution requirement**: when redistributing the SVGs, credit
  "Twitter, Inc and other contributors" and link back to the source.
  Upstream accepts a mention in a README, an "About" section or a site footer.

Credit line:

> Emoji graphics from [Twemoji](https://github.com/jdecked/twemoji), by Twitter, Inc. and other contributors, licensed under [CC-BY 4.0](https://creativecommons.org/licenses/by/4.0/).

## Changes

The Creative Commons licence asks you to indicate changes. Measured
2026-10-26 by comparing files against upstream by codepoint:

- **Twemoji**: the files are byte-identical to `@twemoji/svg` 15.0.0
  (spot check, e.g. `activities/1st-place-medal.svg` against `1f947.svg`).
  Only the filenames and directories differ: they are named and grouped by
  CLDR name and category instead of codepoint.

When `ichava/core` renders an icon it also sanitises the SVG (it drops
attributes and elements outside its allow-list), prefixes every `id` so two
icons on one page cannot collide, and removes a root `width`/`height` when a
`viewBox` exists. All of these change markup, not artwork. Say so wherever you
credit the sets, e.g. "markup reformatted and sanitised for inline use".

## Where the credit has to appear

Wherever these emoji are shown to people, the page or app must carry the
credit for each set it shows: a footer, an "About" or a credits page is enough.
Shipping this file with the package covers redistribution of the package; it
does not cover a public page that displays the emoji.

## Index files

This package ships no generated index files. Earlier revisions of this file
described `resources/assets/svg/codepoints.json` and `names.json`; neither
exists. Emoji names come from the SVG filenames and the Unicode CLDR
categorisation recorded in `resources/assets/svg/config.json`, and that
configuration is MIT like the rest of the package code.
