<?php
namespace CRM_SDK\SharedObjects\Order;

use CRM_SDK\SharedObjects\SharedObjectInterface;
use CRM_SDK\SharedObjects\Traits\CreateTrait;
use CRM_SDK\SharedObjects\Traits\IDAndNameTrait;
use CRM_SDK\SharedObjects\Traits\IDToArrayTrait;

class PaymentMethod implements SharedObjectInterface
{
    use CreateTrait;
    use IDToArrayTrait;
    use IDAndNameTrait;

    //may not be a complete list
    const CREDIT_CARD = 1;
    const CHECK = 2;
    const WIRE_ACH = 3;
    const CRYPTOCURRENCY = 7;
    const CASH = 8;
    const PAYPAL = 9;
}