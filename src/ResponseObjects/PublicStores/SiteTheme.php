<?php
namespace CRM_SDK\ResponseObjects\PublicStores;

use CRM_SDK\Traits\CreateTrait;

class SiteTheme
{
    use CreateTrait;

    /** @var string|null */
    private $favicon;
    /** @var string|null */
    private $logo;
    /** @var Theme|null */
    private $theme;
    /** @var string|null */
    private $googleAnalytics;

    /**
     * @param array $results
     * @return SiteTheme
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setFavicon($results['favicon']);
        $this->setLogo($results['logo']);
        $this->setGoogleAnalytics($results['google_analytics']);
        $this->setTheme(new Theme($results['theme']));

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFavicon(): ?string
    {
        return $this->favicon;
    }

    /**
     * @param string|null $favicon
     * @return SiteTheme
     */
    public function setFavicon(?string $favicon): SiteTheme
    {
        $this->favicon = $favicon;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLogo(): ?string
    {
        return $this->logo;
    }

    /**
     * @param string|null $logo
     * @return SiteTheme
     */
    public function setLogo(?string $logo): SiteTheme
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGoogleAnalytics(): ?string
    {
        return $this->googleAnalytics;
    }

    /**
     * @param string|null $googleAnalytics
     * @return SiteTheme
     */
    public function setGoogleAnalytics(?string $googleAnalytics): SiteTheme
    {
        $this->googleAnalytics = $googleAnalytics;
        return $this;
    }

    /**
     * @return Theme|null
     */
    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    /**
     * @param Theme|null $theme
     * @return SiteTheme
     */
    public function setTheme(?Theme $theme): SiteTheme
    {
        $this->theme = $theme;
        return $this;
    }
}