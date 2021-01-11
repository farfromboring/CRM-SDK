<?php
namespace CRM_SDK\Traits;

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