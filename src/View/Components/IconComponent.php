<?php

declare(strict_types=1);

namespace Simtabi\Laranail\Ichava\IconSetsTwemoji\View\Components;

use Simtabi\Laranail\Ichava\IconSetsTwemoji\Constants\IconsConstants;
use Simtabi\Laranail\Ichava\View\Components\IconComponent as BaseIconComponent;

/**
 * Blade component for the icon-sets-twemoji pack.
 *
 * Usage:
 *
 *   {{-- Full form: pick a set + Unicode CLDR group + slug --}}
 *   <x-icon-sets-twemoji-icon name="twemoji/smileys-emotion/grinning-face" />
 *
 *   {{-- Default set (twemoji) -- short form skips the set segment --}}
 *   <x-icon-sets-twemoji-icon name="smileys-emotion/grinning-face" />
 *
 *   {{-- Via the generic Ichava engine --}}
 *   <x-ichava::icon name="ichava/icon-sets-twemoji::twemoji/flags/flag-japan" />
 */
class IconComponent extends BaseIconComponent
{
    protected function getIconSet(): string
    {
        return IconsConstants::getPackageName();
    }

    protected function getVendorPackage(): string
    {
        return IconsConstants::getVendorPackage();
    }
}
