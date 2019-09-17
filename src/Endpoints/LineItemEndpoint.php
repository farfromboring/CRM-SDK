<?php
namespace CRM_SDK\Endpoints;

use CRM_SDK\Client;
use CRM_SDK\Exceptions\APIBadRequestException;
use CRM_SDK\Exceptions\APIForbiddenException;
use CRM_SDK\Exceptions\APIInternalServerErrorException;
use CRM_SDK\Exceptions\APIResourceNotFoundException;
use CRM_SDK\Exceptions\APIUnauthorizedException;
use CRM_SDK\SharedObjects\Cart\Cart;
use CRM_SDK\SharedObjects\Cart\LineItem;
use GuzzleHttp\Exception\GuzzleException;

class LineItemEndpoint extends Client
{
    protected $endpoint ='/cart/line-item';

    /**
     * Gets a line item from a cart
     *
     * @param int $line_item_id
     * @return LineItem
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getLineItem(int $line_item_id)
    {
        $results = $this->get($this->endpoint, [
            'line_item_id' => $line_item_id,
        ]);

        return LineItem::create()->populateFromAPIResults($results);
    }

    /**
     * Adds a line item to a cart item
     *
     * $data can contain values for quantity, cost, price, name and more
     *
     * @param int $user_id
     * @param int $cart_item_id
     * @param int $quantity
     * @param int $type_id
     * @param array $data
     * @return LineItem
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function addLineItem(int $user_id, int $cart_item_id, int $quantity, ?int $type_id = null, array $data = [])
    {
        $results = $this->post($this->endpoint, [
            'user_id' => $user_id,
            'cart_item_id'=>$cart_item_id,
            'quantity'=>$quantity,
            'type_id'=>$type_id,
            'data'=>$data
        ]);

        return LineItem::create()->populateFromAPIResults($results);
    }

    /**
     * Updates a line item in a cart
     *
     * $data can contain values for quantity, cost, price, name and more
     *
     * @param int $line_item_id
     * @param array $data
     * @return LineItem
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function updateLineItem(int $line_item_id, array $data = [])
    {
        $results = $this->patch($this->endpoint, [
            'line_item_id'=>$line_item_id,
            'data'=>$data
        ]);

        return LineItem::create()->populateFromAPIResults($results);
    }

    /**
     * Removes a line item from a cart
     *
     * @param int $line_item_id
     * @return Cart|null
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     */
    public function removeLineItem(int $line_item_id)
    {
        return $this->delete($this->endpoint, [
            'line_item_id'=>$line_item_id
        ]);
    }
}