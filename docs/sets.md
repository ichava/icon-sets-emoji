# Sets

*Reference.*

`ichava/icon-sets-emoji` ships **3,435 SVGs in one set**. The `Set` enum in
`src/Enums/Set.php` is the source of truth.

| Set | SVGs | Path prefix | Style | Upstream |
|---|---:|---|---|---|
| `twemoji` (default) | 3,435 | `twemoji/<category>/<name>` | full colour, Twitter/X house style | [jdecked/twemoji](https://github.com/jdecked/twemoji) |

Counted with `find resources/assets/svg/files/twemoji -name '*.svg' | wc -l`. The vendored
version of the upstream is recorded in `resources/assets/svg/config.json`, not here: a version
written in two places drifts.

OpenMoji (`openmoji-color`, `openmoji-black`) is in
[`ichava/icon-sets-openmoji`](https://github.com/ichava/icon-sets-openmoji), which holds every
OpenMoji SVG this pack used to ship, at the same item paths. This pack no longer ships them, and an
`ichava/icon-sets-emoji::openmoji-*` id does not resolve.

## Addressing an emoji

```blade
<x-ichava::icon name="ichava/icon-sets-emoji::twemoji/smileys-emotion/grinning-face" class="w-6" />
<x-ichava::icon name="ichava/icon-sets-openmoji::openmoji-black/travel-places/rocket" class="w-6 text-indigo-600" />
```

The second line is an OpenMoji emoji, served by icon-sets-openmoji.

---

[← Docs index](../README.md#documentation)
