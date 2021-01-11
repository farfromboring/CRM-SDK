<?php
namespace CRM_SDK\ResponseObjects\PublicStores;

use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Traits\IDToArrayTrait;

class PageType
{
    use APIObjectTrait;
    use IDAndNameTrait, IDToArrayTrait {
        IDToArrayTrait::toArray insteadof IDAndNameTrait;
    }
}