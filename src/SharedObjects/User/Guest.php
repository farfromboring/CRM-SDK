<?php
namespace CRM_SDK\SharedObjects\User;

use CRM_SDK\Endpoints\GuestUserEndpoint;
use CRM_SDK\Interfaces\APIObjectInterface;

class Guest extends AbstractUser implements UserInterface, APIObjectInterface
{
    /** @var string|null */
    private $token;

    /** @var \DateTime */
    private $tokenExpires;

    /**
     * On construct, try to get the guest token from the cookie and set it immediately
     *
     * Guest constructor.
     */
    public function __construct()
    {
        $this->setToken(GuestUserEndpoint::getGuestTokenFromCookie());
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            GuestUserEndpoint::GUEST_USER_TOKEN=>$this->getToken()
        ]);
    }

    /**
     * @param array $results
     * @return self
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results): self
    {
        $this->setToken($results[GuestUserEndpoint::GUEST_USER_TOKEN]);
        $this->setTokenExpires(new \DateTime($results['token_expires']));

        //set the guest token as a cookie
        GuestUserEndpoint::setGuestCookie($this->getToken());

        //set rest of user fields
        return parent::populateFromAPIResults($results);
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string|null $token
     * @return Guest
     */
    public function setToken(?string $token): Guest
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTokenExpires(): \DateTime
    {
        return $this->tokenExpires;
    }

    /**
     * @param \DateTime $tokenExpires
     * @return Guest
     */
    public function setTokenExpires(\DateTime $tokenExpires): Guest
    {
        $this->tokenExpires = $tokenExpires;
        return $this;
    }
}