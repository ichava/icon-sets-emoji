<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Artisan;
use Simtabi\Laranail\Ichava\Services\IconRegistry;

/*
 * The OpenMoji move (D9, contract §8), from this pack's side.
 *
 * openmoji-color and openmoji-black moved to ichava/icon-sets-openmoji. This
 * pack keeps shipping them, marked deprecated since 0.1.0 (prefer the new pack),
 * and supported in v0.1.0.
 * Alone, the old ids work exactly as before. `tests/fixtures/OpenmojiPack`
 * stands in for the new pack: registered under its real name with its real
 * `replaces` entry, and a file whose fill (#00ff00) appears in no set here.
 */
const EMOJI_OLD_ID = 'ichava/icon-sets-emoji::openmoji-color/smileys-emotion/grinning-face';
const EMOJI_NEW_ID = 'ichava/icon-sets-openmoji::openmoji-color/smileys-emotion/grinning-face';
const EMOJI_TWEMOJI_ID = 'ichava/icon-sets-emoji::twemoji/smileys-emotion/grinning-face';

function emoji_fixture(string $name): string
{
    return dirname(__DIR__) . '/fixtures/' . $name;
}

/** @return array{id: string, status: string, count: int, detail: list<mixed>} */
function emoji_doctor_check(string $id): array
{
    Artisan::call('ichava::ichava-core.info', ['type' => 'doctor', '--format' => 'json']);
    $report = json_decode(Artisan::output(), true, flags: JSON_THROW_ON_ERROR);

    return collect($report['checks'])->firstWhere('id', $id);
}

it(description: 'marks both OpenMoji sets deprecated as contract section 8 gives it', closure: function () {
    $config = json_decode((string) file_get_contents(dirname(__DIR__, 2) . '/resources/assets/svg/config.json'), true, flags: JSON_THROW_ON_ERROR);
    $categories = $config['metadata']['data']['categories'];
    $marker = ['since' => '0.1.0', 'replacement' => 'ichava/icon-sets-openmoji'];

    expect($categories['openmoji-color']['deprecated'])->toBe($marker)
        ->and($categories['openmoji-black']['deprecated'])->toBe($marker)
        ->and($categories['twemoji'])->not->toHaveKey('deprecated')
        // Deprecated, not removed: both sets still ship.
        ->and(glob(dirname(__DIR__, 2) . '/resources/assets/svg/files/openmoji-{color,black}/*/*.svg', GLOB_BRACE))->toHaveCount(7132);
});

it(description: 'names 0.1.0 in every deprecation notice, never the 0.2.0 that will not exist', closure: function () {
    $root = dirname(__DIR__, 2);
    $files = ['src/Enums/Set.php', 'src/Providers/IconsServiceProvider.php', 'config/icon-sets-emoji.php', 'README.md', 'ATTRIBUTION.md', 'docs/sets.md', 'docs/attribution.md', 'docs/configuration.md'];

    foreach ($files as $file) {
        expect(str_contains((string) file_get_contents("{$root}/{$file}"), 'since 0.2.0'))->toBeFalse("{$file} names a version that will not exist");
    }

    $set = (string) file_get_contents("{$root}/src/Enums/Set.php");
    expect(substr_count($set, '@deprecated since 0.1.0'))->toBe(2)
        ->and((string) file_get_contents("{$root}/docs/sets.md"))->toContain('preferred since 0.1.0');
});

it(description: 'keeps the old ids working when icon-sets-openmoji is not installed', closure: function () {
    $registry = app(IconRegistry::class);

    foreach (['openmoji-color', 'openmoji-black'] as $set) {
        $id = "ichava/icon-sets-emoji::{$set}/smileys-emotion/grinning-face";

        expect($registry->canonicalId($id))->toBe($id)
            ->and($registry->has($id))->toBeTrue("{$id} no longer resolves")
            ->and($registry->render($id))->toContain('<svg')
            ->and($registry->isReplaced('ichava/icon-sets-emoji', "{$set}/smileys-emotion/grinning-face"))->toBeFalse();
    }
});

it(description: 'resolves the old ids in icon-sets-openmoji once both packs are installed', closure: function () {
    $registry = app(IconRegistry::class);
    $registry->fromDirectory(emoji_fixture('OpenmojiPack'));

    expect($registry->canonicalId(EMOJI_OLD_ID))->toBe(EMOJI_NEW_ID)
        ->and($registry->has(EMOJI_OLD_ID))->toBeTrue()
        ->and($registry->render(EMOJI_OLD_ID))->toContain('#00ff00')
        ->and($registry->isReplaced('ichava/icon-sets-emoji', 'openmoji-black/smileys-emotion/grinning-face'))->toBeTrue()
        // Twemoji stays in this pack.
        ->and($registry->canonicalId(EMOJI_TWEMOJI_ID))->toBe(EMOJI_TWEMOJI_ID)
        ->and($registry->isReplaced('ichava/icon-sets-emoji', 'twemoji/smileys-emotion/grinning-face'))->toBeFalse();
});

it(description: 'has doctor report the missing replacement and a use of an old id', closure: function () {
    $this->app->useConfigPath(emoji_fixture('CleanHost'));
    $missing = emoji_doctor_check('alias.replacement_missing');

    expect($missing['status'])->toBe('warn')
        ->and($missing['count'])->toBe(2)
        ->and(array_column($missing['detail'], 'category'))->toEqualCanonicalizing(['openmoji-color', 'openmoji-black'])
        ->and(array_unique(array_column($missing['detail'], 'replacement')))->toBe(['ichava/icon-sets-openmoji']);

    $this->app->useAppPath(emoji_fixture('OldIdUse/app'));
    $planted = emoji_doctor_check('alias.deprecated_ids');

    expect($planted['status'])->toBe('warn')
        ->and($planted['count'])->toBe(1)
        ->and($planted['detail'][0]['location'])->toEndWith('OldIdUse/app/Hero.php:7')
        ->and($planted['detail'][0]['replacement_installed'])->toBeFalse();

    $this->app->useAppPath(emoji_fixture('CleanHost/app'));

    expect(emoji_doctor_check('alias.deprecated_ids')['count'])->toBe(0);
});
