<?php
namespace CRM_SDK\ResponseObjects\PublicStores;

use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Traits\IDToArrayTrait;

class Sidebar
{
    use APIObjectTrait;
    use IDAndNameTrait, IDToArrayTrait {
        IDToArrayTrait::toArray insteadof IDAndNameTrait;
    }

    /**
     * @var string|null
     */
    private $content;

    /**
     * Environment constructor.
     * @param array $results
     */
    public function __construct(array $results)
    {
        $this->setId((int) $results['id']);
        $this->setName($results['name']);

        if( isset($results['content']) )
        {
            $this->setContent($results['content']);
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     * @return Sidebar
     */
    public function setContent(?string $content): Sidebar
    {
        $this->content = $content;
        return $this;
    }
}