<?php

declare(strict_types=1);

namespace Simtabi\Laranail\Ichava\IconSetsEmoji\Providers;

use Simtabi\Laranail\Ichava\Support\IconPackServiceProvider;
use Simtabi\Laranail\Ichava\IconSetsEmoji\Constants\IconsConstants;
use Simtabi\Laranail\Ichava\IconSetsEmoji\View\Components\IconComponent;

/**
 * Registers the multi-set emoji collection with the Ichava registry.
 *
 * Ships three emoji sets in v1.0:
 *
 *   - twemoji        (Twitter/X, Unicode 17, CC-BY 4.0 assets)
 *   - openmoji-color (community-driven flat colourful, CC-BY-SA 4.0)
 *   - openmoji-black (monochrome variant, CC-BY-SA 4.0)
 *
 * The two OpenMoji sets are deprecated since 0.1.0 in favour of
 * ichava/icon-sets-openmoji, which holds the same art. They stay supported
 * here. With that pack installed, core resolves their ids there and does
 * not seed this pack's copies.
 *
 * Within each set, files are grouped by Unicode CLDR category
 * (smileys-emotion, people-body, animals-nature, ...) so picker UIs
 * can browse cleanly. See ATTRIBUTION.md for source + licence details.
 */
class IconsServiceProvider extends IconPackServiceProvider
{
    protected function constantsClass(): string
    {
        return IconsConstants::class;
    }

    protected function componentClass(): string
    {
        return IconComponent::class;
    }
}
