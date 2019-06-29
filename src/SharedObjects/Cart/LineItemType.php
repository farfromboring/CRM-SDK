<?php
namespace CRM_SDK\SharedObjects\Cart;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Traits\IDToArrayTrait;

class LineItemType implements APIObjectInterface
{
    use APIObjectTrait;
    use IDToArrayTrait;
    use IDAndNameTrait;

    /**
     * @var bool
     */
    private $isPerItemQuantity = false;

    /**
     * @var bool
     */
    private $isPerColorQuantity = false;

    /**
     * @param array $results
     * @return LineItemType
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);
        $this->setName($results['name']);

        $this->setIsPerColorQuantity((bool) $results['is_per_color_quantity']);
        $this->setIsPerItemQuantity((bool) $results['is_per_item_quantity']);

        return $this;
    }

    /**
     * @return bool
     */
    public function isPerItemQuantity(): bool
    {
        return $this->isPerItemQuantity;
    }

    /**
     * @param bool $isPerItemQuantity
     * @return LineItemType
     */
    public function setIsPerItemQuantity(bool $isPerItemQuantity): LineItemType
    {
        $this->isPerItemQuantity = $isPerItemQuantity;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPerColorQuantity(): bool
    {
        return $this->isPerColorQuantity;
    }

    /**
     * @param bool $isPerColorQuantity
     * @return LineItemType
     */
    public function setIsPerColorQuantity(bool $isPerColorQuantity): LineItemType
    {
        $this->isPerColorQuantity = $isPerColorQuantity;
        return $this;
    }
}