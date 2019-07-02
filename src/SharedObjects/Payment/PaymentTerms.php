<?php
namespace CRM_SDK\SharedObjects\Payment;

use CRM_SDK\Interfaces\DropdownInterface;
use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Traits\IDToArrayTrait;

class PaymentTerms implements APIObjectInterface, DropdownInterface
{
    use APIObjectTrait;
    use IDAndNameTrait, IDToArrayTrait {
        IDToArrayTrait::toArray insteadof IDAndNameTrait;
    }

    const PRE_PAYMENT = 1;
    const DUE_ON_RECEIPT = 2;
    const NET_10 = 9;
    const NET_15 = 3;
    const NET_30 = 4;
    const NET_45 = 5;
    const NET_60 = 6;
    const NET_90 = 10;

    /**
     * @return array
     */
    public static function dropdownOptions(): array
    {
        return [
            self::PRE_PAYMENT=>'Pre-Payment',
            self::DUE_ON_RECEIPT=>'Due Upon Receipt',
            self::NET_10=>'Net 10',
            self::NET_15=>'Net 15',
            self::NET_30=>'Net 30',
            self::NET_45=>'Net 45',
            self::NET_60=>'Net 60',
            self::NET_90=>'Net 90',
        ];
    }
}