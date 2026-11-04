# Sets

*Reference.*

`ichava/icon-sets-emoji` ships **10,567 SVGs across three sets**. The `Set` enum in
`src/Enums/Set.php` is the source of truth.

| Set | SVGs | Path prefix | Style | Upstream |
|---|---:|---|---|---|
| `twemoji` (default) | 3,435 | `twemoji/<category>/<name>` | full colour, Twitter/X house style | [jdecked/twemoji](https://github.com/jdecked/twemoji) |
| `openmoji-color` (deprecated) | 3,566 | `openmoji-color/<category>/<name>` | full colour, OpenMoji house style | [OpenMoji](https://openmoji.org) |
| `openmoji-black` (deprecated) | 3,566 | `openmoji-black/<category>/<name>` | single-colour line art, follows `currentColor` | [OpenMoji](https://openmoji.org) |

Counts measured with `find resources/assets/svg/files/<set> -name '*.svg' | wc -l`. The vendored
version of each upstream is recorded in `resources/assets/svg/config.json`, not here: a version
written in two places drifts.

`openmoji-black` is the only set that responds to a colour prop; the other two carry their own
fills.

> **The two OpenMoji sets are deprecated** (since 0.2.0). They moved, unchanged, to
> [`ichava/icon-sets-openmoji`](https://github.com/ichava/icon-sets-openmoji), and are removed here
> no earlier than 1.0.0. They keep working: alone, this pack still
> serves them; with icon-sets-openmoji installed, core resolves their ids there, does not seed this
> pack's copies, and logs each old id once as deprecated. Doctor (`php artisan ichava::ichava-core.info doctor`)
> lists where a host still uses them.

## Addressing an emoji

```blade
<x-ichava::icon name="ichava/icon-sets-emoji::twemoji/smileys-emotion/grinning-face" class="w-6" />
<x-ichava::icon name="ichava/icon-sets-openmoji::openmoji-black/travel-places/rocket" class="w-6 text-indigo-600" />
```

The second line is the OpenMoji spelling to move to. Its old form,
`ichava/icon-sets-emoji::openmoji-black/travel-places/rocket`, still renders.

---

[← Docs index](../README.md#documentation)
