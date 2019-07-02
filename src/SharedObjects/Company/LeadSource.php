<?php
namespace CRM_SDK\SharedObjects\Company;

use CRM_SDK\Interfaces\DropdownInterface;
use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Traits\IDToArrayTrait;

class LeadSource implements APIObjectInterface, DropdownInterface
{
    use APIObjectTrait;
    use IDAndNameTrait, IDToArrayTrait {
        IDToArrayTrait::toArray insteadof IDAndNameTrait;
    }

    //not a complete list, just generic ones
    const WEBSITE_CALL_IN = 1;
    const WEBSITE_SAMPLE_REQUEST = 2;
    const WEBSITE_QUOTE_REQUEST = 3;
    const CALL_IN = 4;
    const CHAT = 5;
    const EMPLOYEE_REFERRAL = 8;
    const CUSTOMER_REFERRAL = 9;
    const PARTNER = 10;
    const NEWSLETTER = 11;
    const OTHER = 16;
    const WEBSITE_WISHLIST = 18;
    const WEBSITE_VIRTUAL_SAMPLE = 19;
    const WEBSITE_CONTACT_US = 20;
    const WEBSITE_SIGNUP = 25;
    const ONLINE_UNKNOWN = 26;
    const TRADESHOW = 27;
    const WEBSITE_SEND_PRODUCT_TO_FRIEND = 28;
    const ONLINE_SEARCH_ENGINE = 29;
    const LOCAL_CATALOG_DISTRIBUTION = 31;
    const WEBSITE_MAILING_LIST = 32;
    const JIGSAW_DATA_COM = 33;
    const SEARCH_ENGINE_AD = 34;
    const COLD_CALL = 36;
    const CSV_IMPORT = 38;
    const FACEBOOK = 41;
    const TWITTER = 42;
    const LINKEDIN = 43;
    const INSTAGRAM = 44;
    const NEWS_ARTICLE = 45;
    const PINTEREST = 46;
    const YOUTUBE_VIDEO = 47;
    const PHONE_BOOK = 48;

    /**
     * Not a complete list, only contains ones that would make sense to prompt a user to enter
     *
     * @return array
     */
    public static function dropdownOptions(): array
    {
        return [
            self::ONLINE_SEARCH_ENGINE=>'Found us on a Search Engine',
            self::FACEBOOK=>'Found us on Facebook',
            self::TWITTER=>'Found us on Twitter',
            self::LINKEDIN=>'Found us on LinkedIn',
            self::INSTAGRAM=>'Found us on Instagram',
            self::PINTEREST=>'Found us on Pinterest',
            self::TRADESHOW=>'Met us at a Tradeshow',
            self::YOUTUBE_VIDEO=>'Watched a video of ours on Youtube',
            self::NEWS_ARTICLE=>'Saw us in the News',
            self::PHONE_BOOK=>'Found us in the Phonebook',
            self::LOCAL_CATALOG_DISTRIBUTION=>'Received a Physical Catalog',
            self::EMPLOYEE_REFERRAL=>'Referred by an Employee/Friend',
            self::CUSTOMER_REFERRAL=>'Referral by another Customer/Friend',
            self::PARTNER=>'Referred by our Partner',
            self::OTHER=>'Other'
        ];
    }
}