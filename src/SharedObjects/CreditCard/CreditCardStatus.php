<?php
namespace CRM_SDK\SharedObjects\CreditCard;

use CRM_SDK\DropdownInterface;
use CRM_SDK\SharedObjects\SharedObjectInterface;
use CRM_SDK\SharedObjects\Traits\CreateTrait;
use CRM_SDK\SharedObjects\Traits\IDAndNameTrait;
use CRM_SDK\SharedObjects\Traits\IDToArrayTrait;

class CreditCardStatus implements SharedObjectInterface, DropdownInterface
{
    use CreateTrait;
    use IDToArrayTrait;
    use IDAndNameTrait;

    const ACTIVE = 1;
    const EXPIRED = 2;
    const DELETED = 3;

    /**
     * @return array
     */
    public function dropdownOptions(): array
    {
        return [
            self::ACTIVE=>'Active',
            self::EXPIRED=>'Expired',
            self::DELETED=>'Deleted'
        ];
    }
}