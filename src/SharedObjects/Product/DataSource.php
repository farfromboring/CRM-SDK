<?php
namespace CRM_SDK\SharedObjects\Product;

use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Traits\IDToArrayTrait;

class DataSource
{
    use APIObjectTrait;
    use IDAndNameTrait, IDToArrayTrait {
        IDToArrayTrait::toArray insteadof IDAndNameTrait;
    }

    //not a complete list
    const CUSTOM_PRODUCT = 2;
}