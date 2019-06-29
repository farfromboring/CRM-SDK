<?php
namespace CRM_SDK\SharedObjects\Product;

use CRM_SDK\Traits\CreateTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\IDToArrayTrait;

class ProductCategory implements APIObjectInterface
{
    use CreateTrait;
    use IDToArrayTrait;
    use IDAndNameTrait;

    /** @var ProductCategory */
    private $parent;

    /**
     * ProductCategory constructor.
     * @param array $results
     * @return ProductCategory
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);
        $this->setName($results['name']);
        if( !empty($results['parent']) )
        {
            $this->setParent(ProductCategory::create()->populateFromAPIResults([
                'id'=>$results['parent_id'],
                'name'=>$results['parent_name']
            ]));
        }

        return $this;
    }

    /**
     * @return ProductCategory
     */
    public function getParent(): ProductCategory
    {
        return $this->parent;
    }

    /**
     * @param ProductCategory $parent
     * @return ProductCategory
     */
    public function setParent(ProductCategory $parent): ProductCategory
    {
        $this->parent = $parent;
        return $this;
    }
}