<?php
namespace CRM_SDK\Endpoints;

use CRM_SDK\Client;
use CRM_SDK\Exceptions\APIBadRequestException;
use CRM_SDK\Exceptions\APIForbiddenException;
use CRM_SDK\Exceptions\APIInternalServerErrorException;
use CRM_SDK\Exceptions\APIResourceNotFoundException;
use CRM_SDK\Exceptions\APIUnauthorizedException;
use CRM_SDK\SharedObjects\Company\Company;
use GuzzleHttp\Exception\GuzzleException;

class CompanyEndpoint extends Client
{
    protected $endpoint ='/company';

    /**
     * Allows you to update a company's basic details
     *
     * @param Company $company
     * @return array
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     */
    public function updateCompany(Company $company)
    {
        return $this->patch($this->endpoint, [
            'company'=>$company->toArray()
        ]);
    }

    /**
     * Gets the industry options for a dropdown.
     *
     * Key is the id, value is the name
     *
     * @return array
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getIndustryOptions()
    {
        return $this->get($this->endpoint.'/industries');
    }

    /**
     * Gets the payment terms options for a dropdown.
     *
     * Key is the id, value is the name
     *
     * @return array
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getPaymentTermOptions()
    {
        return $this->get($this->endpoint.'/payment-terms');
    }

    /**
     * Gets the employees/tradeshows/events options
     *
     * Multi-dimensional, first array has keys "num_employees", "num_tradeshows", "num_events".
     * Second array is associative: key is the id, value is the name
     *
     * @return array
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getNumberOf_Options()
    {
        return $this->get($this->endpoint.'/number-of');
    }
}