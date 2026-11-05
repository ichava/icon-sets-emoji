<?php

declare(strict_types=1);

/**
 * Twemoji configuration.
 *
 * Most settings live in resources/assets/svg/config.json -- that file is the
 * canonical source and is read at runtime via IconsConstants. Keys here are
 * the small subset a host application may want to override per environment.
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Default Twemoji Set
    |--------------------------------------------------------------------------
    | When a user references an emoji without specifying a set
    | (e.g. `smileys-emotion/grinning-face`), this set
    | provides the SVG.
    |
    | Supported: twemoji. OpenMoji is in ichava/icon-sets-openmoji.
    */
    'default_set' => env('ICHAVA_TWEMOJI_DEFAULT_SET', 'twemoji'),
];
