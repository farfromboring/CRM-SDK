<?php
namespace CRM_SDK\Traits;

trait CreateTrait
{
    /**
     * @return mixed
     */
    public static function create()
    {
        $called_class = static::class;
        return new $called_class();
    }
}