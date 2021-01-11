<?php
namespace CRM_SDK\Traits;

trait CreateTrait
{
    /**
     * @param string|null $api_key
     * @param int|null $version
     * @param \GuzzleHttp\Client|null $client
     * @return static
     */
    public static function create(?string $api_key = null, ?int $version = null, ?\GuzzleHttp\Client $client = null)
    {
        $called_class = static::class;
        return new $called_class($api_key, $version, $client);
    }
}