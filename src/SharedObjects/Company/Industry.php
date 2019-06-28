<?php
namespace CRM_SDK\SharedObjects\Company;

use CRM_SDK\SharedObjects\SharedObjectInterface;
use CRM_SDK\SharedObjects\Traits\CreateTrait;
use CRM_SDK\SharedObjects\Traits\IDAndNameTrait;
use CRM_SDK\SharedObjects\Traits\IDToArrayTrait;

class Industry implements SharedObjectInterface
{
    use CreateTrait;
    use IDToArrayTrait;
    use IDAndNameTrait;
}