<?php
namespace CRM_SDK\SharedObjects\Cart;

use CRM_SDK\SharedObjects\Product\Product;
use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\DateAddedTrait;
use CRM_SDK\Traits\IDTrait;

class CartItem implements APIObjectInterface
{
    use APIObjectTrait;
    use IDTrait;
    use DateAddedTrait;

    /** @var string */
    private $name;

    /** @var bool */
    private $requiresProof = true;
    /** @var bool */
    private $hasDecoration = true;

    /** @var int */
    private $productQuantity = 0;

    /** @var float */
    private $totalCost = 0;
    /** @var float */
    private $totalPrice = 0;
    /** @var float */
    private $totalMarginAmount = 0;
    /** @var float */
    private $totalMarginPercent = 0;

    /** @var \DateTime|null */
    private $dateUpdated;

    /** @var CartItemArtwork[] */
    private $artwork = [];

    /** @var ProductVariation[] */
    private $productVariations = [];

    /** @var float */
    private $productCost = 0;
    /** @var float */
    private $productPrice = 0;
    /** @var float */
    private $productMarginAmount = 0;
    /** @var float */
    private $productMarginPercent = 0;

    /** @var LineItem[] */
    private $lineItems = [];

    /** @var float */
    private $lineItemCost = 0;
    /** @var float */
    private $lineItemPrice = 0;
    /** @var float */
    private $lineItemMarginAmount = 0;
    /** @var float */
    private $lineItemMarginPercent = 0;

    /** @var Product */
    private $product;

    /** @var CartItemDecoration */
    private $decoration;

    /** @var string|null */
    private $customizationNotes;

    /**
     * @param array $results
     * @return CartItem
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);
        $this->setName($results['name']);

        $this->setRequiresProof($results['requires_proof']);
        $this->setHasDecoration($results['has_decoration']);

        $this->setProductQuantity((int) $results['product_quantity']);
        $this->setCustomizationNotes($results['customization_notes']);

        $this->setTotalCost((float) $results['total_cost']);
        $this->setTotalPrice((float) $results['total_price']);
        $this->setTotalMarginAmount((float) $results['total_margin_amount']);
        $this->setTotalMarginPercent((float) $results['total_margin_percent']);

        $this->setProductCost((float) $results['product_cost']);
        $this->setProductPrice((float) $results['product_price']);
        $this->setProductMarginAmount((float) $results['product_margin_amount']);
        $this->setProductMarginPercent((float) $results['product_margin_percent']);

        $this->setLineItemCost((float) $results['line_item_cost']);
        $this->setLineItemPrice((float) $results['line_item_price']);
        $this->setLineItemMarginAmount((float) $results['line_item_margin_amount']);
        $this->setLineItemMarginPercent((float) $results['line_item_margin_percent']);

        $this->setDateUpdated((!empty($results['date_updated']) ? new \DateTime($results['date_updated']) : null));
        $this->setDateAdded((!empty($results['date_added']) ? new \DateTime($results['date_added']) : null));

        if( !empty($results['line_items']) )
        {
            $line_items = [];
            foreach($results['line_items'] as $line_item)
            {
                $line_items[] = LineItem::create()->populateFromAPIResults($line_item);
            }
            $this->setLineItems($line_items);
        }

        if( !empty($results['product_variations']) )
        {
            $product_variations = [];
            foreach($results['product_variations'] as $variation)
            {
                $product_variations[] = ProductVariation::create()->populateFromAPIResults($variation);
            }
            $this->setProductVariations($product_variations);
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
            'name'=>$this->getName(),
            'requires_proof'=>$this->isRequiresProof(),
            'has_decoration'=>$this->isHasDecoration(),
            'product_variations'=>null,
            'line_items'=>null,
            'decoration'=>($this->getDecoration() ? $this->getDecoration()->toArray() : null),
            'artwork'=>null,
            'product_id'=>($this->getProduct() ? $this->getProduct()->getId() : null),
            'customization_notes'=>$this->getCustomizationNotes(),
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
     * @return CartItem
     */
    public function setName(string $name): CartItem
    {
        $this->name = $name;
        return $this;
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
    public function getProductQuantity(): int
    {
        return $this->productQuantity;
    }

    /**
     * @param int $productQuantity
     * @return CartItem
     */
    public function setProductQuantity(int $productQuantity): CartItem
    {
        $this->productQuantity = $productQuantity;
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
     * @return CartItem
     */
    public function setTotalCost(float $totalCost): CartItem
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
     * @return CartItem
     */
    public function setTotalPrice(float $totalPrice): CartItem
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getTotalMarginAmount(): float
    {
        return $this->totalMarginAmount;
    }

    /**
     * @param float $totalMarginAmount
     * @return CartItem
     */
    public function setTotalMarginAmount(float $totalMarginAmount): CartItem
    {
        $this->totalMarginAmount = $totalMarginAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getTotalMarginPercent(): float
    {
        return $this->totalMarginPercent;
    }

    /**
     * @param float $totalMarginPercent
     * @return CartItem
     */
    public function setTotalMarginPercent(float $totalMarginPercent): CartItem
    {
        $this->totalMarginPercent = $totalMarginPercent;
        return $this;
    }

    /**
     * @return ProductVariation[]
     */
    public function getProductVariations(): array
    {
        return $this->productVariations;
    }

    /**
     * @param ProductVariation[] $productVariations
     * @return CartItem
     */
    public function setProductVariations(array $productVariations): CartItem
    {
        $this->productVariations = $productVariations;
        return $this;
    }

    /**
     * @return float
     */
    public function getProductCost(): float
    {
        return $this->productCost;
    }

    /**
     * @param float $productCost
     * @return CartItem
     */
    public function setProductCost(float $productCost): CartItem
    {
        $this->productCost = $productCost;
        return $this;
    }

    /**
     * @return float
     */
    public function getProductPrice(): float
    {
        return $this->productPrice;
    }

    /**
     * @param float $productPrice
     * @return CartItem
     */
    public function setProductPrice(float $productPrice): CartItem
    {
        $this->productPrice = $productPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getProductMarginAmount(): float
    {
        return $this->productMarginAmount;
    }

    /**
     * @param float $productMarginAmount
     * @return CartItem
     */
    public function setProductMarginAmount(float $productMarginAmount): CartItem
    {
        $this->productMarginAmount = $productMarginAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getProductMarginPercent(): float
    {
        return $this->productMarginPercent;
    }

    /**
     * @param float $productMarginPercent
     * @return CartItem
     */
    public function setProductMarginPercent(float $productMarginPercent): CartItem
    {
        $this->productMarginPercent = $productMarginPercent;
        return $this;
    }

    /**
     * @return float
     */
    public function getLineItemCost(): float
    {
        return $this->lineItemCost;
    }

    /**
     * @param float $lineItemCost
     * @return CartItem
     */
    public function setLineItemCost(float $lineItemCost): CartItem
    {
        $this->lineItemCost = $lineItemCost;
        return $this;
    }

    /**
     * @return float
     */
    public function getLineItemPrice(): float
    {
        return $this->lineItemPrice;
    }

    /**
     * @param float $lineItemPrice
     * @return CartItem
     */
    public function setLineItemPrice(float $lineItemPrice): CartItem
    {
        $this->lineItemPrice = $lineItemPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getLineItemMarginAmount(): float
    {
        return $this->lineItemMarginAmount;
    }

    /**
     * @param float $lineItemMarginAmount
     * @return CartItem
     */
    public function setLineItemMarginAmount(float $lineItemMarginAmount): CartItem
    {
        $this->lineItemMarginAmount = $lineItemMarginAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getLineItemMarginPercent(): float
    {
        return $this->lineItemMarginPercent;
    }

    /**
     * @param float $lineItemMarginPercent
     * @return CartItem
     */
    public function setLineItemMarginPercent(float $lineItemMarginPercent): CartItem
    {
        $this->lineItemMarginPercent = $lineItemMarginPercent;
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

    /**
     * @return string|null
     */
    public function getCustomizationNotes(): ?string
    {
        return $this->customizationNotes;
    }

    /**
     * @param string|null $customizationNotes
     * @return CartItem
     */
    public function setCustomizationNotes(?string $customizationNotes): CartItem
    {
        $this->customizationNotes = $customizationNotes;
        return $this;
    }
}