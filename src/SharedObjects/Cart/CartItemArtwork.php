<?php
namespace CRM_SDK\SharedObjects\Cart;

use CRM_SDK\SharedObjects\File\File;
use CRM_SDK\SharedObjects\SharedObjectInterface;
use CRM_SDK\SharedObjects\Traits\CreateTrait;
use CRM_SDK\SharedObjects\Traits\IDToArrayTrait;
use CRM_SDK\SharedObjects\Traits\IDTrait;

class CartItemArtwork implements SharedObjectInterface
{
    use CreateTrait;
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