<?php
namespace CRM_SDK\SharedObjects\Address;

class AddressCollection extends \ArrayIterator
{
    /**
     * @param array $results
     * @return AddressCollection
     * @throws \Exception
     */
    public static function createFromAPIResults(array $results)
    {
        $addrs = [];
        foreach($results as $addr)
        {
            $addrs[] = Address::create()->populateFromAPIResults($addr);
        }

        return new self($addrs);
    }

    /**
     * Returns an array with the key as the address ID and the value as the address in a string format
     *
     * @return string[]
     */
    public function getAssociativeArray()
    {
        $addrs = [];

        /** @var Address $address */
        foreach($this as $address)
        {
            $addrs[$address->getId()] = $address->getAsString();
        }

        return $addrs;
    }
}