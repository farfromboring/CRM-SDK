<?php
namespace CRM_SDK\ResponseObjects\PublicStores;

use CRM_SDK\SharedObjects\Traits\CreateTrait;

class SiteConfig
{
    use CreateTrait;

    /** @var int|null */
    private $serviceLevelID;
    /** @var bool|null */
    private $allowSearchEngineIndex;
    /** @var bool|null */
    private $limitCategories;
    /** @var float|null */
    private $creditCardFee;
    /** @var string|null */
    private $skuPrepend;
    /** @var Page[]|[] */
    private $pages;
    /** @var SiteSignupConfig|null */
    private $signup;

    /**
     * @param array $results
     * @return SiteConfig
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setServiceLevelID((int) $results['service_level_id']);
        $this->setAllowSearchEngineIndex((bool) $results['allow_se_index']);
        $this->setLimitCategories((bool) $results['limit_categories']);
        $this->setCreditCardFee((float) $results['credit_card_fee']);
        $this->setSkuPrepend($results['sku_prepend']);
        if( $results['signup'] )
        {
            $this->setSignup(new SiteSignupConfig($results['signup']));
        }

        //create an set pages
        $pages = [];
        foreach($results['pages'] as $page)
        {
            $pages[] = new Page($page);
        }
        $this->setPages($pages);

        return $this;
    }

    /**
     * @return int|null
     */
    public function getServiceLevelID(): ?int
    {
        return $this->serviceLevelID;
    }

    /**
     * @param int|null $serviceLevelID
     * @return SiteConfig
     */
    public function setServiceLevelID(?int $serviceLevelID): SiteConfig
    {
        $this->serviceLevelID = $serviceLevelID;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAllowSearchEngineIndex(): ?bool
    {
        return $this->allowSearchEngineIndex;
    }

    /**
     * @param bool|null $allowSearchEngineIndex
     * @return SiteConfig
     */
    public function setAllowSearchEngineIndex(?bool $allowSearchEngineIndex): SiteConfig
    {
        $this->allowSearchEngineIndex = $allowSearchEngineIndex;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getLimitCategories(): ?bool
    {
        return $this->limitCategories;
    }

    /**
     * @param bool|null $limitCategories
     * @return SiteConfig
     */
    public function setLimitCategories(?bool $limitCategories): SiteConfig
    {
        $this->limitCategories = $limitCategories;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getCreditCardFee(): ?float
    {
        return $this->creditCardFee;
    }

    /**
     * @param float|null $creditCardFee
     * @return SiteConfig
     */
    public function setCreditCardFee(?float $creditCardFee): SiteConfig
    {
        $this->creditCardFee = $creditCardFee;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSkuPrepend(): ?string
    {
        return $this->skuPrepend;
    }

    /**
     * @param string|null $skuPrepend
     * @return SiteConfig
     */
    public function setSkuPrepend(?string $skuPrepend): SiteConfig
    {
        $this->skuPrepend = $skuPrepend;
        return $this;
    }

    /**
     * @return Page[]
     */
    public function getPages(): array
    {
        return $this->pages;
    }

    /**
     * @param Page[] $pages
     * @return SiteConfig
     */
    public function setPages(array $pages): SiteConfig
    {
        $this->pages = $pages;
        return $this;
    }

    /**
     * @return SiteSignupConfig|null
     */
    public function getSignup(): ?SiteSignupConfig
    {
        return $this->signup;
    }

    /**
     * @param SiteSignupConfig|null $signup
     * @return SiteConfig
     */
    public function setSignup(?SiteSignupConfig $signup): SiteConfig
    {
        $this->signup = $signup;
        return $this;
    }
}