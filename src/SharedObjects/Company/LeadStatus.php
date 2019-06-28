<?php
namespace CRM_SDK\SharedObjects\Company;

use CRM_SDK\DropdownInterface;
use CRM_SDK\SharedObjects\SharedObjectInterface;
use CRM_SDK\SharedObjects\Traits\CreateTrait;
use CRM_SDK\SharedObjects\Traits\IDAndNameTrait;
use CRM_SDK\SharedObjects\Traits\IDToArrayTrait;

class LeadStatus implements SharedObjectInterface, DropdownInterface
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