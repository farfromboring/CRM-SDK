<?php
namespace CRM_SDK\SharedObjects\Traits;

trait CreateTrait
{
    /**
     * @return self
     */
    public static function create()
    {
        return new self();
    }
}