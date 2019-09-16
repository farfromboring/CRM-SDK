<?php
namespace CRM_SDK\SharedObjects\Cart;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\DateAddedTrait;
use CRM_SDK\Traits\IDTrait;

class ProductVariation implements APIObjectInterface
{
    use APIObjectTrait;
    use IDTrait;
    use DateAddedTrait;

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

    /** @var string|null */
    private $size;
    /** @var string|null */
    private $color;
    /** @var string|null */
    private $material;
    /** @var string|null */
    private $shape;

    /**
     * @param array $results
     * @return ProductVariation
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);

        $this->setSize((float) $results['size']);
        $this->setColor((float) $results['color']);
        $this->setMaterial((float) $results['material']);
        $this->setShape((float) $results['shape']);

        $this->setIsTaxable((bool) $results['is_taxable']);
        $this->setQuantity((int) $results['quantity']);
        $this->setCost((float) $results['cost']);
        $this->setPrice((float) $results['price']);
        $this->setTotalCost((float) $results['total_cost']);
        $this->setTotalPrice((float) $results['total_price']);
        $this->setDateAdded((!empty($results['date_added']) ? new \DateTime($results['date_added']) : null));

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'=>$this->getId(),
            'is_taxable'=>$this->isTaxable(),
            'quantity'=>$this->getQuantity(),
            'size'=>$this->getSize(),
            'color'=>$this->getColor(),
            'material'=>$this->getMaterial(),
            'shape'=>$this->getShape(),
            'cost'=>$this->getCost(),
            'price'=>$this->getPrice(),
            'total_cost'=>$this->getTotalCost(),
            'total_price'=>$this->getTotalPrice(),
        ];
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
     * @return ProductVariation
     */
    public function setIsTaxable(bool $isTaxable): ProductVariation
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
     * @return ProductVariation
     */
    public function setQuantity(int $quantity): ProductVariation
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
     * @return ProductVariation
     */
    public function setCost(float $cost): ProductVariation
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
     * @return ProductVariation
     */
    public function setPrice(float $price): ProductVariation
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
     * @return ProductVariation
     */
    public function setTotalCost(float $totalCost): ProductVariation
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
     * @return ProductVariation
     */
    public function setTotalPrice(float $totalPrice): ProductVariation
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSize(): ?string
    {
        return $this->size;
    }

    /**
     * @param string|null $size
     * @return ProductVariation
     */
    public function setSize(?string $size): ProductVariation
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param string|null $color
     * @return ProductVariation
     */
    public function setColor(?string $color): ProductVariation
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMaterial(): ?string
    {
        return $this->material;
    }

    /**
     * @param string|null $material
     * @return ProductVariation
     */
    public function setMaterial(?string $material): ProductVariation
    {
        $this->material = $material;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getShape(): ?string
    {
        return $this->shape;
    }

    /**
     * @param string|null $shape
     * @return ProductVariation
     */
    public function setShape(?string $shape): ProductVariation
    {
        $this->shape = $shape;
        return $this;
    }
}