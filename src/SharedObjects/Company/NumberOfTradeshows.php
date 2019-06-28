<?php
namespace CRM_SDK\SharedObjects\Company;

use CRM_SDK\DropdownInterface;
use CRM_SDK\SharedObjects\SharedObjectInterface;
use CRM_SDK\SharedObjects\Traits\CreateTrait;
use CRM_SDK\SharedObjects\Traits\IDAndNameTrait;
use CRM_SDK\SharedObjects\Traits\IDToArrayTrait;

class NumberOfTradeshows implements SharedObjectInterface, DropdownInterface
{
    use CreateTrait;
    use IDToArrayTrait;
    use IDAndNameTrait;

    const ONE = 1;
    const TWO = 2;
    const THREE = 3;
    const FOUR = 4;
    const FIVE_AND_ABOVE = 5;

    /**
     * @return array
     */
    public function dropdownOptions(): array
    {
        return [
            self::ONE=>1,
            self::TWO=>2,
            self::THREE=>3,
            self::FOUR=>4,
            self::FIVE_AND_ABOVE=>'5+'
        ];
    }
}