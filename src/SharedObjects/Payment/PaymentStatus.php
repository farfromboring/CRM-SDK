<?php
namespace CRM_SDK\SharedObjects\Payment;

use CRM_SDK\Interfaces\DropdownInterface;
use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Traits\IDToArrayTrait;

class PaymentStatus implements APIObjectInterface, DropdownInterface
{
    use APIObjectTrait;
    use IDAndNameTrait;
    use IDToArrayTrait;

    const INVOICE_NOT_SENT = 1;
    const INVOICE_SENT = 2;
    const PAID = 3;
    const REFUNDED = 4;

    /**
     * @return array
     */
    public function dropdownOptions(): array
    {
        return [
          self::INVOICE_NOT_SENT=>'Invoice Not Sent',
          self::INVOICE_SENT=>'Invoice Sent',
          self::PAID=>'Paid',
          self::REFUNDED=>'Refunded'
        ];
    }
}