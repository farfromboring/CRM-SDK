<?php
namespace CRM_SDK\Endpoints;

use CRM_SDK\Client;
use CRM_SDK\Exceptions\APIBadRequestException;
use CRM_SDK\Exceptions\APIForbiddenException;
use CRM_SDK\Exceptions\APIInternalServerErrorException;
use CRM_SDK\Exceptions\APIResourceNotFoundException;
use CRM_SDK\Exceptions\APIUnauthorizedException;
use CRM_SDK\SharedObjects\Cart\Cart;
use CRM_SDK\SharedObjects\Cart\CartItem;
use GuzzleHttp\Exception\GuzzleException;

class CartItemEndpoint extends Client
{
    protected $endpoint ='/cart/item';

    /**
     * Adds an item to a cart
     *
     * @param int $cart_item_id
     * @return CartItem
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getItem(int $cart_item_id)
    {
        $results = $this->get($this->endpoint, [
            'cart_item_id' => $cart_item_id,
        ]);

        return CartItem::create()->populateFromAPIResults($results);
    }

    /**
     * Adds an item to a cart
     *
     * @param int $user_id
     * @param int $product_id
     * @param int $quantity
     * @param array $data
     * @return CartItem
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function addItem(int $user_id, int $product_id, int $quantity, array $data = [])
    {
        $results = $this->post($this->endpoint, [
            'user_id' => $user_id,
            'product_id'=>$product_id,
            'quantity'=>$quantity,
            'data'=>$data
        ]);

        return CartItem::create()->populateFromAPIResults($results);
    }

    /**
     * Updates an item in a cart
     *
     * $data can contain values for quantity, decoration, attributes and more
     *
     * @param int $cart_item_id
     * @param array $data
     * @return CartItem
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function updateItem(int $cart_item_id, array $data = [])
    {
        $results = $this->patch($this->endpoint, [
            'cart_item_id'=>$cart_item_id,
            'data'=>$data
        ]);

        return CartItem::create()->populateFromAPIResults($results);
    }

    /**
     * Removes an item from a cart
     *
     * @param int $cart_item_id
     * @return Cart|null
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     */
    public function removeItem(int $cart_item_id)
    {
        return $this->delete($this->endpoint, [
            'cart_item_id'=>$cart_item_id
        ]);
    }
}