<?php

declare(strict_types=1);

namespace Simtabi\Laranail\Ichava\IconSetsEmoji\Providers;

use Simtabi\Laranail\Ichava\Providers\IconPackServiceProvider;
use Simtabi\Laranail\Ichava\IconSetsEmoji\Constants\IconsConstants;
use Simtabi\Laranail\Ichava\IconSetsEmoji\View\Components\IconComponent;

/**
 * Registers the Twemoji set with the Ichava registry.
 *
 *   - twemoji (Twitter/X, Twemoji 15 on the Unicode emoji 16.0 taxonomy, CC-BY 4.0 assets)
 *
 * OpenMoji is in ichava/icon-sets-openmoji.
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
