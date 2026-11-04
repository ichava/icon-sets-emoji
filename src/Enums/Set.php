<?php

declare(strict_types=1);

namespace Simtabi\Laranail\Ichava\IconSetsEmoji\Enums;

use Simtabi\Laranail\Ichava\Traits\HasIconSetVariants;
use Simtabi\Laranail\Ichava\Contracts\IconSetVariantInterface;
use Simtabi\Laranail\Ichava\IconSetsEmoji\Constants\IconsConstants;

/**
 * The emoji *source* (style/artist).
 *
 * Cases mirror the top-level directories under `resources/assets/svg/files/`
 * and the keys under `metadata.data.categories` in the package config.json.
 *
 * This is the enum the Ichava engine treats as the canonical variant
 * dimension (it implements IconSetVariantInterface). The orthogonal
 * Unicode CLDR grouping (smileys, animals, food, ...) lives in
 * the sibling ``Category`` enum -- they classify two different axes.
 */
enum Set: string implements IconSetVariantInterface
{
    use HasIconSetVariants;

    case TWEMOJI = 'twemoji';
    /**
     * @deprecated since 0.1.0: prefer `Set::OPENMOJI_COLOR` in ichava/icon-sets-openmoji,
     *             the same art in a pack of its own. It stays supported here;
     *             with that pack installed its ids resolve there.
     */
    case OPENMOJI_COLOR = 'openmoji-color';

    /**
     * @deprecated since 0.1.0: prefer `Set::OPENMOJI_BLACK` in ichava/icon-sets-openmoji,
     *             the same art in a pack of its own. It stays supported here;
     *             with that pack installed its ids resolve there.
     */
    case OPENMOJI_BLACK = 'openmoji-black';

    public function getPath(): string
    {
        return IconsConstants::getSvgPath($this->value);
    }

    private static function getDefaultValue(): string
    {
        return IconsConstants::getDefaultCategory() ?? self::TWEMOJI->value;
    }

    private static function getClassPrefix(): string
    {
        return IconsConstants::getPrefix();
    }
}
