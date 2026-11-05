# Customisation

*How-to guide.* Twemoji SVGs are full-colour artwork: their colours are part of the emoji, so size and accessibility are what a page changes.

## Size

The SVGs are square, with a `viewBox`, so any width and height utility scales them.

```blade
<x-ichava::icon name="ichava/icon-sets-emoji::twemoji/activities/1st-place-medal" class="w-4 h-4" />
<x-ichava::icon name="ichava/icon-sets-emoji::twemoji/activities/1st-place-medal" class="w-12 h-12" />
```

## Colour

Not recolourable. The fills are fixed in each file, and `class="text-…"` or `->color()` has no effect on them. For a single-colour emoji style, use OpenMoji's `openmoji-black` set in [`ichava/icon-sets-openmoji`](https://github.com/ichava/icon-sets-openmoji).

## Accessibility

An emoji that carries meaning needs a text alternative:

```blade
<x-ichava::icon name="ichava/icon-sets-emoji::twemoji/activities/1st-place-medal" aria-label="First place" class="w-6 h-6" />
```

A decorative emoji beside a text label can omit it.

## See also

- [Sets](sets.md)
- [Categories](categories.md)
- [Blade components](https://github.com/ichava/core/blob/main/docs/tools/blade-components.md)

---

[← Docs index](../README.md#documentation)
