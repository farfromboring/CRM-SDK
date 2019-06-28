<?php
namespace CRM_SDK\Endpoints;

use CRM_SDK\Client;
use CRM_SDK\Exceptions\APIBadRequestException;
use CRM_SDK\Exceptions\APIForbiddenException;
use CRM_SDK\Exceptions\APIInternalServerErrorException;
use CRM_SDK\Exceptions\APIResourceNotFoundException;
use CRM_SDK\Exceptions\APIUnauthorizedException;
use CRM_SDK\SharedObjects\Cart\Cart;
use GuzzleHttp\Exception\GuzzleException;

class CartEndpoint extends Client
{
    protected $endpoint ='/cart';

    /**
     * Gets a cart, you can choose to retrieve the items in that cart as well
     * You may NOT want to include_items if you're just trying to show the number of items in their cart on page load
     *
     * Returns null if there isn't a cart yet for this user
     *
     * @param int $user_id
     * @param bool $include_items
     * @return Cart|null
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getCartForUser(int $user_id, bool $include_items = true)
    {
        $results = $this->get($this->endpoint, [
            'user_id' => $user_id,
            'include_items'=>$include_items
        ]);

        //if no cart
        if( !$results )
        {
            return null;
        }

        return Cart::create()->populateFromAPIResults($results);
    }
}