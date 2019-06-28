<?php
namespace CRM_SDK\SharedObjects;

interface SharedObjectInterface
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
     * @return self
     */
    public static function create();
}