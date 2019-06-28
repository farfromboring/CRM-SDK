<?php
namespace CRM_SDK\SharedObjects\Product;

use CRM_SDK\SharedObjects\Traits\CreateTrait;
use CRM_SDK\SharedObjects\Traits\IDAndNameTrait;
use CRM_SDK\SharedObjects\Traits\IDToArrayTrait;

class DataSource
{
    use CreateTrait;
    use IDToArrayTrait;
    use IDAndNameTrait;

    //not a complete list
    const CUSTOM_PRODUCT = 2;
}