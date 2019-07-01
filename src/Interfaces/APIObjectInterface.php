<?php
namespace CRM_SDK\Interfaces;

interface APIObjectInterface
{
    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @param array $results
     */
    public function populateFromAPIResults(array $results);

    /**
     * @return static
     */
    public static function create();
}