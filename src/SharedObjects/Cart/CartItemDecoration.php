<?php
namespace CRM_SDK\SharedObjects\Cart;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\SharedObjects\Supplier\Supplier;
use CRM_SDK\Traits\CreateTrait;
use CRM_SDK\Traits\IDTrait;

class CartItemDecoration implements APIObjectInterface
{
    use CreateTrait;
    use IDTrait;

    /** @var ImprintMethod */
    private $imprintMethod;

    /** @var Supplier */
    private $supplier;

    /** @var string|null */
    private $location;
    /** @var string|null */
    private $area;
    /** @var string|null */
    private $colors;
    /** @var string|null */
    private $notes;

    /**
     * @param array $results
     * @return CartItemDecoration
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);
        if( !empty($results['imprint_method']) ) {
            $this->setImprintMethod(ImprintMethod::create()->populateFromAPIResults($results['imprint_method']));
        }
        if( !empty($results['supplier']) ) {
            $this->setSupplier(Supplier::create()->populateFromAPIResults($results['supplier']));
        }
        $this->setLocation($results['location']);
        $this->setArea($results['area']);
        $this->setColors($results['colors']);
        $this->setNotes($results['notes']);

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'=>$this->getId(),
            'imprint_method_id'=>$this->getImprintMethod()->getId(),
            'supplier_id'=>$this->getSupplier()->getId(),
            'location'=>$this->getLocation(),
            'area'=>$this->getArea(),
            'colors'=>$this->getColors(),
            'notes'=>$this->getNotes()
        ];
    }

    /**
     * @return ImprintMethod
     */
    public function getImprintMethod(): ImprintMethod
    {
        return $this->imprintMethod;
    }

    /**
     * @param ImprintMethod $imprintMethod
     * @return CartItemDecoration
     */
    public function setImprintMethod(ImprintMethod $imprintMethod): CartItemDecoration
    {
        $this->imprintMethod = $imprintMethod;
        return $this;
    }

    /**
     * @return Supplier
     */
    public function getSupplier(): Supplier
    {
        return $this->supplier;
    }

    /**
     * @param Supplier $supplier
     * @return CartItemDecoration
     */
    public function setSupplier(Supplier $supplier): CartItemDecoration
    {
        $this->supplier = $supplier;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param string|null $location
     * @return CartItemDecoration
     */
    public function setLocation(?string $location): CartItemDecoration
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getArea(): ?string
    {
        return $this->area;
    }

    /**
     * @param string|null $area
     * @return CartItemDecoration
     */
    public function setArea(?string $area): CartItemDecoration
    {
        $this->area = $area;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getColors(): ?string
    {
        return $this->colors;
    }

    /**
     * @param string|null $colors
     * @return CartItemDecoration
     */
    public function setColors(?string $colors): CartItemDecoration
    {
        $this->colors = $colors;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }

    /**
     * @param string|null $notes
     * @return CartItemDecoration
     */
    public function setNotes(?string $notes): CartItemDecoration
    {
        $this->notes = $notes;
        return $this;
    }
}