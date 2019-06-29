<?php
namespace CRM_SDK\SharedObjects\Order;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Traits\IDToArrayTrait;

class ShippingMethod implements APIObjectInterface
{
    use APIObjectTrait;
    use IDAndNameTrait;
    use IDToArrayTrait;
}