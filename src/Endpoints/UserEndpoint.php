<?php
namespace CRM_SDK\Endpoints;

use CRM_SDK\Client;
use CRM_SDK\Exceptions\APIBadRequestException;
use CRM_SDK\Exceptions\APIForbiddenException;
use CRM_SDK\Exceptions\APIInternalServerErrorException;
use CRM_SDK\Exceptions\APIResourceNotFoundException;
use CRM_SDK\Exceptions\APIUnauthorizedException;
use CRM_SDK\SharedObjects\User\User;
use DateTime;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class UserEndpoint extends Client
{
    protected $endpoint ='/user';

    /**
     * Gets a user's details by ID
     *
     * @param int $user_id
     * @return User
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws Exception
     */
    public function getUser(int $user_id)
    {
        $results = $this->get($this->endpoint, [
            'user_id' => $user_id,
        ]);

        return User::create()->populateFromAPIResults($results);
    }

    /**
     * @todo: Modify this to use the User request object instead of an array of data.
     *
     * Update a user's basic details, returns the updated user object
     * The data array can contain fname, lname, email, job_title, birthday (MM/YY), password
     *
     * @param int $user_id
     * @param array $data
     * @return User
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws Exception
     */
    public function updateUser(int $user_id, array $data)
    {
        $results = $this->patch($this->endpoint, [
            'user_id' => $user_id,
            'data'=>$data
        ]);

        return User::create()->populateFromAPIResults($results);
    }

    /**
     * Adds a user
     *
     * $user = new User(); //or User::create()
     * $user->setFname('Bob');
     * $user->setLname('Jenkins');
     * $user->setEmail('bob@jenkins.com');
     *
     * $company = new Company(); //or Company::create()
     * $company->setName('Jenkins Co');
     *
     * $user->setCompany($company);
     *
     * $new_user = $sdk->addUser($user, true);
     *
     * If password is provided and $send_welcome_email = true, it will send the new user a welcome email
     * If password is not provided and $send_welcome_email = true, it will auto-generate a password
     *
     * If user with this email address already exists, an exception will be thrown
     *
     * @param User $user
     * @param bool $send_welcome_email
     * @param bool $create_session
     * @param DateTime|null $date_session_expires
     * @return User|array
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws Exception
     */
    public function addUser(User $user, $send_welcome_email = false, $create_session = false, ?DateTime $date_session_expires = null)
    {
        $results = $this->post($this->endpoint, [
            'user'=>$user->toArray(),
            'send_welcome_email' => $send_welcome_email,
            'create_session'=>$create_session,
            'date_expires'=>$date_session_expires ? $date_session_expires->format("Y-m-d H:i:s") : null,
        ]);

        return User::create()->populateFromAPIResults($results);
    }
}