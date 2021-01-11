<?php
namespace CRM_SDK\SharedObjects\Blog;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;

class BlogFilters implements APIObjectInterface
{
    use APIObjectTrait;

    /** @var string|null */
    private $query;

    /** @var int[] */
    private $categoryIDs = [];

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'query'=>$this->getQuery(),
            'category_ids'=>$this->getCategoryIDs()
        ];
    }

    /**
     * @param array $results
     * @return BlogFilters
     */
    public function populateFromAPIResults(array $results): BlogFilters
    {
        $this->setCategoryIDs($results['category_ids']);
        $this->setQuery($results['query']);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getQuery(): ?string
    {
        return $this->query;
    }

    /**
     * @param string|null $query
     * @return BlogFilters
     */
    public function setQuery(?string $query): BlogFilters
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @return int[]
     */
    public function getCategoryIDs(): array
    {
        return $this->categoryIDs;
    }

    /**
     * @param int $categoryID
     * @return $this
     */
    public function addCategoryID(int $categoryID): BlogFilters
    {
        $this->categoryIDs[] = $categoryID;
        return $this;
    }

    /**
     * @param int[] $categoryIDs
     * @return BlogFilters
     */
    public function setCategoryIDs(array $categoryIDs): BlogFilters
    {
        $this->categoryIDs = $categoryIDs;
        return $this;
    }
}