<?php
namespace CRM_SDK\Endpoints;

use CRM_SDK\Client;
use CRM_SDK\Exceptions\APIBadRequestException;
use CRM_SDK\Exceptions\APIForbiddenException;
use CRM_SDK\Exceptions\APIInternalServerErrorException;
use CRM_SDK\Exceptions\APIResourceNotFoundException;
use CRM_SDK\Exceptions\APIUnauthorizedException;
use CRM_SDK\Exceptions\AuthFailure;
use CRM_SDK\ResponseObjects\Authentication\ExpiredSession;
use CRM_SDK\ResponseObjects\Authentication\Session;
use DateTime;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class AuthenticationEndpoint extends Client
{
    protected $endpoint ='/auth';

    /**
     * Validates the user's credentials and creates an SSO session token
     *
     * @param string $username
     * @param string $password
     * @param string $username_label
     * @param DateTime|null $date_session_expires
     * @return Session
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws AuthFailure
     * @throws GuzzleException
     */
    public function createSession(string $username, string $password, string $username_label = 'Username', ?DateTime $date_session_expires = null)
    {
        try {
            $results = $this->post($this->endpoint.'/session', [
                'username' => $username,
                'password' => $password,
                'username_label'=>$username_label,
                'date_expires'=>$date_session_expires ? $date_session_expires->format("Y-m-d H:i:s") : null,
            ]);
        }
        //if bad request, convert to auth failure
        catch(APIBadRequestException $e)
        {
            throw new AuthFailure($e->getMessage());
        }

        return Session::create()->populateFromAPIResults($results);
    }

    /**
     * Sends the user to check for an SSO session, if one exists, it'll redirect back to the provided URL including the token in the query string
     *
     * @param $redirect_back_to_url
     * @return string
     */
    public function getCheckSSOCookieURL($redirect_back_to_url)
    {
        $url = $this->getSSORedirectHost().'/session/cookie-check';
        $query = '?redirect_url='.$redirect_back_to_url;

        return $url.$query;
    }

    /**
     * Sends the user to create a session cookie on the SSO server, then redirects them back to the provided URL
     *
     * @param string $token
     * @param $redirect_back_to_url
     * @return string
     */
    public function getSetSSOCookieURL(string $token, $redirect_back_to_url)
    {
        $url = $this->getSSORedirectHost().'/session/cookie-set';
        $query = '?token='.$token.'&redirect_url='.$redirect_back_to_url;

        return $url.$query;
    }

    /**
     * Uses the SSO session token to grab session details
     *
     * @param string $token
     * @return Session|ExpiredSession
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws APIBadRequestException
     * @throws GuzzleException
     * @throws Exception
     */
    public function getSession(string $token)
    {
        $results = $this->get($this->endpoint.'/session', [
            'token' => $token,
        ]);

        //if expired, return expired session
        if( $results['is_expired'] )
        {
            return ExpiredSession::create()->populateFromAPIResults($results);
        }

        return Session::create()->populateFromAPIResults($results);
    }

    /**
     * Checks to see if an SSO session is still active
     *
     * @param string $token
     * @return bool
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     */
    public function isSessionActive(string $token)
    {
        $results = $this->get($this->endpoint.'/session', [
            'token' => $token,
        ]);

        //if expired, return expired session
        if( $results['is_expired'] )
        {
            return false;
        }

        return true;
    }

    /**
     * Extends an SSO session (expiration date must be in the future and cannot be more than a week)
     *
     * @param string $token
     * @param DateTime $newExpirationDate
     * @return null
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws Exception
     */
    public function extendSession(string $token, DateTime $newExpirationDate)
    {
        return $this->patch($this->endpoint.'/session', [
            'token' => $token,
            'date_expires'=>$newExpirationDate->format("Y-m-d H:i:s")
        ]);
    }

    /**
     * Ends the SSO session - call this after logging a user out
     *
     * @param string $token
     * @return true
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws APIBadRequestException
     * @throws GuzzleException
     * @throws Exception
     */
    public function endSession(string $token)
    {
        $this->delete($this->endpoint.'/session', [
            'token' => $token,
        ]);

        return true;
    }
}