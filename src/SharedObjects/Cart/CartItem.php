<?php
namespace CRM_SDK\SharedObjects\Cart;

use CRM_SDK\SharedObjects\Product\Product;
use CRM_SDK\SharedObjects\SharedObjectInterface;
use CRM_SDK\SharedObjects\Traits\CreateTrait;
use CRM_SDK\SharedObjects\Traits\DateAddedTrait;
use CRM_SDK\SharedObjects\Traits\IDTrait;

class CartItem implements SharedObjectInterface
{
    use CreateTrait;

    use IDTrait;
    use DateAddedTrait;

    /** @var bool */
    private $requiresProof = true;
    /** @var bool */
    private $hasDecoration = true;

    /** @var int */
    private $quantity = 0;
    /** @var float */
    private $cost = 0;
    /** @var float */
    private $price = 0;

    /** @var \DateTime|null */
    private $dateUpdated;

    /** @var CartItemArtwork[] */
    private $artwork = [];

    /** @var LineItem[] */
    private $lineItems = [];

    /** @var Product */
    private $product;

    /** @var LineItem */
    private $productLineItem;

    /** @var CartItemDecoration */
    private $decoration;

    /**
     * @param array $results
     * @return CartItem
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);
        $this->setRequiresProof($results['requires_proof']);
        $this->setHasDecoration($results['has_decoration']);

        $this->setQuantity((int) $results['quantity']);
        $this->setCost((float) $results['cost']);
        $this->setPrice((float) $results['price']);

        $this->setDateUpdated((!empty($results['date_updated']) ? new \DateTime($results['date_updated']) : null));
        $this->setDateAdded((!empty($results['date_added']) ? new \DateTime($results['date_added']) : null));

        if( !empty($results['line_items']) )
        {
            $line_items = [];
            foreach($results['line_items'] as $line_item)
            {
                //if product
                if( $line_item['type']['id'] == 1 )
                {
                    $this->setProductLineItem(LineItem::create()->populateFromAPIResults($line_item));
                }

                $line_items[] = LineItem::create()->populateFromAPIResults($line_item);
            }
            $this->setLineItems($line_items);
        }

        if( !empty($results['decoration']) && $this->isHasDecoration() )
        {
            $this->setDecoration(CartItemDecoration::create()->populateFromAPIResults($results['decoration']));
        }

        if( !empty($results['artwork']) )
        {
            $artwork = [];
            foreach($results['artwork'] as $art)
            {
                $artwork[] = CartItemArtwork::create()->populateFromAPIResults($art);
            }
            $this->setArtwork($artwork);
        }

        if( !empty($results['product']) )
        {
            $this->setProduct(Product::create()->populateFromAPIResults($results['product']));
        }

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'=>$this->getId(),
            'requires_proof'=>$this->isRequiresProof(),
            'has_decoration'=>$this->isHasDecoration(),
            'quantity'=>$this->getQuantity(),
            'line_items'=>null,
            'decoration'=>($this->getDecoration() ? $this->getDecoration()->toArray() : null),
            'artwork'=>null,
            'product_id'=>($this->getProduct() ? $this->getProduct()->getId() : null),
        ];
    }

    /**
     * @return bool
     */
    public function isRequiresProof(): bool
    {
        return $this->requiresProof;
    }

    /**
     * @param bool $requiresProof
     * @return CartItem
     */
    public function setRequiresProof(bool $requiresProof): CartItem
    {
        $this->requiresProof = $requiresProof;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHasDecoration(): bool
    {
        return $this->hasDecoration;
    }

    /**
     * @param bool $hasDecoration
     * @return CartItem
     */
    public function setHasDecoration(bool $hasDecoration): CartItem
    {
        $this->hasDecoration = $hasDecoration;
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
     * @return CartItem
     */
    public function setQuantity(int $quantity): CartItem
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
     * @return CartItem
     */
    public function setCost(float $cost): CartItem
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
     * @return CartItem
     */
    public function setPrice(float $price): CartItem
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateUpdated(): ?\DateTime
    {
        return $this->dateUpdated;
    }

    /**
     * @param \DateTime|null $dateUpdated
     * @return CartItem
     */
    public function setDateUpdated(?\DateTime $dateUpdated): CartItem
    {
        $this->dateUpdated = $dateUpdated;
        return $this;
    }

    /**
     * @return LineItem[]
     */
    public function getLineItems(): array
    {
        return $this->lineItems;
    }

    /**
     * @param LineItem[] $lineItems
     * @return CartItem
     */
    public function setLineItems(array $lineItems): CartItem
    {
        $this->lineItems = $lineItems;
        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return CartItem
     */
    public function setProduct(Product $product): CartItem
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return LineItem
     */
    public function getProductLineItem(): LineItem
    {
        return $this->productLineItem;
    }

    /**
     * @param LineItem $productLineItem
     * @return CartItem
     */
    public function setProductLineItem(LineItem $productLineItem): CartItem
    {
        $this->productLineItem = $productLineItem;
        return $this;
    }

    /**
     * @return CartItemDecoration
     */
    public function getDecoration(): CartItemDecoration
    {
        return $this->decoration;
    }

    /**
     * @param CartItemDecoration $decoration
     * @return CartItem
     */
    public function setDecoration(CartItemDecoration $decoration): CartItem
    {
        $this->decoration = $decoration;
        return $this;
    }

    /**
     * @return CartItemArtwork[]
     */
    public function getArtwork(): array
    {
        return $this->artwork;
    }

    /**
     * @param CartItemArtwork[] $artwork
     * @return CartItem
     */
    public function setArtwork(array $artwork): CartItem
    {
        $this->artwork = $artwork;
        return $this;
    }
}