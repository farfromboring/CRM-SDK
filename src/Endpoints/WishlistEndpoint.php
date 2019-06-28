<?php
namespace CRM_SDK\Endpoints;

use CRM_SDK\Client;
use CRM_SDK\Exceptions\APIBadRequestException;
use CRM_SDK\Exceptions\APIForbiddenException;
use CRM_SDK\Exceptions\APIInternalServerErrorException;
use CRM_SDK\Exceptions\APIResourceNotFoundException;
use CRM_SDK\Exceptions\APIUnauthorizedException;
use CRM_SDK\ResponseObjects\Wishlist\Wishlist;
use GuzzleHttp\Exception\GuzzleException;

class WishlistEndpoint extends Client
{
    protected $endpoint ='/wishlist';

    /**
     * Gets a wishlist
     * You may NOT want to include_products if you're just trying to show the number of items in their wishlist on page load
     *
     * Returns null if there isn't a wishlist yet for this user
     *
     * @param int $user_id
     * @param bool $include_products
     * @return Wishlist
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getWishlistForUser(int $user_id, bool $include_products = true)
    {
        $results = $this->get($this->endpoint, [
            'user_id' => $user_id,
            'include_products'=>$include_products
        ]);

        //if no cart
        if( !$results )
        {
            return null;
        }

        return Wishlist::create()->populateFromAPIResults($results);
    }

    /**
     * Removes a product from a user's wishlist
     *
     * @param int $user_id
     * @param int $product_id
     * @return Wishlist
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     */
    public function removeFromWishlist(int $user_id, int $product_id)
    {
        return $this->delete($this->endpoint, [
            'user_id' => $user_id,
            'product_id'=>$product_id
        ]);
    }

    /**
     * Adds a product to a user's wishlist
     *
     * @param int $user_id
     * @param int $product_id
     * @return Wishlist
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     */
    public function addToWishlist(int $user_id, int $product_id)
    {
        return $this->post($this->endpoint, [
            'user_id' => $user_id,
            'product_id'=>$product_id
        ]);
    }
}