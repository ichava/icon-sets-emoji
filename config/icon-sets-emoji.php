<?php

declare(strict_types=1);

/**
 * Emoji Sets configuration.
 *
 * Most settings live in resources/assets/svg/config.json -- that file is the
 * canonical source and is read at runtime via IconsConstants. Keys here are
 * the small subset a host application may want to override per environment.
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Default Emoji Set
    |--------------------------------------------------------------------------
    | When a user references an emoji without specifying a set
    | (e.g. `emoji-sets::smileys-emotion/grinning-face`), this set
    | provides the SVG.
    |
    | Supported: twemoji | openmoji-color | openmoji-black
    |
    | openmoji-color and openmoji-black are deprecated since 0.1.0 in favour
    | of ichava/icon-sets-openmoji (the same art, in a pack of its own, so
    | the CC-BY-SA terms reach only apps that install it). They stay
    | supported here, and with both packs installed their ids resolve there.
    */
    'default_set' => env('ICHAVA_EMOJI_DEFAULT_SET', 'twemoji'),
];
