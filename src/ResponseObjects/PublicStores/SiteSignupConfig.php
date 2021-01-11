<?php
namespace CRM_SDK\ResponseObjects\PublicStores;

class SiteSignupConfig
{
    /** @var bool */
    private $includeBday;
    /** @var bool */
    private $includeDBA;
    /** @var bool */
    private $includeJobTitle;
    /** @var bool */
    private $includeCompanyWebsite;
    /** @var bool */
    private $includeCompanyPhone;
    /** @var bool */
    private $includeCompanyFax;
    /** @var bool */
    private $includeIndustry;
    /** @var bool */
    private $includeNumEmployees;
    /** @var bool */
    private $includeNumTradeshows;
    /** @var bool */
    private $includeNumEvents;

    /**
     * SiteSignupConfig constructor.
     * @param array $results
     */
    public function __construct(array $results)
    {
        $this->setIncludeBday((bool) $results['include_bday']);
        $this->setIncludeDBA((bool) $results['include_dba']);
        $this->setIncludeJobTitle((bool) $results['include_job_title']);
        $this->setIncludeIndustry((bool) $results['include_industry']);
        $this->setIncludeCompanyWebsite((bool) $results['include_company_website']);
        $this->setIncludeCompanyPhone((bool) $results['include_company_phone']);
        $this->setIncludeCompanyFax((bool) $results['include_company_fax']);
        $this->setIncludeNumEmployees((bool) $results['include_num_employees']);
        $this->setIncludeNumTradeshows((bool) $results['include_num_tradeshows']);
        $this->setIncludeNumEvents((bool) $results['include_num_events']);

        return $this;
    }

    /**
     * @return bool
     */
    public function isIncludeBday(): bool
    {
        return $this->includeBday;
    }

    /**
     * @param bool $includeBday
     * @return SiteSignupConfig
     */
    public function setIncludeBday(bool $includeBday): SiteSignupConfig
    {
        $this->includeBday = $includeBday;
        return $this;
    }

    /**
     * @return bool
     */
    public function isIncludeNumEmployees(): bool
    {
        return $this->includeNumEmployees;
    }

    /**
     * @param bool $includeNumEmployees
     * @return SiteSignupConfig
     */
    public function setIncludeNumEmployees(bool $includeNumEmployees): SiteSignupConfig
    {
        $this->includeNumEmployees = $includeNumEmployees;
        return $this;
    }

    /**
     * @return bool
     */
    public function isIncludeDBA(): bool
    {
        return $this->includeDBA;
    }

    /**
     * @param bool $includeDBA
     * @return SiteSignupConfig
     */
    public function setIncludeDBA(bool $includeDBA): SiteSignupConfig
    {
        $this->includeDBA = $includeDBA;
        return $this;
    }

    /**
     * @return bool
     */
    public function isIncludeJobTitle(): bool
    {
        return $this->includeJobTitle;
    }

    /**
     * @param bool $includeJobTitle
     * @return SiteSignupConfig
     */
    public function setIncludeJobTitle(bool $includeJobTitle): SiteSignupConfig
    {
        $this->includeJobTitle = $includeJobTitle;
        return $this;
    }

    /**
     * @return bool
     */
    public function isIncludeCompanyWebsite(): bool
    {
        return $this->includeCompanyWebsite;
    }

    /**
     * @param bool $includeCompanyWebsite
     * @return SiteSignupConfig
     */
    public function setIncludeCompanyWebsite(bool $includeCompanyWebsite): SiteSignupConfig
    {
        $this->includeCompanyWebsite = $includeCompanyWebsite;
        return $this;
    }

    /**
     * @return bool
     */
    public function isIncludeCompanyPhone(): bool
    {
        return $this->includeCompanyPhone;
    }

    /**
     * @param bool $includeCompanyPhone
     * @return SiteSignupConfig
     */
    public function setIncludeCompanyPhone(bool $includeCompanyPhone): SiteSignupConfig
    {
        $this->includeCompanyPhone = $includeCompanyPhone;
        return $this;
    }

    /**
     * @return bool
     */
    public function isIncludeCompanyFax(): bool
    {
        return $this->includeCompanyFax;
    }

    /**
     * @param bool $includeCompanyFax
     * @return SiteSignupConfig
     */
    public function setIncludeCompanyFax(bool $includeCompanyFax): SiteSignupConfig
    {
        $this->includeCompanyFax = $includeCompanyFax;
        return $this;
    }

    /**
     * @return bool
     */
    public function isIncludeIndustry(): bool
    {
        return $this->includeIndustry;
    }

    /**
     * @param bool $includeIndustry
     * @return SiteSignupConfig
     */
    public function setIncludeIndustry(bool $includeIndustry): SiteSignupConfig
    {
        $this->includeIndustry = $includeIndustry;
        return $this;
    }

    /**
     * @return bool
     */
    public function isIncludeNumTradeshows(): bool
    {
        return $this->includeNumTradeshows;
    }

    /**
     * @param bool $includeNumTradeshows
     * @return SiteSignupConfig
     */
    public function setIncludeNumTradeshows(bool $includeNumTradeshows): SiteSignupConfig
    {
        $this->includeNumTradeshows = $includeNumTradeshows;
        return $this;
    }

    /**
     * @return bool
     */
    public function isIncludeNumEvents(): bool
    {
        return $this->includeNumEvents;
    }

    /**
     * @param bool $includeNumEvents
     * @return SiteSignupConfig
     */
    public function setIncludeNumEvents(bool $includeNumEvents): SiteSignupConfig
    {
        $this->includeNumEvents = $includeNumEvents;
        return $this;
    }
}