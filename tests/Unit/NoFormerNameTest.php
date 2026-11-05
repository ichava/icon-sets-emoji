<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| The pack's former name does not come back
|--------------------------------------------------------------------------
|
| This pack was renamed to `ichava/icon-sets-twemoji` (see CHANGELOG.md),
| forward only: no alias, no `replace`, no fallback config key or env var. So
| the old name has no business anywhere in the repository except the history
| that records it:
|
|   - CHANGELOG.md, whose released sections keep the name they shipped under
|     and whose [Unreleased] entry records the rename itself;
|   - one comment in .github/workflows/changelog.yml, byte-identical across
|     the estate, which cites a past CHANGELOG defect by the pack's name then.
|
| The former name is assembled from parts so this file does not match itself.
|
*/

function former_pack_name(): string
{
    return 'icon-sets-' . 'emoji';
}

/**
 * Every file in the repository a reader or the runtime could reach, minus
 * dependencies and caches.
 *
 * @return list<string> paths relative to the repository root
 */
function former_name_scanned_files(): array
{
    $root = dirname(__DIR__, 2);
    $skip = ['.git', 'vendor', 'node_modules', '.phpstan.cache', '.phpunit.cache', '.idea'];
    $files = [];

    $iterator = new RecursiveIteratorIterator(
        new RecursiveCallbackFilterIterator(
            new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS),
            static fn (SplFileInfo $file): bool => ! ($file->isDir() && in_array($file->getFilename(), $skip, true)),
        ),
    );

    foreach ($iterator as $file) {
        if ($file instanceof SplFileInfo && $file->isFile()) {
            $files[] = substr($file->getPathname(), strlen($root) + 1);
        }
    }

    sort($files);

    return $files;
}

it(description: 'names the pack by its current name everywhere outside its history', closure: function () {
    $root = dirname(__DIR__, 2);
    $former = former_pack_name();
    $files = former_name_scanned_files();
    $offenders = [];

    foreach ($files as $path) {
        if ($path === 'CHANGELOG.md') {
            continue;
        }

        $lines = file($root . '/' . $path, FILE_IGNORE_NEW_LINES) ?: [];

        foreach ($lines as $number => $line) {
            if (! str_contains($line, $former)) {
                continue;
            }

            // The estate-wide comment citing a past CHANGELOG defect.
            if ($path === '.github/workflows/changelog.yml' && str_contains($line, $former . ' had [0.2.6] filed')) {
                continue;
            }

            $offenders[] = $path . ':' . ($number + 1);
        }
    }

    // The 3,435 SVGs plus the code, docs and workflows: a scan that stops
    // finding files reports a clean tree rather than a broken search.
    expect(count($files))->toBeGreaterThan(3_435)
        ->and($offenders)->toBe([], 'the former pack name is back in: ' . implode(', ', $offenders));
});

it(description: 'is registered under its current composer name', closure: function () {
    $composer = json_decode((string) file_get_contents(dirname(__DIR__, 2) . '/composer.json'), true, flags: JSON_THROW_ON_ERROR);

    expect($composer['name'])->toBe('ichava/icon-sets-twemoji')
        ->and($composer)->not->toHaveKey('replace');
});
