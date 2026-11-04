# Attribution

*Reference.*

Each set carries its own upstream licence, and they are **not** the same. This matters more here
than in a single-source pack: shipping OpenMoji without its attribution is a licence breach, and
shipping Twemoji without its notice is a different one.

| Set | Upstream | Artwork licence | Attribution required |
|---|---|---|---|
| `twemoji` | [jdecked/twemoji](https://github.com/jdecked/twemoji) | CC-BY 4.0 | yes, credit Twitter/X and the Twemoji project |
| `openmoji-color` | [OpenMoji](https://openmoji.org) | CC-BY-SA 4.0 | yes, and derivatives must stay CC-BY-SA |
| `openmoji-black` | [OpenMoji](https://openmoji.org) | CC-BY-SA 4.0 | as above |

The OpenMoji sets are deprecated here and live on in
[`ichava/icon-sets-openmoji`](https://github.com/ichava/icon-sets-openmoji). Until they are removed
(1.0.0 at the earliest), installing this pack still installs CC-BY-SA artwork, and the terms below
apply wherever you show it.

The full text this package ships with is in [`ATTRIBUTION.md`](../ATTRIBUTION.md); it is the
authoritative version and travels with the assets.

## What CC-BY-SA means for you

OpenMoji's **share-alike** term has a consequence CC-BY does not: if you modify an OpenMoji glyph
and distribute the result, that result has to be CC-BY-SA too. Recolouring
`openmoji-black` with `currentColor` at render time is not modification: you are styling, not
redistributing a derivative, but editing the artwork and shipping it is.

If that is awkward for your project, use `twemoji`, which is CC-BY and asks only for credit.

## The integration is separately licensed

The provider, enums, component and configuration in this repository are MIT under `Simtabi LLC`
(see [`LICENSE`](../LICENSE)). The artwork licences above apply to the 10,567 SVGs this package
vendors under `resources/assets/svg/files/`. Simtabi LLC redistributes them and claims no authorship
of them.

---

[← Docs index](../README.md#documentation)
