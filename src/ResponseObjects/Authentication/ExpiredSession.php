<?php
namespace CRM_SDK\ResponseObjects\Authentication;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;
use DateTime;

class ExpiredSession implements APIObjectInterface
{
    use APIObjectTrait;

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
     * @return array
     */
    public function toArray(): array
    {
        return [
            'token'=>$this->getToken()
        ];
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