<?php

declare(strict_types=1);

use Simtabi\Laranail\Ichava\Services\IconRegistry;
use Simtabi\Laranail\Ichava\IconSetsTwemoji\Enums\Set;
use Simtabi\Laranail\Ichava\IconSetsTwemoji\Enums\Category;
use Simtabi\Laranail\Ichava\IconSetsTwemoji\Constants\IconsConstants;
use Simtabi\Laranail\Ichava\IconSetsTwemoji\Providers\IconsServiceProvider;

it('provider boots without error', function (): void {
    $providers = array_keys($this->app->getLoadedProviders());

    $this->assertContains(
        IconsServiceProvider::class,
        $providers,
    );
});

it('constants resolve from config json', function (): void {
    $this->assertSame('ichava/icon-sets-twemoji', IconsConstants::getVendorPackage());
    $this->assertSame('Twemoji', IconsConstants::getTitle());
    $this->assertSame('twemoji', IconsConstants::getPrefix());
});

it('set enum helpers use config prefix', function (): void {
    // The Set enum is the canonical variant axis for this pack. The
    // class helpers should namespace each set with the config prefix.
    $this->assertSame('twemoji-twemoji', Set::TWEMOJI->getClass());
    $this->assertSame(['twemoji'], array_map(static fn (Set $set): string => $set->value, Set::cases()));
});

it('default set falls back to twemoji', function (): void {
    // No "default": true is set on the categories in config.json, so
    // HasIconSetVariants::default() should fall through to Set::getDefaultValue(),
    // which returns TWEMOJI as the project-wide default.
    $default = Set::default();

    $this->assertSame(Set::TWEMOJI, $default);
    $this->assertTrue(Set::TWEMOJI->isDefault());
});

it('category enum lists unicode cldr groups', function (): void {
    // The 10 canonical Unicode emoji groups, in CLDR display order.
    $ordered = array_map(fn (Category $c) => $c->value, Category::ordered());

    $this->assertSame(
        [
            'smileys-emotion',
            'people-body',
            'component',
            'animals-nature',
            'food-drink',
            'travel-places',
            'activities',
            'objects',
            'symbols',
            'flags',
        ],
        $ordered,
    );
});

it('category labels are human readable', function (): void {
    // Picker UIs render `label()` directly, so this contract is
    // load-bearing for anyone consuming the enum.
    $this->assertSame('Smileys & Emotion', Category::SMILEYS_EMOTION->label());
    $this->assertSame('Animals & Nature', Category::ANIMALS_NATURE->label());
    $this->assertSame('Travel & Places', Category::TRAVEL_PLACES->label());
});

it('icon registry picks up the package', function (): void {
    /** @var IconRegistry $registry */
    $registry = $this->app->make(IconRegistry::class);

    $this->assertTrue(
        $registry->isRegistered('ichava/icon-sets-twemoji'),
        'IconRegistry should have ichava/icon-sets-twemoji registered after boot.',
    );
});
