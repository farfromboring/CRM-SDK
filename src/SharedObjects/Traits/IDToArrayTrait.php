<?php
namespace CRM_SDK\SharedObjects\Traits;

trait IDToArrayTrait
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'=>$this->getId()
        ];
    }
}