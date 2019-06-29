<?php
namespace CRM_SDK\SharedObjects\Cart;

use CRM_SDK\SharedObjects\File\File;
use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\IDToArrayTrait;
use CRM_SDK\Traits\IDTrait;

class CartItemArtwork implements APIObjectInterface
{
    use APIObjectTrait;
    use IDToArrayTrait;
    use IDTrait;

    /** @var File */
    private $file;

    /**
     * @param array $results
     * @return CartItemArtwork
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int)$results['id']);
        $this->setFile(File::create()->populateFromAPIResults($results['file']));

        return $this;
    }

    /**
     * @return File
     */
    public function getFile(): File
    {
        return $this->file;
    }

    /**
     * @param File $file
     * @return CartItemArtwork
     */
    public function setFile(File $file): CartItemArtwork
    {
        $this->file = $file;
        return $this;
    }
}