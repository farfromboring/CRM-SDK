<?php
namespace CRM_SDK\Endpoints;

use CRM_SDK\Client;
use CRM_SDK\Exceptions\APIBadRequestException;
use CRM_SDK\Exceptions\APIForbiddenException;
use CRM_SDK\Exceptions\APIInternalServerErrorException;
use CRM_SDK\Exceptions\APIResourceNotFoundException;
use CRM_SDK\Exceptions\APIUnauthorizedException;
use CRM_SDK\SharedObjects\Form\FormSubmission;
use GuzzleHttp\Exception\GuzzleException;

class FormEndpoint extends Client
{
    protected $endpoint ='/form';

    /**
     * Gets all submissions for a particular user (optionally just for a specific form)
     *
     * $sdk = new FormEndpoint(); //or FormEndpoint::create()
     *
     *
     * @param int $user_id
     * @param string|null $form_key
     * @return FormSubmission[]
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getUserSubmissions(int $user_id, ?string $form_key = null)
    {
        $results = $this->get($this->endpoint.'/submissions', [
            'user_id'=>$user_id,
            'form_key'=>$form_key,
        ]);

        $submissions = [];
        foreach($results as $result)
        {
            $submissions[] = FormSubmission::create()->populateFromAPIResults($result);
        }

        return $submissions;
    }

    /**
     * Submits a form
     *
     * $sdk = new FormEndpoint(); //or FormEndpoint::create()
     *
     * $submission = new FormSubmission($guest->getId(), Form::CONTACT_US); //generic forms have constants available
     *
     * $submission->setStatus(FormSubmissionStatuses::RECEIVED); //this is the default anyone, just showing you this is an option
     *
     * $submission->setPreview(substr($_POST['message'], 0, 100)); //validate $_POST and that $_POST['message'] exists and is a string first
     *
     * $submission->setValues($_POST); //make sure you validate the $_POST values before doing this
     *
     * //the returned FormSubmission object is different and contains additional information
     * $submission = $sdk->submit($submission);
     *
     * @param FormSubmission $submission
     * @return FormSubmission
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function submit(FormSubmission $submission)
    {
        $results = $this->post($this->endpoint.'/submission', $submission->toArray());

        return FormSubmission::create()->populateFromAPIResults($results);
    }
}