<?php
namespace CRM_SDK\Endpoints;

use CRM_SDK\Client;
use CRM_SDK\Exceptions\APIBadRequestException;
use CRM_SDK\Exceptions\APIForbiddenException;
use CRM_SDK\Exceptions\APIInternalServerErrorException;
use CRM_SDK\Exceptions\APIResourceNotFoundException;
use CRM_SDK\Exceptions\APIUnauthorizedException;
use CRM_SDK\SharedObjects\Supplier\Supplier;
use GuzzleHttp\Exception\GuzzleException;

class SupplierEndpoint extends Client
{
    protected $endpoint ='/supplier';

    /**
     * Gets a supplier's full details by ID
     *
     * @param int $supplier_id
     * @return Supplier
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getProduct(int $supplier_id)
    {
        $results = $this->get($this->endpoint, [
            'supplier_id' => $supplier_id,
        ]);

        return Supplier::create()->populateFromAPIResults($results);
    }
}