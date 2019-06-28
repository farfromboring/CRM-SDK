<?php
namespace CRM_SDK\Endpoints;

use CRM_SDK\Client;
use CRM_SDK\Exceptions\APIBadRequestException;
use CRM_SDK\Exceptions\APIForbiddenException;
use CRM_SDK\Exceptions\APIInternalServerErrorException;
use CRM_SDK\Exceptions\APIResourceNotFoundException;
use CRM_SDK\Exceptions\APIUnauthorizedException;
use GuzzleHttp\Exception\GuzzleException;

class ImportStalledFilesEndpoint extends Client
{
    protected $endpoint ='/import-stalled-files';

    /**
     * @param string $key
     * @param string $bucket
     * @param string $reason
     * @return mixed
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     */
    public function add(string $key, string $bucket, string $reason)
    {
        return $this->post($this->endpoint, [
            'key'=>$key,
            'bucket'=>$bucket,
            'reason'=>$reason
        ]);
    }
}