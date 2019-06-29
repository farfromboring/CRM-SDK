<?php
namespace CRM_SDK\SharedObjects\Company;

use CRM_SDK\Interfaces\DropdownInterface;
use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\CreateTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Traits\IDToArrayTrait;

class NumberOfEmployees implements APIObjectInterface, DropdownInterface
{
    use CreateTrait;
    use IDToArrayTrait;
    use IDAndNameTrait;

    const ONE_TO_TEN = 1;
    const ELEVEN_TO_TWENTY = 2;
    const TWENTY_ONE_TO_FIFTY = 3;
    const FIFTY_ONE_TO_SEVENTY_FIVE = 4;
    const ONE_HUNDRED_AND_ONE_TO_ONE_FIFTY = 5;
    const ONE_FIFTY_ONE_TO_TWO_HUNDRED = 6;
    const TWO_HUNDRED_AND_ONE_AND_ABOVE = 7;

    /**
     * @return array
     */
    public function dropdownOptions(): array
    {
        return [
            self::ONE_TO_TEN=>'1-10',
            self::ELEVEN_TO_TWENTY=>'11-20',
            self::TWENTY_ONE_TO_FIFTY=>'21-50',
            self::FIFTY_ONE_TO_SEVENTY_FIVE=>'51-75',
            self::ONE_HUNDRED_AND_ONE_TO_ONE_FIFTY=>'101-150',
            self::ONE_FIFTY_ONE_TO_TWO_HUNDRED=>'151-200',
            self::TWO_HUNDRED_AND_ONE_AND_ABOVE=>'201+',
        ];
    }
}