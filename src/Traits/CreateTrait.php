<?php
namespace CRM_SDK\Traits;

trait CreateTrait
{
    /**
     * @return mixed
     */
    public static function create()
    {
        return new self();
    }
}