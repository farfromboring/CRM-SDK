<?php
namespace CRM_SDK\SharedObjects\Product;

use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\IDToArrayTrait;

class ProductCategory implements APIObjectInterface
{
    use APIObjectTrait;
    use IDAndNameTrait, IDToArrayTrait {
        IDToArrayTrait::toArray insteadof IDAndNameTrait;
    }

    /** @var ProductCategory|null */
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
        if( !empty($results['parent_id']) )
        {
            $this->setParent(ProductCategory::create()->populateFromAPIResults([
                'id'=>$results['parent_id'],
                'name'=>$results['parent_name']
            ]));
        }

        return $this;
    }

    /**
     * @return ProductCategory|null
     */
    public function getParent(): ?ProductCategory
    {
        return $this->parent;
    }

    /**
     * @param ProductCategory|null $parent
     * @return ProductCategory
     */
    public function setParent(?ProductCategory $parent): ProductCategory
    {
        $this->parent = $parent;
        return $this;
    }
}