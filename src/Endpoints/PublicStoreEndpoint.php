<?php
namespace CRM_SDK\Endpoints;

use CRM_SDK\Client;
use CRM_SDK\Exceptions\APIBadRequestException;
use CRM_SDK\Exceptions\APIForbiddenException;
use CRM_SDK\Exceptions\APIInternalServerErrorException;
use CRM_SDK\Exceptions\APIResourceNotFoundException;
use CRM_SDK\Exceptions\APIUnauthorizedException;
use CRM_SDK\ResponseObjects\PublicStores\Domain;
use CRM_SDK\ResponseObjects\PublicStores\Environment;
use CRM_SDK\ResponseObjects\PublicStores\Page;
use CRM_SDK\ResponseObjects\PublicStores\Sidebar;
use CRM_SDK\ResponseObjects\PublicStores\Site;
use CRM_SDK\ResponseObjects\PublicStores\SiteConfig;
use CRM_SDK\ResponseObjects\PublicStores\SiteIntegrations;
use CRM_SDK\ResponseObjects\PublicStores\SiteStatus;
use CRM_SDK\ResponseObjects\PublicStores\SiteTheme;
use GuzzleHttp\Exception\GuzzleException;
use \DateTime;

class PublicStoreEndpoint extends Client
{
    protected $endpoint ='/public-stores';

    /**
     * @param string $domain
     * @param bool $include_config
     * @param bool $include_theme
     * @param bool $include_integrations
     * @return Site
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getByDomain(string $domain, $include_config = true, $include_theme = true, $include_integrations = true)
    {
        $results = $this->get($this->endpoint.'/by-domain', [
            'domain'=>$domain,
            'include_config'=>$include_config,
            'include_theme'=>$include_theme,
            'include_integrations'=>$include_integrations
        ]);

        //cache domain and site
        $r_site = $results['site'];
        $r_domain = $results['domain'];

        //instantiate domain and populate object
        $environment = Environment::create()->populateFromAPIResults($r_domain['environment']);
        $date_added = $r_domain['date_added'] ? new DateTime($r_domain['date_added']) : null;
        $domain = Domain::create()->populateFromAPIResults((int) $r_domain['id'], $r_domain['domain'], $environment, $r_domain['has_ssl'], $date_added);

        //instantiate site and populate object
        $status = SiteStatus::create()->populateFromAPIResults($r_site['status']);
        $date_added = $r_site['date_added'] ? new DateTime($r_site['date_added']) : null;
        $owner_user_id = $r_site['owner_user_id'] ? (int) $r_site['owner_user_id'] : null;
        $site = Site::create()->populateFromAPIResults((int) $r_site['id'], $r_site['name'], $r_site['business_name'], $r_site['in_maintenance_mode'], $owner_user_id, $status, $domain, $r_site['api_key'], $date_added);

        if( $include_theme )
        {
            $site->setTheme(SiteTheme::create()->populateFromAPIResults($results['theme']));
        }

        if( $include_config )
        {
            $site->setConfig(SiteConfig::create()->populateFromAPIResults($results['config']));
        }

        if( $include_integrations )
        {
            $site->setIntegrations(SiteIntegrations::create()->populateFromAPIResults($results['integrations']));
        }

        return $site;
    }

    /**
     * @return array
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     */
    public function getAllPageRoutes(){
        return $this->get($this->endpoint.'/all-page-routes');
    }

    /**
     * @param Sidebar $sidebar
     * @return Sidebar
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     */
    public function getSidebarContent(Sidebar $sidebar)
    {
        $results = $this->get($this->endpoint.'/sidebar-content', [
            'sidebar_id'=>$sidebar->getId()
        ]);

        $sidebar->setContent($results['content']);

        return $sidebar;
    }

    /**
     * @param Page $page
     * @return Page
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     */
    public function getPageContent(Page $page)
    {
        $results = $this->get($this->endpoint.'/page-content', [
            'page_id'=>$page->getId()
        ]);

        $page->setContent($results['content']);

        return $page;
    }

    /**
     * @param string $site_id
     * @return mixed
     * @throws GuzzleException
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws \Exception
     */
    public function getConfig(string $site_id)
    {
        $results = $this->get($this->endpoint.'/config', [
            'site_id'=>$site_id,
        ]);

        return SiteConfig::create()->populateFromAPIResults($results);
    }

    /**
     * @param string $site_id
     * @return mixed
     * @throws GuzzleException
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     */
    public function getTheme(string $site_id)
    {
        $results = $this->get($this->endpoint.'/theme', [
            'site_id'=>$site_id,
        ]);

        return SiteTheme::create()->populateFromAPIResults($results);
    }

    /**
     * @param string $site_id
     * @return mixed
     * @throws GuzzleException
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     */
    public function getIntegrations(string $site_id)
    {
        $results = $this->get($this->endpoint.'/integrations', [
            'site_id'=>$site_id,
        ]);

        return SiteIntegrations::create()->populateFromAPIResults($results);
    }
}