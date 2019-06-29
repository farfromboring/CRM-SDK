<?php
namespace CRM_SDK\SharedObjects\Product;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Traits\IDToArrayTrait;

class Catalog implements APIObjectInterface
{
    use APIObjectTrait;
    use IDToArrayTrait;
    use IDAndNameTrait;
}