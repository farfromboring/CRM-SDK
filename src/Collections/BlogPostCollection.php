<?php
namespace CRM_SDK\Collections;

use CRM_SDK\SharedObjects\Blog\BlogFilters;
use CRM_SDK\SharedObjects\Blog\BlogPost;

class BlogPostCollection
{
    /** @var BlogFilters */
    private $appliedFilters;

    /** @var BlogCategoryCollection */
    private $categories;

    /** @var BlogPost[] */
    private $posts;

    /**
     * @param array $results
     * @return BlogPostCollection
     * @throws \Exception
     */
    public static function createFromAPIResults(array $results)
    {
        $posts = [];
        foreach($results['posts'] as $post)
        {
            $posts[] = BlogPost::create()->populateFromAPIResults($post);
        }

        $blogCategoryCollection = BlogCategoryCollection::createFromAPIResults($results['categories']);

        $blogFilters = BlogFilters::create()->populateFromAPIResults($results['filters']);

        return new self($posts, $blogCategoryCollection, $blogFilters);
    }

    /**
     * BlogPostCollection constructor.
     * @param array $blogPosts
     * @param BlogCategoryCollection $blogCategoryCollection
     * @param BlogFilters $blogFilters
     */
    public function __construct(array $blogPosts, BlogCategoryCollection $blogCategoryCollection, BlogFilters $blogFilters)
    {
        $this->setPosts($blogPosts);
        $this->setAppliedFilters($blogFilters);
        $this->setCategories($blogCategoryCollection);
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
}