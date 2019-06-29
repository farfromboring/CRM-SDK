<?php
namespace CRM_SDK\ResponseObjects\Authentication;

use CRM_SDK\Traits\CreateTrait;

class Token
{
    use CreateTrait;

    /** @var string|null */
    private $token;

    /**
     * @param string $token
     * @return Token
     */
    public function populateFromAPIResults(string $token)
    {
        $this->token = $token;

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
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }
}