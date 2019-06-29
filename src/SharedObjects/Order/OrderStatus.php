<?php
namespace CRM_SDK\SharedObjects\Order;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\CreateTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Traits\IDToArrayTrait;

class OrderStatus implements APIObjectInterface
{
    use CreateTrait;
    use IDToArrayTrait;
    use IDAndNameTrait;

    //not a complete list (others are subject to change, it's best you avoid hardcoding them)
    const COMPLETED = 20;
}