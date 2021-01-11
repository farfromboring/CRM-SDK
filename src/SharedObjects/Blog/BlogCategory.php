<?php
namespace CRM_SDK\SharedObjects\Blog;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\IDToArrayTrait;
use CRM_SDK\Traits\IDTrait;

class BlogCategory implements APIObjectInterface
{
    use APIObjectTrait;
    use IDToArrayTrait;
    use IDTrait;

    /** @var string */
    private $name;

    /** @var string */
    private $permalink;

    /**
     * @param array $results
     * @return BlogCategory
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);

        $this->setName($results['name']);
        $this->setPermalink($results['permalink']);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return BlogCategory
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPermalink()
    {
        return $this->permalink;
    }

    /**
     * @param mixed $permalink
     * @return BlogCategory
     */
    public function setPermalink($permalink)
    {
        $this->permalink = $permalink;
        return $this;
    }
}