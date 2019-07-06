<?php
namespace CRM_SDK\Endpoints;

use CRM_SDK\Client;
use CRM_SDK\Exceptions\APIBadRequestException;
use CRM_SDK\Exceptions\APIForbiddenException;
use CRM_SDK\Exceptions\APIInternalServerErrorException;
use CRM_SDK\Exceptions\APIResourceNotFoundException;
use CRM_SDK\Exceptions\APIUnauthorizedException;
use CRM_SDK\SharedObjects\Blog\BlogCategoryCollection;
use CRM_SDK\SharedObjects\Blog\BlogFilters;
use CRM_SDK\SharedObjects\Blog\BlogPost;
use CRM_SDK\SharedObjects\Blog\BlogPostCollection;
use GuzzleHttp\Exception\GuzzleException;

class BlogEndpoint extends Client
{
    protected $endpoint ='/blog';

    /**
     * Gets blog posts in a BlogPostCollection
     *
     * You can filter the results by category, search by a string, etc by providing an instance of BlogFilters
     *
     * This endpoint does not return drafts
     *
     * Example:
     *
     * //create a filter object and set whatever filters you want (usually provided by the user)
     * $filters = BlogFilters::create()->setQuery('whatever you want to search for')->addCategoryID(1);
     *
     * //get 15 posts from page 1 with the above filters applied
     * $post_collection = BlogEndpoint::create()->getBlogPosts(1, 15, $filters);
     *
     * //display search field with value from $post_collection->getAppliedFilters()->getQuery();
     *
     * foreach($post_collection->getCategories()->getAssociativeArray() as $category_id=>$category_name)
     * {
     *     //display categories as filter options
     *
     *     if( in_array($category_id, $post_collection->getAppliedFilters()->getCategoryIDs()) )
     *     {
     *         //show as selected
     *     }
     * }
     *
     * foreach($post_collection->getPosts() as $post)
     * {
     *    //display each post
     * }
     *
     * @param int $page
     * @param int $page_length
     * @param BlogFilters|null $filters
     * @return BlogPostCollection
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getBlogPosts(int $page = 1, int $page_length = 10, ?BlogFilters $filters = null)
    {
        $results = $this->get($this->endpoint.'/posts', [
            'page' => $page,
            'page_length'=>$page_length,
            'filters'=>$filters->toArray(),
        ]);

        return BlogPostCollection::create()->populateFromAPIResults($results);
    }

    /**
     * Gets blog post by permalink
     *
     * This endpoint WILL return drafts (which should not be displayed to the public), so do a check prior to rendering the page
     *    use $blog_post->isDraft()
     *
     * @return BlogCategoryCollection
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     */
    public function getCategories()
    {
        $results = $this->get($this->endpoint.'/categories', [
        ]);

        return BlogCategoryCollection::createFromAPIResults($results['categories']);
    }

    /**
     * Gets blog post by permalink
     *
     * This endpoint WILL return drafts (which should not be displayed to the public), so do a check prior to rendering the page
     *    use $blog_post->isDraft()
     *
     * @param string $permalink
     * @param bool $return_next_and_previous_posts
     * @return BlogPost
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getBlogPostByPermalink(string $permalink, bool $return_next_and_previous_posts = true)
    {
        $results = $this->get($this->endpoint.'/post-by-permalink', [
            'permalink'=>$permalink,
            'return_next_and_previous_posts'=>$return_next_and_previous_posts,
        ]);

        return BlogPost::create()->populateFromAPIResults($results);
    }

    /**
     * Gets blog post by ID
     *
     * This endpoint WILL return drafts (which should not be displayed to the public), so do a check prior to rendering the page
     *    use $blog_post->isDraft()
     *
     * @param int $id
     * @param bool $return_next_and_previous_posts
     * @return BlogPost
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getBlogPostByID(int $id, bool $return_next_and_previous_posts = true)
    {
        $results = $this->get($this->endpoint.'/post-by-id', [
            'id'=>$id,
            'return_next_and_previous_posts'=>$return_next_and_previous_posts,
        ]);

        return BlogPost::create()->populateFromAPIResults($results);
    }
}