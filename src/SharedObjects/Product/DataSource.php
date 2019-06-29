<?php
namespace CRM_SDK\SharedObjects\Product;

use CRM_SDK\Traits\CreateTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Traits\IDToArrayTrait;

class DataSource
{
    use CreateTrait;
    use IDToArrayTrait;
    use IDAndNameTrait;

    //not a complete list
    const CUSTOM_PRODUCT = 2;
}