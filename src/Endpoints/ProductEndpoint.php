<?php
namespace CRM_SDK\Endpoints;

use CRM_SDK\Client;
use CRM_SDK\Exceptions\APIBadRequestException;
use CRM_SDK\Exceptions\APIForbiddenException;
use CRM_SDK\Exceptions\APIInternalServerErrorException;
use CRM_SDK\Exceptions\APIResourceNotFoundException;
use CRM_SDK\Exceptions\APIUnauthorizedException;
use CRM_SDK\SharedObjects\Product\Product;
use CRM_SDK\SharedObjects\Product\UnavailableProduct;
use GuzzleHttp\Exception\GuzzleException;

class ProductEndpoint extends Client
{
    protected $endpoint ='/product';

    /**
     * Gets a product's full details by ID
     *
     * @param int $product_id
     * @param int $include_how_many_related_products
     * @return Product
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getProduct(int $product_id, int $include_how_many_related_products = 0)
    {
        $results = $this->get($this->endpoint, [
            'product_id' => $product_id,
            'include_related' => $include_how_many_related_products
        ]);

        if( $results['is_available'] != '1' )
        {
            return UnavailableProduct::create()->populateFromAPIResults($results);
        }

        return Product::create()->populateFromAPIResults($results);
    }
}