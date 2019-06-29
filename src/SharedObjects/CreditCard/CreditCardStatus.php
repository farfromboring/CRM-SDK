<?php
namespace CRM_SDK\SharedObjects\CreditCard;

use CRM_SDK\Interfaces\DropdownInterface;
use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Traits\IDToArrayTrait;

class CreditCardStatus implements APIObjectInterface, DropdownInterface
{
    use APIObjectTrait;
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