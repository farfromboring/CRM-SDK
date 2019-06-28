<?php
namespace CRM_SDK\SharedObjects\Product;

use CRM_SDK\SharedObjects\Traits\IDToArrayTrait;
use CRM_SDK\SharedObjects\Traits\IDTrait;
use CRM_SDK\SharedObjects\SharedObjectInterface;
use CRM_SDK\SharedObjects\Traits\CreateTrait;

class ProductImage implements SharedObjectInterface
{
    use CreateTrait;
    use IDToArrayTrait;
    use IDTrait;

    /** @var int */
    private $mediaID;
    /** @var string */
    private $url;

    /**
     * @param array $results
     * @return ProductImage
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);
        $this->setMediaID((int) $results['media_id']);
        $this->setUrl($results['url']);

        return $this;
    }

    /**
     * @return int
     */
    public function getMediaID(): int
    {
        return $this->mediaID;
    }

    /**
     * @param int $mediaID
     * @return ProductImage
     */
    public function setMediaID(int $mediaID): ProductImage
    {
        $this->mediaID = $mediaID;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return ProductImage
     */
    public function setUrl(string $url): ProductImage
    {
        $this->url = $url;
        return $this;
    }
}