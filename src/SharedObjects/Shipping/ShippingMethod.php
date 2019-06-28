<?php
namespace CRM_SDK\SharedObjects\Order;

use CRM_SDK\SharedObjects\SharedObjectInterface;
use CRM_SDK\SharedObjects\Traits\CreateTrait;
use CRM_SDK\SharedObjects\Traits\IDAndNameTrait;
use CRM_SDK\SharedObjects\Traits\IDToArrayTrait;

class ShippingMethod implements SharedObjectInterface
{
    use CreateTrait;
    use IDAndNameTrait;
    use IDToArrayTrait;
}