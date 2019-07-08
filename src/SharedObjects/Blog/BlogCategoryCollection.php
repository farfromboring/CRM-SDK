<?php
namespace CRM_SDK\SharedObjects\Blog;

class BlogCategoryCollection extends \ArrayIterator
{
    /**
     * @param array $results
     * @return BlogCategoryCollection
     */
    public static function createFromAPIResults(array $results)
    {
        $cats = [];
        foreach($results as $cat)
        {
            $cats[] = BlogCategory::create()->populateFromAPIResults($cat);
        }

        return new self($cats);
    }

    /**
     * Returns an array with the key as the category ID and the value as the category name
     *
     * @return string[]
     */
    public function getAssociativeArray()
    {
        $names = [];

        /** @var BlogCategory $category */
        foreach($this as $category)
        {
            $names[$category->getId()] = $category->getName();
        }

        return $names;
    }

    /**
     * @param string $separator
     * @return string
     */
    public function join(string $separator = ',')
    {
        return implode($separator, $this->getAssociativeArray());
    }
}