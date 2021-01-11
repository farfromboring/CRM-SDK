<?php
namespace CRM_SDK\ResponseObjects\PublicStores;

use CRM_SDK\Traits\IDTrait;

class Theme
{
    use IDTrait;

    /** @var string|null */
    private $name;
    /** @var string|null */
    private $folder;

    /**
     * Theme constructor.
     * @param array $results
     */
    public function __construct(array $results)
    {
        $this->setId((int) $results['id']);
        $this->setName($results['name']);
        $this->setFolder($results['folder']);
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Theme
     */
    public function setName(?string $name): Theme
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFolder(): ?string
    {
        return $this->folder;
    }

    /**
     * @param string|null $folder
     * @return Theme
     */
    public function setFolder(?string $folder): Theme
    {
        $this->folder = $folder;
        return $this;
    }
}