<?php
namespace CRM_SDK\SharedObjects\Order;

use CRM_SDK\SharedObjects\SharedObjectInterface;
use CRM_SDK\SharedObjects\Traits\CreateTrait;
use CRM_SDK\SharedObjects\Traits\IDAndNameTrait;
use CRM_SDK\SharedObjects\Traits\IDToArrayTrait;

class ShippingCarrier implements SharedObjectInterface
{
    use CreateTrait;
    use IDToArrayTrait;
    use IDAndNameTrait;

    //not a complete list
    const USPS = 1;
    const FEDEX = 2;
    const UPS = 3;
    const DHL_EXPRESS = 4;
    const LASERSHIP = 15;
    const CANADA_POST = 16;
    const AUSTRALIA_POST = 17;
    // ..

}