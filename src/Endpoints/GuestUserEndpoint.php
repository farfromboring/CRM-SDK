<?php
namespace CRM_SDK\Endpoints;

use CRM_SDK\Client;
use CRM_SDK\Exceptions\APIBadRequestException;
use CRM_SDK\Exceptions\APIForbiddenException;
use CRM_SDK\Exceptions\APIInternalServerErrorException;
use CRM_SDK\Exceptions\APIResourceNotFoundException;
use CRM_SDK\Exceptions\APIUnauthorizedException;
use CRM_SDK\SharedObjects\User\Guest;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class GuestUserEndpoint extends Client
{
    /** @var string  */
    const GUEST_USER_TOKEN = 'guest_token';

    /** @var string  */
    const GUEST_TOKEN_COOKIE = 'guest_token';

    /** @var int - 1 hour */
    const cookieExpiration = 3600;

    protected $endpoint ='/user/guest';

    /**
     * Gets guest user by token, defaults to grabbing from the cookie
     *
     * Warning: Every X minutes this token is invalidated and a new one is sent back. At that point the cookie is also updated.
     *
     * @param string|null $token
     * @return Guest
     * @throws GuzzleException
     * @throws \Throwable
     */
    public function getGuest(?string $token = null)
    {
        //fall back to grabbing the token from the cookie
        $token = $token ?: self::getGuestTokenFromCookie();

        //if none, can't get guest
        if( !$token )
        {
            return null;
        }

        try
        {
            $results = $this->get($this->endpoint, [
                'guest_token' => $_COOKIE[self::GUEST_TOKEN_COOKIE],
            ]);
        }
        catch(\Throwable $t)
        {
            if( $t->getMessage() === 'Guest token does not exist or has expired' )
            {
//                self::clearGuestCookie();
                return null;
            }

            throw $t;
        }

        return Guest::create()->populateFromAPIResults($results); //cookie is saved in the constructor so you can run getGuest() later without params
    }

    /**
     * Updates a guest user
     *
     * //Get the guest
     * $guest = (new GuestUserEndpoint())->getGuest(); //or GuestUserEndpoint()::create()->getGuest();
     * //update something
     * $guest->setFname('Bob');
     * //update the company if you'd like
     * $guest->getCompany()->setName('Bob Co.');
     *
     * $updated_guest = $sdk->updateGuest($guest);
     *
     * @param Guest $guest
     * @return Guest
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws Exception
     */
    public function updateGuest(Guest $guest)
    {
        $results = $this->patch($this->endpoint, [
            'guest'=>$guest->toArray()
        ]);

        return Guest::create()->populateFromAPIResults($results); //cookie is saved in the constructor so you can run getGuest() later without params
    }

    /**
     * Adds a guest user (doesn't log them in or generate a password, but it does create a unique token, which is automatically stored
     * in a cookie and used for subsequent requests to attempt to tie everything to the same person)
     *
     * If you don't have ANY information about the user (like someone who adds a product to their cart),
     * then don't pass the Guest object and it'll create a blank Guest.
     *
     * $guest = new Guest(); //or Guest::create()
     * $guest->setFname('Bob');
     * $guest->setLname('Jenkins');
     * $guest->setEmail('bob@jenkins.com');
     *
     * $company = new Company(); //or Company::create()
     * $company->setName('Jenkins Co');
     *
     * $guest->setCompany($company);
     *
     * $new_guest = $sdk->addGuest($guest);
     *
     * If user or guest with this email address already exists (latest one to login),
     * the existing user and their info will be returned - nothing will be updated
     * WARNING: DO NOT LOG THIS PERSON INTO THE SITE!
     *
     * @param Guest $guest
     * @return Guest
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws Exception
     */
    public function addGuest(?Guest $guest = null)
    {
        $results = $this->post($this->endpoint, [
            'guest'=>($guest ? $guest->toArray() : null)
        ]);

        return Guest::create()->populateFromAPIResults($results); //cookie is saved in the constructor so you can run getGuest() later without params
    }

    /**
     * Gets the Guest's token from the cookie, if exists
     *
     * @return string|null
     */
    public static function getGuestTokenFromCookie()
    {
        return !empty($_COOKIE[self::GUEST_TOKEN_COOKIE]) ? $_COOKIE[self::GUEST_TOKEN_COOKIE] : null;
    }

    /**
     * Sets the Guest's token in a cookie - expiration default set as a constant above
     *
     * @param string $token
     * @param int|null $expiration_in_seconds
     * @return bool
     */
    public static function setGuestCookie(string $token, ?int $expiration_in_seconds = null)
    {
        $expiration_in_seconds = $expiration_in_seconds ?: self::cookieExpiration;

        //for this request in case there are additional API calls
        $_COOKIE[GuestUserEndpoint::GUEST_TOKEN_COOKIE] = $token;

        //for the browser
        $expiration_in_seconds = time()+$expiration_in_seconds;
        return setcookie(GuestUserEndpoint::GUEST_TOKEN_COOKIE, $token, $expiration_in_seconds, '/');
    }

    /**
     * Unsets the guest's token cookie
     *
     * @return bool
     */
    public static function clearGuestCookie()
    {
        unset($_COOKIE[self::GUEST_TOKEN_COOKIE]);
        return setcookie(GuestUserEndpoint::GUEST_TOKEN_COOKIE, null, 1, '/');
    }
}