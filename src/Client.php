<?php
namespace CRM_SDK;

use CRM_SDK\Exceptions\APIBadRequestException;
use CRM_SDK\Exceptions\APIForbiddenException;
use CRM_SDK\Exceptions\APIInternalServerErrorException;
use CRM_SDK\Exceptions\APIResourceNotFoundException;
use CRM_SDK\Exceptions\APIUnauthorizedException;
use CRM_SDK\Interfaces\EndpointInterface;
use CRM_SDK\Traits\CreateTrait;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

class Client implements EndpointInterface
{
    use CreateTrait;

    /** @var string  */
    const ENVVARS_KEY = 'WEBWISEUSA_CRM_API_KEY';

    /** @var int  */
    const ENVVARS_VERSION_KEY = 'WEBWISEUSA_CRM_API_VERSION';

    /** @var \GuzzleHttp\Client  */
    protected $client;

    /** @var int  */
    protected $api_version;

    /** @var  */
    protected $is_dev;

    /**
     * Client constructor.
     *
     * Version defaults to 1 if not available in environment variables and not provided as a param
     *
     * @param string $api_key
     * @param int $version
     * @param \GuzzleHttp\Client $client
     * @throws Exception
     */
    public function __construct(?string $api_key = null, ?int $version = null, ?\GuzzleHttp\Client $client = null)
    {
        //version is provided, from envvar, or default to 1
        $this->api_version = is_null($version) && !empty($_ENV[self::ENVVARS_VERSION_KEY]) ? $_ENV[self::ENVVARS_VERSION_KEY] : 1;

        $api_key = is_null($api_key) ? (!empty($_ENV[self::ENVVARS_KEY]) ? $_ENV[self::ENVVARS_KEY] : getenv(self::ENVVARS_KEY)) : $api_key;
        if( !$api_key )
        {
            throw new Exception('An API key is required');
        }

        //if api key starts with dev_, enable dev mode
        $this->is_dev = stripos($api_key, 'dev_') === 0;

        //strip off dev_ to get actual api key
        if( $this->is_dev )
        {
            $api_key = substr($api_key, 4);
        }

        $this->client = is_null($client) ? new \GuzzleHttp\Client([
            'headers' => [
                'api-key' => $api_key
            ]
        ]) : $client;
    }

    /**
     * @param string $api_key
     * @param int|null $version
     */
    public static function setAPIKeyGlobally(string $api_key, ?int $version = null)
    {
        $_ENV[self::ENVVARS_KEY] = $api_key;

        if( $version )
        {
            self::setAPIVersionGlobally($version);
        }
    }

    /**
     * @param int $version
     */
    public static function setAPIVersionGlobally(int $version)
    {
        $_ENV[self::ENVVARS_VERSION_KEY] = $version;
    }

    /**
     * @param string $method
     * @param string $endpoint
     * @param array $data
     * @return array|null
     * @throws GuzzleException
     * @throws Exception
     * @throws APIInternalServerErrorException
     * @throws APIBadRequestException
     * @throws APIUnauthorizedException
     * @throws APIForbiddenException
     * @throws APIResourceNotFoundException
     */
    protected function request(string $method, string $endpoint, array $data = [])
    {
        $options = [];

        //add IP and user agent to every request
        $data['client_ip'] = !empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
        $data['client_user_agent'] = !empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null;

        if( $data ) {
            $options['query'] = $data;
        }

        //disabled exceptions per http code (they are handled below instead)
        $options[RequestOptions::HTTP_ERRORS] = false;

        $result = $this->client->request($method, $this->getBaseURL().$endpoint, $options);

        $error_msg = 'Unknown error';
        $response = $result->getBody()->getContents();

        try
        {
            $response = json_decode($response, true);
            $error_msg = !empty($response['error']) ? $response['error'] : '';
        }
        catch(\Throwable $t)
        { }

        switch($result->getStatusCode())
        {
            case 200:
                //good to go, unless not an array
                if( !is_array($response) )
                {
                    throw new APIInternalServerErrorException('Invalid response from API: '.$response, $result->getStatusCode());
                }
                break;
            case 400:
                throw new APIBadRequestException($error_msg, $result->getStatusCode());
                break;
            case 401:
                throw new APIUnauthorizedException($error_msg, $result->getStatusCode());
                break;
            case 403:
                throw new APIForbiddenException($error_msg, $result->getStatusCode());
                break;
            case 404:
                throw new APIResourceNotFoundException($error_msg, $result->getStatusCode());
                break;
            default:
                throw new APIResourceNotFoundException($error_msg, $result->getStatusCode());
                break;
        }

        return $response;
    }

    /**
     * @param $endpoint
     * @param $data
     * @return array
     * @throws Exception
     * @throws GuzzleException
     * @throws APIInternalServerErrorException
     * @throws APIBadRequestException
     * @throws APIUnauthorizedException
     * @throws APIForbiddenException
     * @throws APIResourceNotFoundException
     */
    protected function get(string $endpoint, array $data = [])
    {
        return $this->request('GET', $endpoint, $data);
    }

    /**
     * @param string $endpoint
     * @param array $data
     * @return mixed
     * @throws Exception
     * @throws GuzzleException
     * @throws APIInternalServerErrorException
     * @throws APIBadRequestException
     * @throws APIUnauthorizedException
     * @throws APIForbiddenException
     * @throws APIResourceNotFoundException
     */
    protected function post(string $endpoint, array $data = [])
    {
        return $this->request('POST', $endpoint, $data);
    }

    /**
     * @param string $endpoint
     * @param array $data
     * @return mixed
     * @throws Exception
     * @throws GuzzleException
     * @throws APIInternalServerErrorException
     * @throws APIBadRequestException
     * @throws APIUnauthorizedException
     * @throws APIForbiddenException
     * @throws APIResourceNotFoundException
     */
    protected function put(string $endpoint, array $data = [])
    {
        return $this->request('PUT', $endpoint, $data);
    }

    /**
     * @param string $endpoint
     * @param array $data
     * @return mixed
     * @throws Exception
     * @throws GuzzleException
     * @throws APIInternalServerErrorException
     * @throws APIBadRequestException
     * @throws APIUnauthorizedException
     * @throws APIForbiddenException
     * @throws APIResourceNotFoundException
     */
    protected function patch(string $endpoint, array $data = [])
    {
        return $this->request('PATCH', $endpoint, $data);
    }

    /**
     * @param string $endpoint
     * @param array $data
     * @return mixed
     * @throws Exception
     * @throws GuzzleException
     * @throws APIInternalServerErrorException
     * @throws APIBadRequestException
     * @throws APIUnauthorizedException
     * @throws APIForbiddenException
     * @throws APIResourceNotFoundException
     */
    protected function delete(string $endpoint, array $data = [])
    {
        return $this->request('DELETE', $endpoint, $data);
    }

    /**
     * @return string
     */
    protected function getSSORedirectHost()
    {
        return 'https://'.($this->is_dev?'dev-':'').'crm.webwiseusa.com';
    }

    /**
     * @return string
     */
    protected function getAPIHost()
    {
        return 'https://'.($this->is_dev?'dev-':'').'api.webwisecrm.com';
    }

    /**
     * @return string
     */
    protected function getBaseURL()
    {
        return $this->getAPIHost().'/api/v'.$this->api_version;
    }
}