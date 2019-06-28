<?php
namespace CRM_SDK\SharedObjects\Payment;

use CRM_SDK\DropdownInterface;
use CRM_SDK\SharedObjects\SharedObjectInterface;
use CRM_SDK\SharedObjects\Traits\CreateTrait;
use CRM_SDK\SharedObjects\Traits\IDAndNameTrait;
use CRM_SDK\SharedObjects\Traits\IDToArrayTrait;

class PaymentStatus implements SharedObjectInterface, DropdownInterface
{
    use CreateTrait;
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