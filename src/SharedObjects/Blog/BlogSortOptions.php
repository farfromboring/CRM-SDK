<?php
namespace CRM_SDK\SharedObjects\Blog;

use CRM_SDK\Interfaces\DropdownInterface;

class BlogSortOptions implements DropdownInterface
{
    //by publish date
    const OLDEST_FIRST = 'oldest_first';
    const NEWEST_FIRST = 'newest_first';
    //recent views
    const TRENDING = 'trending';
    //all-time views
    const MOST_VIEWS = 'most_views';
    const LEAST_VIEWS = 'least_views';
    //author's first name
    const AUTHOR_ASC = 'author_name_asc';
    const AUTHOR_DESC = 'author_name_desc';

    /**
     * @return array
     */
    public static function dropdownOptions(): array
    {
        return [
          self::OLDEST_FIRST=>'Oldest First',
          self::NEWEST_FIRST=>'Newest First',
          self::TRENDING=>'Trending First',
          self::MOST_VIEWS=>'Most Viewed',
          self::LEAST_VIEWS=>'Least Viewed',
          self::AUTHOR_ASC=>'Author A-Z',
          self::AUTHOR_DESC=>'Author Z-A',
        ];
    }
}