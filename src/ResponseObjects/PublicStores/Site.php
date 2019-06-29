<?php
namespace CRM_SDK\ResponseObjects\PublicStores;

use CRM_SDK\Traits\CreateTrait;
use CRM_SDK\Traits\IDTrait;
use DateTime;

class Site
{
    use CreateTrait;
    use IDTrait;

    /** @var string|null */
    private $name;
    /** @var string|null */
    private $businessName;
    /** @var string|null */
    private $apiKey;
    /** @var bool|null */
    private $in_maintenance_mode;
    /** @var int|null */
    private $ownerUserId;
    /** @var DateTime|null */
    private $dateAdded;

    /** @var SiteStatus|null */
    private $status;
    /** @var Domain|null */
    private $domain;

    /** @var SiteTheme|null */
    private $theme;
    /** @var SiteConfig|null */
    private $config;
    /** @var SiteIntegrations|null */
    private $integrations;

    /**
     * @param int|null $id
     * @param string|null $name
     * @param string|null $business_name
     * @param bool|null $in_maintenance_mode
     * @param int|null $owner_user_id
     * @param SiteStatus|null $status
     * @param Domain|null $domain
     * @param string|null $api_key
     * @param DateTime|null $date_added
     * @return Site
     */
    public function populateFromAPIResults(?int $id = null, ?string $name = null, ?string $business_name = null, bool $in_maintenance_mode = null, ?int $owner_user_id = null, SiteStatus $status = null, ?Domain $domain = null, ?string $api_key = null, ?DateTime $date_added = null)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setBusinessName($business_name);
        $this->setInMaintenanceMode($in_maintenance_mode);
        $this->setOwnerUserId($owner_user_id);
        $this->setDateAdded($date_added);
        $this->setStatus($status);
        $this->setDomain($domain);
        $this->setAPIKey($api_key);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Site
     */
    public function setName(?string $name): Site
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBusinessName(): ?string
    {
        return $this->businessName;
    }

    /**
     * @param string|null $businessName
     * @return Site
     */
    public function setBusinessName(?string $businessName): Site
    {
        $this->businessName = $businessName;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getInMaintenanceMode(): ?bool
    {
        return $this->in_maintenance_mode;
    }

    /**
     * @param bool|null $in_maintenance_mode
     * @return Site
     */
    public function setInMaintenanceMode(?bool $in_maintenance_mode): Site
    {
        $this->in_maintenance_mode = $in_maintenance_mode;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getOwnerUserId(): ?int
    {
        return $this->ownerUserId;
    }

    /**
     * @param int|null $ownerUserId
     * @return Site
     */
    public function setOwnerUserId(?int $ownerUserId): Site
    {
        $this->ownerUserId = $ownerUserId;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDateAdded(): ?DateTime
    {
        return $this->dateAdded;
    }

    /**
     * @param DateTime|null $dateAdded
     * @return Site
     */
    public function setDateAdded(?DateTime $dateAdded): Site
    {
        $this->dateAdded = $dateAdded;
        return $this;
    }

    /**
     * @return SiteStatus|null
     */
    public function getStatus(): ?SiteStatus
    {
        return $this->status;
    }

    /**
     * @param SiteStatus|null $status
     * @return Site
     */
    public function setStatus(?SiteStatus $status): Site
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return Domain|null
     */
    public function getDomain(): ?Domain
    {
        return $this->domain;
    }

    /**
     * @param Domain|null $domain
     * @return Site
     */
    public function setDomain(?Domain $domain): Site
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * @return SiteTheme|null
     */
    public function getTheme(): ?SiteTheme
    {
        return $this->theme;
    }

    /**
     * @param SiteTheme|null $theme
     * @return Site
     */
    public function setTheme(?SiteTheme $theme): Site
    {
        $this->theme = $theme;
        return $this;
    }

    /**
     * @return SiteConfig|null
     */
    public function getConfig(): ?SiteConfig
    {
        return $this->config;
    }

    /**
     * @param SiteConfig|null $config
     * @return Site
     */
    public function setConfig(?SiteConfig $config): Site
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    /**
     * @param string|null $apiKey
     * @return Site
     */
    public function setApiKey(?string $apiKey): Site
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * @return SiteIntegrations|null
     */
    public function getIntegrations(): ?SiteIntegrations
    {
        return $this->integrations;
    }

    /**
     * @param SiteIntegrations|null $integrations
     * @return Site
     */
    public function setIntegrations(?SiteIntegrations $integrations): Site
    {
        $this->integrations = $integrations;
        return $this;
    }
}