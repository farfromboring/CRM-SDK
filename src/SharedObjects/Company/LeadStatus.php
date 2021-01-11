<?php
namespace CRM_SDK\SharedObjects\Company;

use CRM_SDK\Interfaces\DropdownInterface;
use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Traits\IDToArrayTrait;

class LeadStatus implements APIObjectInterface, DropdownInterface
{
    use APIObjectTrait;
    use IDAndNameTrait, IDToArrayTrait {
        IDToArrayTrait::toArray insteadof IDAndNameTrait;
    }

    const OPEN = 1;
    const CONTACTED = 2;
    const UNQUALIFIED = 3;

    /**
     * @return array
     */
    public static function dropdownOptions(): array
    {
        return [
          self::OPEN=>'Open',
          self::CONTACTED=>'Contacted',
          self::UNQUALIFIED=>'Unqualified'
        ];
    }
}