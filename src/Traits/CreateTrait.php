<?php
namespace CRM_SDK\Traits;

trait CreateTrait
{
    /**
     * @return static
     */
    public static function create()
    {
        $called_class = static::class;
        return new $called_class();
    }
}