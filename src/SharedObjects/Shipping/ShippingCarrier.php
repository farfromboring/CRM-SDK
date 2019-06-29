<?php
namespace CRM_SDK\SharedObjects\Order;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Traits\IDToArrayTrait;

class ShippingCarrier implements APIObjectInterface
{
    use APIObjectTrait;
    use IDAndNameTrait, IDToArrayTrait {
        IDToArrayTrait::toArray insteadof IDAndNameTrait;
    }

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