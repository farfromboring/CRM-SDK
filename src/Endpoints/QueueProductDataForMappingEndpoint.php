<?php
namespace CRM_SDK\Endpoints;

use CRM_SDK\Client;
use CRM_SDK\Exceptions\APIBadRequestException;
use CRM_SDK\Exceptions\APIForbiddenException;
use CRM_SDK\Exceptions\APIInternalServerErrorException;
use CRM_SDK\Exceptions\APIResourceNotFoundException;
use CRM_SDK\Exceptions\APIUnauthorizedException;
use GuzzleHttp\Exception\GuzzleException;

class QueueProductDataForMappingEndpoint extends Client
{
    protected $endpoint ='/queue-product-data-for-mapping';

    /**
     * Queues new product data to be mapped to existing or created if an existing match does not exist
     * for instance: colors, sizes, materials, catalogs, categories, etc
     *
     * @param int $data_type_id (for instance: Categories = 1)
     * @param string $unique_identifier - a unique string that can be used to identify a pre-existing queue item (for instance: colors_red)
     * @param array $data - data about this value required for making a positive match mapping or creating a new item (for instance: catalogs require supplier_id, catalog_name, and catalog_year)
     * @param string|null $file_key - optional file that has been stalled pending this mapping
     * @param string|null $file_bucket - optional file that has been stalled pending this mapping
     * @return mixed
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     */
    public function send(int $data_type_id, string $unique_identifier, array $data, ?string $file_key = null, ?string $file_bucket = null)
    {
        return $this->post($this->endpoint, [
            'data_type_id'=>$data_type_id,
            'unique_identifier'=>$unique_identifier,
            'data'=>$data,
            'file_key'=>$file_key,
            'file_bucket'=>$file_bucket
        ]);
    }
}