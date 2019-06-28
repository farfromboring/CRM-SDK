<?php
namespace CRM_SDK\SharedObjects\Payment;

use CRM_SDK\DropdownInterface;
use CRM_SDK\SharedObjects\SharedObjectInterface;
use CRM_SDK\SharedObjects\Traits\CreateTrait;
use CRM_SDK\SharedObjects\Traits\IDAndNameTrait;
use CRM_SDK\SharedObjects\Traits\IDToArrayTrait;

class PaymentTerms implements SharedObjectInterface, DropdownInterface
{
    use CreateTrait;
    use IDToArrayTrait;

    const PRE_PAYMENT = 1;
    const DUE_ON_RECEIPT = 2;
    const NET_10 = 9;
    const NET_15 = 3;
    const NET_30 = 4;
    const NET_45 = 5;
    const NET_60 = 6;
    const NET_90 = 10;

    use IDAndNameTrait;

    /**
     * @return array
     */
    public function dropdownOptions(): array
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