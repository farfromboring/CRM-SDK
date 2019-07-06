<?php
namespace CRM_SDK\SharedObjects\Blog;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;

class BlogPostCollection implements APIObjectInterface
{
    use APIObjectTrait;

    /** @var BlogFilters */
    private $appliedFilters;

    /** @var BlogCategoryCollection */
    private $categories;

    /** @var BlogPost[] */
    private $posts;

    /** @var int */
    private $currentPage;

    /** @var int */
    private $pageLength;

    /** @var boolean */
    private $hasNextPage;

    /** @var boolean */
    private $hasPreviousPage;

    /**
     * @param array $results
     * @return BlogPostCollection
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $posts = [];
        foreach($results['posts'] as $post)
        {
            $posts[] = BlogPost::create()->populateFromAPIResults($post);
        }
        $this->setPosts($posts);

        $this->setCategories(BlogCategoryCollection::createFromAPIResults($results['categories']));

        $this->setAppliedFilters(BlogFilters::create()->populateFromAPIResults($results['filters']));

        $this->setCurrentPage((int) $results['current_page']);
        $this->setPageLength((int) $results['page_length']);

        $this->setCurrentPage((bool) $results['has_next_page']);
        $this->setCurrentPage((bool) $results['has_previous_page']);

        return $this;
    }

    /**
     * Unused at the moment since we don't send posts back to the API
     *
     * @return array
     */
    public function toArray(): array
    {
        return [];
    }

    /**
     * @return BlogFilters
     */
    public function getAppliedFilters(): BlogFilters
    {
        return $this->appliedFilters;
    }

    /**
     * @param BlogFilters $appliedFilters
     * @return BlogPostCollection
     */
    public function setAppliedFilters(BlogFilters $appliedFilters): BlogPostCollection
    {
        $this->appliedFilters = $appliedFilters;
        return $this;
    }

    /**
     * @return BlogCategoryCollection
     */
    public function getCategories(): BlogCategoryCollection
    {
        return $this->categories;
    }

    /**
     * @param BlogCategoryCollection $categories
     * @return BlogPostCollection
     */
    public function setCategories(BlogCategoryCollection $categories): BlogPostCollection
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @return BlogPost[]
     */
    public function getPosts(): array
    {
        return $this->posts;
    }

    /**
     * @param BlogPost[] $posts
     * @return BlogPostCollection
     */
    public function setPosts(array $posts): BlogPostCollection
    {
        $this->posts = $posts;
        return $this;
    }

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @param int $currentPage
     * @return BlogPostCollection
     */
    public function setCurrentPage(int $currentPage): BlogPostCollection
    {
        $this->currentPage = $currentPage;
        return $this;
    }

    /**
     * @return int
     */
    public function getPageLength(): int
    {
        return $this->pageLength;
    }

    /**
     * @param int $pageLength
     * @return BlogPostCollection
     */
    public function setPageLength(int $pageLength): BlogPostCollection
    {
        $this->pageLength = $pageLength;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHasNextPage(): bool
    {
        return $this->hasNextPage;
    }

    /**
     * @param bool $hasNextPage
     * @return BlogPostCollection
     */
    public function setHasNextPage(bool $hasNextPage): BlogPostCollection
    {
        $this->hasNextPage = $hasNextPage;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHasPreviousPage(): bool
    {
        return $this->hasPreviousPage;
    }

    /**
     * @param bool $hasPreviousPage
     * @return BlogPostCollection
     */
    public function setHasPreviousPage(bool $hasPreviousPage): BlogPostCollection
    {
        $this->hasPreviousPage = $hasPreviousPage;
        return $this;
    }
}