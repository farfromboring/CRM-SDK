<?php
namespace CRM_SDK\SharedObjects\Cart;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Traits\IDToArrayTrait;

class ImprintMethod implements APIObjectInterface
{
    use APIObjectTrait;
    use IDAndNameTrait, IDToArrayTrait {
        IDToArrayTrait::toArray insteadof IDAndNameTrait;
    }

    const PAD_PRINT = 1;
    const SCREENPRINT = 2;
    const HEAT_TRANSFER = 3;
    const EMBROIDERY = 4;
    const LASER_ENGRAVED = 5;
    const FOIL_STAMPED = 6;
    const FULL_COLOR = 7;
    const ETCHED = 8;
    const SILKSCREEN = 9;
    const DEBOSS = 10;
    const DYE_SUBLIMINATION = 12;
    const DIE_STRUCK = 13;
    const BLANK = 14;
    const OTHER = 15;
    const HOT_STAMP = 16;
    const OFFSET = 17;
    const DECAL = 18;
    const DIGITAL = 19;
    const COLOR_PRINT = 20;
    const BRITEPIX = 21;
    const EPOXY_DOME = 22;
    const EMBOSSING = 23;
    const MOLDED = 24;
    const SPOT_COLOR = 25;
    const WOVEN = 26;
    const THREE_D = 27;
    const DIE_CUT = 28;
    const SILICONE_PRINT = 29;
    const LETTERPRESS = 30;
    const DIGITAL_DIRECT_IMPRINT = 31;
    /** @todo: Remove */
    /** @deprecated  */
    const SILKSCREEN_SECOND_COLOR_RUN_CHARGE = 32;
    const DIRECT_TO_GARMENT = 33;
    const APPLIQUE = 34;
    const TONE_ON_TONE = 35;
    const NEON_SIGN = 36;
    const FOUR_COLOR_PROCESS = 37;
    const CHROMA_PRINT = 38;
    /** @todo: Remove */
    /** @deprecated  */
    const MAIN_LABEL = 39;
    /** @todo Remove */
    /** @deprecated  */
    const ONE_COLOR_ONE_LOCATION = 40;
    const SIGNAGE = 41;
}