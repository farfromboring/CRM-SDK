<?php
namespace CRM_SDK\SharedObjects\Company;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\CreateTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Traits\IDToArrayTrait;

class Industry implements APIObjectInterface
{
    use CreateTrait;
    use IDToArrayTrait;
    use IDAndNameTrait;
}