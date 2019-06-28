<?php
namespace CRM_SDK\SharedObjects\Address;

use CRM_SDK\SharedObjects\Traits\CreateTrait;
use CRM_SDK\SharedObjects\Traits\IDTrait;
use CRM_SDK\SharedObjects\SharedObjectInterface;

class Address implements SharedObjectInterface
{
    use CreateTrait;
    use IDTrait;

    /** @var boolean */
    private $isBusiness;
    /** @var string|null */
    private $businessName;

    /** @var boolean */
    private $isShippingAddress = true;
    /** @var boolean */
    private $isPrimaryShippingAddress = true;
    /** @var boolean */
    private $isBillingAddress = true;
    /** @var boolean */
    private $isPrimaryBillingAddress = true;

    /** @var string */
    private $address;
    /** @var string|null */
    private $address2;
    /** @var string */
    private $city;
    /** @var string */
    private $state;
    /** @var string */
    private $zipcode;
    /** @var string */
    private $countryCode;

    /**
     * @param array $results
     * @return Address
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);

        $this->setIsBusiness((bool) $results['is_business']);
        $this->setBusinessName($results['business_name']);

        $this->setIsShippingAddress((bool) $results['is_shipping_address']);
        $this->setIsPrimaryShippingAddress((bool) $results['is_primary_shipping_address']);
        $this->setIsBillingAddress((bool) $results['is_billing_address']);
        $this->setIsPrimaryBillingAddress((bool) $results['is_primary_billing_address']);

        $this->setAddress($results['address']);
        $this->setAddress2($results['address2']);
        $this->setCity($results['city']);
        $this->setState($results['state']);
        $this->setZipcode($results['zipcode']);
        $this->setCountryCode($results['country_code']);

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'=>$this->getId(),

            'is_business'=>$this->isBusiness(),
            'business_name'=>$this->getBusinessName(),

            'is_shipping_address'=>$this->isShippingAddress(),
            'is_primary_shipping'=>$this->isPrimaryShippingAddress(),
            'is_billing_address'=>$this->isBillingAddress(),
            'is_primary_billing'=>$this->isPrimaryBillingAddress(),

            'address'=>$this->getAddress(),
            'address2'=>$this->getAddress2(),
            'city'=>$this->getCity(),
            'state'=>$this->getState(),
            'zipcode'=>$this->getZipcode(),
            'country_code'=>$this->getCountryCode(),
        ];
    }

    /**
     * @return bool
     */
    public function isBusiness(): bool
    {
        return $this->isBusiness;
    }

    /**
     * @param bool $isBusiness
     * @return Address
     */
    public function setIsBusiness(bool $isBusiness): Address
    {
        $this->isBusiness = $isBusiness;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBusinessName(): ?string
    {
        return $this->businessName;
    }

    /**
     * @param string|null $businessName
     * @return Address
     */
    public function setBusinessName(?string $businessName): Address
    {
        $this->businessName = $businessName;
        return $this;
    }

    /**
     * @return bool
     */
    public function isShippingAddress(): bool
    {
        return $this->isShippingAddress;
    }

    /**
     * @param bool $isShippingAddress
     * @return Address
     */
    public function setIsShippingAddress(bool $isShippingAddress): Address
    {
        $this->isShippingAddress = $isShippingAddress;
        return $this;
    }

    /**
     * @return bool
     */
    public function isBillingAddress(): bool
    {
        return $this->isBillingAddress;
    }

    /**
     * @param bool $isBillingAddress
     * @return Address
     */
    public function setIsBillingAddress(bool $isBillingAddress): Address
    {
        $this->isBillingAddress = $isBillingAddress;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPrimaryShippingAddress(): bool
    {
        return $this->isPrimaryShippingAddress;
    }

    /**
     * @param bool $isPrimaryShippingAddress
     * @return Address
     */
    public function setIsPrimaryShippingAddress(bool $isPrimaryShippingAddress): Address
    {
        $this->isPrimaryShippingAddress = $isPrimaryShippingAddress;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPrimaryBillingAddress(): bool
    {
        return $this->isPrimaryBillingAddress;
    }

    /**
     * @param bool $isPrimaryBillingAddress
     * @return Address
     */
    public function setIsPrimaryBillingAddress(bool $isPrimaryBillingAddress): Address
    {
        $this->isPrimaryBillingAddress = $isPrimaryBillingAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Address
     */
    public function setAddress(string $address): Address
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    /**
     * @param string|null $address2
     * @return Address
     */
    public function setAddress2(?string $address2): Address
    {
        $this->address2 = $address2;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Address
     */
    public function setCity(string $city): Address
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return Address
     */
    public function setState(string $state): Address
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return string
     */
    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    /**
     * @param string $zipcode
     * @return Address
     */
    public function setZipcode(string $zipcode): Address
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     * @return Address
     */
    public function setCountryCode(string $countryCode): Address
    {
        $this->countryCode = $countryCode;
        return $this;
    }
}