# Sets

*Reference.*

`ichava/icon-sets-emoji` ships **10,569 SVGs across three sets**. The `Set` enum in
`src/Enums/Set.php` is the source of truth.

| Set | SVGs | Path prefix | Style | Upstream |
|---|---:|---|---|---|
| `twemoji` (default) | 3,435 | `twemoji/<category>/<name>` | full colour, Twitter/X house style | [jdecked/twemoji](https://github.com/jdecked/twemoji) |
| `openmoji-color` (prefer icon-sets-openmoji) | 3,567 | `openmoji-color/<category>/<name>` | full colour, OpenMoji house style | [OpenMoji](https://openmoji.org) |
| `openmoji-black` (prefer icon-sets-openmoji) | 3,567 | `openmoji-black/<category>/<name>` | single-colour line art, follows `currentColor` | [OpenMoji](https://openmoji.org) |

Counts measured with `find resources/assets/svg/files/<set> -name '*.svg' | wc -l`. The vendored
version of each upstream is recorded in `resources/assets/svg/config.json`, not here: a version
written in two places drifts.

`openmoji-black` is the only set that responds to a colour prop; the other two carry their own
fills.

> **For new work, install [`ichava/icon-sets-openmoji`](https://github.com/ichava/icon-sets-openmoji)**
> (preferred since 0.1.0) for `openmoji-color` and `openmoji-black`. It holds the same files, unchanged,
> in a pack of its own, so the CC-BY-SA terms reach only the applications that install it. The two
> sets here stay supported in v0.1.0: alone, this pack still serves them; with both packs installed,
> core resolves the old `ichava/icon-sets-emoji::openmoji-*` ids in icon-sets-openmoji, does not seed
> this pack's copies, and logs each old id once as deprecated. Doctor (`php artisan ichava::ichava-core.info doctor`)
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
