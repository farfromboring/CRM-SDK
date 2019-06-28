<?php
namespace CRM_SDK\ResponseObjects\Authentication;

use CRM_SDK\SharedObjects\Traits\CreateTrait;
use DateTime;

class ExpiredSession
{
    use CreateTrait;

    /** @var Token */
    private $token;

    /** @var DateTime */
    private $dateExpired;

    /**
     * @param array $results
     * @return ExpiredSession
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->token = Token::create()->populateFromAPIResults($results['token']);
        $this->dateExpired = new DateTime($results['date_expired']);

        return $this;
    }

    /**
     * @return Token
     */
    public function getToken(): Token
    {
        return $this->token;
    }

    /**
     * @return DateTime
     */
    public function getDateExpired(): DateTime
    {
        return $this->dateExpired;
    }

    /**
     * @param DateTime $dateExpired
     * @return ExpiredSession
     */
    public function setDateExpired(DateTime $dateExpired): ExpiredSession
    {
        $this->dateExpired = $dateExpired;
        return $this;
    }
}