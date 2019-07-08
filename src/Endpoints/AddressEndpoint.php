<?php
namespace CRM_SDK\Endpoints;

use CRM_SDK\Client;
use CRM_SDK\Exceptions\APIBadRequestException;
use CRM_SDK\Exceptions\APIForbiddenException;
use CRM_SDK\Exceptions\APIInternalServerErrorException;
use CRM_SDK\Exceptions\APIResourceNotFoundException;
use CRM_SDK\Exceptions\APIUnauthorizedException;
use CRM_SDK\SharedObjects\Address\Address;
use GuzzleHttp\Exception\GuzzleException;

class AddressEndpoint extends Client
{
    protected $endpoint ='/address';

    /**
     * Allows you to add a new address to a company
     *
     * @param int $company_id
     * @param Address $address
     * @return Address
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function addAddress(int $company_id, Address &$address)
    {
        $results = $this->post($this->endpoint, [
            'company_id'=>$company_id,
            'address'=>$address->toArray(),
        ]);

        return Address::create()->populateFromAPIResults($results);
    }

    /**
     * Allows you to update an address
     *
     * Addresses are not truly editable if certain conditions are met, in this case,
     * a new address will be added and the one you're trying to edit will be deleted.
     *
     * If that happens the Address object that is returned will contain the new address ID
     *
     * @param Address $address
     * @return Address
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function updateAddress(Address &$address)
    {
        $results = $this->patch($this->endpoint, [
            'address'=>$address->toArray(),
        ]);

        return Address::create()->populateFromAPIResults($results);
    }

    /**
     * Allows you to update an address
     *
     * Addresses are not truly editable if certain conditions are met, in this case,
     * a new address will be added and the one you're trying to edit will be deleted.
     *
     * If that happens the Address object that is returned will contain the new address ID
     *
     * @param int $address_id
     * @return mixed
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     */
    public function deleteAddress(int $address_id)
    {
        return $this->delete($this->endpoint, [
            'address_id'=>$address_id,
        ]);
    }
}