<?php

declare(strict_types=1);

/*
| This pack ships Twemoji only. OpenMoji moved to ichava/icon-sets-openmoji,
| which holds every OpenMoji SVG this pack used to ship (its
| EmojiOpenmojiSupersetTest checks that against a manifest). A set directory,
| a licence directory or a config category for anything else fails here.
*/

function twemoji_only_dirs(string $path): array
{
    return array_values(array_filter(
        (array) scandir($path),
        static fn (string $entry): bool => $entry[0] !== '.' && is_dir($path . '/' . $entry),
    ));
}

it(description: 'ships the twemoji set and its licence only', closure: function () {
    $svg = dirname(__DIR__, 2) . '/resources/assets/svg';
    $config = json_decode((string) file_get_contents($svg . '/config.json'), true, flags: JSON_THROW_ON_ERROR);

    expect(twemoji_only_dirs($svg . '/files'))->toBe(['twemoji'])
        ->and(twemoji_only_dirs($svg . '/licenses'))->toBe(['twemoji'])
        ->and(array_keys($config['metadata']['data']['categories']))->toBe(['twemoji'])
        ->and(json_encode($config))->not->toContain('"deprecated"');
});
