<?php
namespace CRM_SDK\SharedObjects\Company;

use CRM_SDK\Interfaces\DropdownInterface;
use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\CreateTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Traits\IDToArrayTrait;

class LeadStatus implements APIObjectInterface, DropdownInterface
{
    use CreateTrait;
    use IDToArrayTrait;
    use IDAndNameTrait;

    const OPEN = 1;
    const CONTACTED = 2;
    const UNQUALIFIED = 3;

    /**
     * @return array
     */
    public function dropdownOptions(): array
    {
        return [
          self::OPEN=>'Open',
          self::CONTACTED=>'Contacted',
          self::UNQUALIFIED=>'Unqualified'
        ];
    }
}