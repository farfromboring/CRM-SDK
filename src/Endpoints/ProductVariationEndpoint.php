<?php
namespace CRM_SDK\Endpoints;

use CRM_SDK\Client;
use CRM_SDK\Exceptions\APIBadRequestException;
use CRM_SDK\Exceptions\APIForbiddenException;
use CRM_SDK\Exceptions\APIInternalServerErrorException;
use CRM_SDK\Exceptions\APIResourceNotFoundException;
use CRM_SDK\Exceptions\APIUnauthorizedException;
use CRM_SDK\SharedObjects\Cart\Cart;
use CRM_SDK\SharedObjects\Cart\ProductVariation;
use GuzzleHttp\Exception\GuzzleException;

class ProductVariationEndpoint extends Client
{
    protected $endpoint ='/cart/line-item';

    /**
     * Gets a product variation from a cart
     *
     * @param int $variation_id
     * @return ProductVariation
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getProductVariation(int $variation_id)
    {
        $results = $this->get($this->endpoint, [
            'line_item_id' => $variation_id,
        ]);

        return ProductVariation::create()->populateFromAPIResults($results);
    }

    /**
     * Updates a product variation in a cart
     *
     * $data can contain values for quantity, cost, price and more
     *
     * @param int $variation_id
     * @param array $data
     * @return ProductVariation
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function updateVariation(int $variation_id, array $data = [])
    {
        $results = $this->patch($this->endpoint, [
            'line_item_id'=>$variation_id,
            'data'=>$data
        ]);

        return ProductVariation::create()->populateFromAPIResults($results);
    }

    /**
     * Removes a product variation from a cart
     *
     * @param int $variation_id
     * @return Cart|null
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     */
    public function removeVariation(int $variation_id)
    {
        return $this->delete($this->endpoint, [
            'line_item_id'=>$variation_id
        ]);
    }
}