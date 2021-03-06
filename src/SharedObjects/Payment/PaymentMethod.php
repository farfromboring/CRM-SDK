<?php
namespace CRM_SDK\SharedObjects\Payment;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Traits\IDToArrayTrait;

class PaymentMethod implements APIObjectInterface
{
    use APIObjectTrait;
    use IDAndNameTrait, IDToArrayTrait {
        IDToArrayTrait::toArray insteadof IDAndNameTrait;
    }

    //may not be a complete list
    const CREDIT_CARD = 1;
    const CHECK = 2;
    const WIRE_ACH = 3;
    const CRYPTOCURRENCY = 7;
    const CASH = 8;
    const PAYPAL = 9;
}