<?php
namespace CRM_SDK\Endpoints;

use CRM_SDK\Client;
use CRM_SDK\Exceptions\APIBadRequestException;
use CRM_SDK\Exceptions\APIForbiddenException;
use CRM_SDK\Exceptions\APIInternalServerErrorException;
use CRM_SDK\Exceptions\APIResourceNotFoundException;
use CRM_SDK\Exceptions\APIUnauthorizedException;
use GuzzleHttp\Exception\GuzzleException;

class ImportTasksEndpoint extends Client
{
    protected $endpoint ='/import-tasks';

    /**
     * Gets import tasks
     * Returns
     * [
     *   //tasks that are not running and ready to start
     *  'pending_tasks'=>[
     *      ['data_source_id'=>1, 'task_id'=>1, 'supplier_id'=>1, 'supplier_external_id'=>3523, 'supplier_name'=>'Sup Co.', 'start_date'=>'2018-10-10'],
     *      ['data_source_id'=>1, 'task_id'=>2, 'supplier_id'=>2, 'supplier_external_id'=>6235, 'supplier_name'=>'Other Co.', 'start_date'=>null],
     *   ],
     *   //tasks that are running but need to be paused
     *   'pause_tasks'=>[
     *      [ 'task_id'=> 1 ]
     *   ]
     * ]
     *
     * @return array
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     */
    public function getTasks()
    {
        return $this->get($this->endpoint);
    }

    /**
     * @param int $task_id
     * @return mixed
     * @throws GuzzleException
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     */
    public function start(int $task_id)
    {
        return $this->patch($this->endpoint, [
            'task_id'=>$task_id,
            'is_started'=>1,
        ]);
    }

    /**
     * @param int $task_id
     * @param int $num_products
     * @return mixed
     * @throws GuzzleException
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     */
    public function updateNumProducts(int $task_id, int $num_products)
    {
        return $this->patch($this->endpoint, [
            'task_id'=>$task_id,
            'num_products'=>$num_products,
        ]);
    }

    /**
     * @param int $task_id
     * @return mixed
     * @throws GuzzleException
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     */
    public function paused(int $task_id)
    {
        return $this->patch($this->endpoint, [
            'task_id'=>$task_id,
            'completed_pausing'=>1,
        ]);
    }

    /**
     * @param int $task_id
     * @param string $fail_msg
     * @return mixed
     * @throws GuzzleException
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     */
    public function failed(int $task_id, string $fail_msg = '')
    {
        return $this->patch($this->endpoint, [
            'task_id'=>$task_id,
            'is_failed'=>1,
            'fail_msg'=>$fail_msg
        ]);
    }

    /**
     * @param int $task_id
     * @return mixed
     * @throws GuzzleException
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     */
    public function successful(int $task_id)
    {
        return $this->patch($this->endpoint, [
            'task_id'=>$task_id,
            'is_successful'=>1,
        ]);
    }
}