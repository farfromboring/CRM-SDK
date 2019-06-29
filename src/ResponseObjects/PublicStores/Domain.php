<?php
namespace CRM_SDK\ResponseObjects\PublicStores;

use CRM_SDK\Traits\CreateTrait;
use CRM_SDK\Traits\DateAddedTrait;
use CRM_SDK\Traits\IDTrait;
use DateTime;

class Domain
{
    use CreateTrait;
    use IDTrait;
    use DateAddedTrait;

    /** @var Environment|null */
    private $environment;
    /** @var bool|null */
    private $hasSSL;
    /** @var string|null */
    private $domain;

    /**
     * @param int|null $id
     * @param string|null $domain
     * @param Environment|null $environment
     * @param bool|null $has_ssl
     * @param DateTime|null $date_added
     * @return Domain
     */
    public function populateFromAPIResults(?int $id = null, ?string $domain = null, ?Environment $environment = null, ?bool $has_ssl = null, ?DateTime $date_added = null)
    {
        $this->setId($id);
        $this->setDomain($domain);
        $this->setEnvironment($environment);
        $this->setHasSSL($has_ssl);
        $this->setDateAdded($date_added);

        return $this;
    }

    /**
     * @return Environment|null
     */
    public function getEnvironment(): ?Environment
    {
        return $this->environment;
    }

    /**
     * @param Environment|null $environment
     * @return Domain
     */
    public function setEnvironment(?Environment $environment): Domain
    {
        $this->environment = $environment;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getHasSSL(): ?bool
    {
        return $this->hasSSL;
    }

    /**
     * @param bool|null $hasSSL
     * @return Domain
     */
    public function setHasSSL(?bool $hasSSL): Domain
    {
        $this->hasSSL = $hasSSL;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * @param string|null $domain
     * @return Domain
     */
    public function setDomain(?string $domain): Domain
    {
        $this->domain = $domain;
        return $this;
    }
}