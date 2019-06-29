<?php
namespace CRM_SDK\SharedObjects\Cart;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\CreateTrait;
use CRM_SDK\Traits\DateAddedTrait;
use CRM_SDK\Traits\IDTrait;

class LineItem implements APIObjectInterface
{
    use CreateTrait;
    use IDTrait;
    use DateAddedTrait;

    /** @var string */
    private $name;

    /** @var bool */
    private $isTaxable = true;

    /** @var int */
    private $quantity = 0;
    /** @var float */
    private $cost = 0;
    /** @var float */
    private $price = 0;
    /** @var float */
    private $totalCost = 0;
    /** @var float */
    private $totalPrice = 0;

    /** @var LineItemType */
    private $type;

    /**
     * @param array $results
     * @return LineItem
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);
        $this->setName($results['name']);
        $this->setIsTaxable((bool) $results['is_taxable']);
        $this->setQuantity((int) $results['quantity']);
        $this->setCost((float) $results['cost']);
        $this->setPrice((float) $results['price']);
        $this->setTotalCost((float) $results['total_cost']);
        $this->setTotalPrice((float) $results['total_price']);
        $this->setDateAdded((!empty($results['date_added']) ? new \DateTime($results['date_added']) : null));
        $this->setType(LineItemType::create()->populateFromAPIResults($results['type']));

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'=>$this->getId(),
            'name'=>$this->getName(),
            'is_taxable'=>$this->isTaxable(),
            'quantity'=>$this->getQuantity(),
            'cost'=>$this->getCost(),
            'price'=>$this->getPrice(),
            'total_cost'=>$this->getTotalCost(),
            'total_price'=>$this->getTotalPrice(),
            'type_id'=>$this->getType()->getId(),
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return LineItem
     */
    public function setName(string $name): LineItem
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return bool
     */
    public function isTaxable(): bool
    {
        return $this->isTaxable;
    }

    /**
     * @param bool $isTaxable
     * @return LineItem
     */
    public function setIsTaxable(bool $isTaxable): LineItem
    {
        $this->isTaxable = $isTaxable;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return LineItem
     */
    public function setQuantity(int $quantity): LineItem
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getCost(): float
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     * @return LineItem
     */
    public function setCost(float $cost): LineItem
    {
        $this->cost = $cost;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return LineItem
     */
    public function setPrice(float $price): LineItem
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return float
     */
    public function getTotalCost(): float
    {
        return $this->totalCost;
    }

    /**
     * @param float $totalCost
     * @return LineItem
     */
    public function setTotalCost(float $totalCost): LineItem
    {
        $this->totalCost = $totalCost;
        return $this;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @param float $totalPrice
     * @return LineItem
     */
    public function setTotalPrice(float $totalPrice): LineItem
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    /**
     * @return LineItemType
     */
    public function getType(): LineItemType
    {
        return $this->type;
    }

    /**
     * @param LineItemType $type
     * @return LineItem
     */
    public function setType(LineItemType $type): LineItem
    {
        $this->type = $type;
        return $this;
    }
}