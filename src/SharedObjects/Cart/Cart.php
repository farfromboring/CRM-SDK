<?php
namespace CRM_SDK\SharedObjects\Cart;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\CreateTrait;
use CRM_SDK\Traits\DateAddedTrait;
use CRM_SDK\Traits\IDTrait;

class Cart implements APIObjectInterface
{
    use CreateTrait;
    use IDTrait;
    use DateAddedTrait;

    /** @var string|null */
    private $customerPO;
    /** @var string|null */
    private $customerComments;

    /** @var \DateTime|null */
    private $inHandsDate;
    /** @var bool|null */
    private $inHandsDateFirm;

    /** @var bool */
    private $isTaxExempt = false;
    /** @var bool */
    private $splitTax = false;

    /** @var int */
    private $totalItems = 0;
    /** @var float */
    private $lineItemCost = 0;
    /** @var float */
    private $lineItemPrice = 0;
    /** @var float */
    private $shippingCost = 0;
    /** @var float */
    private $shippingPrice = 0;
    /** @var float */
    private $taxTotal = 0;
    /** @var float */
    private $creditCardFees = 0;
    /** @var float */
    private $couponDiscount = 0;
    /** @var float */
    private $grandTotalCost = 0;
    /** @var float */
    private $grandTotalPrice = 0;
    /** @var float */
    private $grandTotalPriceWithCreditCardFees = 0;
    /** @var float */
    private $grandTotalProfit = 0;

    /** @var \DateTime|null */
    private $dateUpdated;

    /** @var CartItem[] */
    private $items = [];

    /**
     * @param array $results
     * @return Cart
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);

        $this->setCustomerPO($results['customer_po']);
        $this->setCustomerComments($results['customer_comments']);

        $this->setInHandsDate((!empty($results['in_hands_date']) ? new \DateTime($results['in_hands_date']) : null));
        $this->setInHandsDateFirm((bool) $results['in_hands_date_firm']);

        $this->setIsTaxExempt($results['is_tax_exempt']);
        $this->setSplitTax($results['split_tax']);

        $this->setTotalItems((int) $results['total_cart_items']);
        $this->setLineItemCost((float) $results['line_item_total_cost']);
        $this->setLineItemPrice((float) $results['line_item_total_price']);
        $this->setShippingCost((float) $results['shipping_cost']);
        $this->setShippingPrice((float) $results['shipping_price']);
        $this->setTaxTotal((float) $results['tax_total']);
        $this->setCreditCardFees((float) $results['credit_card_fees']);
        $this->setCouponDiscount((float) $results['coupon_discount']);
        $this->setGrandTotalCost((float) $results['grand_total_cost']);
        $this->setGrandTotalPrice((float) $results['grand_total_price']);
        $this->setGrandTotalPriceWithCreditCardFees((float) $results['grand_total_price_with_cc_fees']);
        $this->setGrandTotalProfit((float) $results['grand_total_profit']);

        $this->setDateUpdated((!empty($results['date_updated']) ? new \DateTime($results['date_updated']) : null));
        $this->setDateAdded((!empty($results['date_added']) ? new \DateTime($results['date_added']) : null));

        if( !empty($results['cart_items']) ) {
            $cart_items = [];
            foreach ($results['cart_items'] as $item)
            {
                $cart_items[] = CartItem::create()->populateFromAPIResults($item);
            }
            $this->setItems($cart_items);
        }

        return $this;
    }

    public function toArray(): array
    {
        return [
            'id'=>$this->getId(),
            'customer_po'=>$this->getCustomerPO(),
            'customer_comments'=>$this->getCustomerComments(),
            'in_hands_date'=>($this->getInHandsDate() ? $this->getInHandsDate()->format("Y-m-d") : null),
            'in_hands_date_firm'=>$this->getInHandsDateFirm(),
            'is_tax_exempt'=>$this->isTaxExempt(),
            'split_tax'=>$this->isSplitTax(),
        ];
    }

    /**
     * @return string|null
     */
    public function getCustomerPO(): ?string
    {
        return $this->customerPO;
    }

    /**
     * @param string|null $customerPO
     * @return Cart
     */
    public function setCustomerPO(?string $customerPO): Cart
    {
        $this->customerPO = $customerPO;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCustomerComments(): ?string
    {
        return $this->customerComments;
    }

    /**
     * @param string|null $customerComments
     * @return Cart
     */
    public function setCustomerComments(?string $customerComments): Cart
    {
        $this->customerComments = $customerComments;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getInHandsDate(): ?\DateTime
    {
        return $this->inHandsDate;
    }

    /**
     * @param \DateTime|null $inHandsDate
     * @return Cart
     */
    public function setInHandsDate(?\DateTime $inHandsDate): Cart
    {
        $this->inHandsDate = $inHandsDate;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getInHandsDateFirm(): ?bool
    {
        return $this->inHandsDateFirm;
    }

    /**
     * @param bool|null $inHandsDateFirm
     * @return Cart
     */
    public function setInHandsDateFirm(?bool $inHandsDateFirm): Cart
    {
        $this->inHandsDateFirm = $inHandsDateFirm;
        return $this;
    }

    /**
     * @return bool
     */
    public function isTaxExempt(): bool
    {
        return $this->isTaxExempt;
    }

    /**
     * @param bool $isTaxExempt
     * @return Cart
     */
    public function setIsTaxExempt(bool $isTaxExempt): Cart
    {
        $this->isTaxExempt = $isTaxExempt;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSplitTax(): bool
    {
        return $this->splitTax;
    }

    /**
     * @param bool $splitTax
     * @return Cart
     */
    public function setSplitTax(bool $splitTax): Cart
    {
        $this->splitTax = $splitTax;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalItems(): int
    {
        return $this->totalItems;
    }

    /**
     * @param int $totalItems
     * @return Cart
     */
    public function setTotalItems(int $totalItems): Cart
    {
        $this->totalItems = $totalItems;
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
     * @return Cart
     */
    public function setLineItemCost(float $lineItemCost): Cart
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
     * @return Cart
     */
    public function setLineItemPrice(float $lineItemPrice): Cart
    {
        $this->lineItemPrice = $lineItemPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getShippingCost(): float
    {
        return $this->shippingCost;
    }

    /**
     * @param float $shippingCost
     * @return Cart
     */
    public function setShippingCost(float $shippingCost): Cart
    {
        $this->shippingCost = $shippingCost;
        return $this;
    }

    /**
     * @return float
     */
    public function getShippingPrice(): float
    {
        return $this->shippingPrice;
    }

    /**
     * @param float $shippingPrice
     * @return Cart
     */
    public function setShippingPrice(float $shippingPrice): Cart
    {
        $this->shippingPrice = $shippingPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getTaxTotal(): float
    {
        return $this->taxTotal;
    }

    /**
     * @param float $taxTotal
     * @return Cart
     */
    public function setTaxTotal(float $taxTotal): Cart
    {
        $this->taxTotal = $taxTotal;
        return $this;
    }

    /**
     * @return float
     */
    public function getCreditCardFees(): float
    {
        return $this->creditCardFees;
    }

    /**
     * @param float $creditCardFees
     * @return Cart
     */
    public function setCreditCardFees(float $creditCardFees): Cart
    {
        $this->creditCardFees = $creditCardFees;
        return $this;
    }

    /**
     * @return float
     */
    public function getCouponDiscount(): float
    {
        return $this->couponDiscount;
    }

    /**
     * @param float $couponDiscount
     * @return Cart
     */
    public function setCouponDiscount(float $couponDiscount): Cart
    {
        $this->couponDiscount = $couponDiscount;
        return $this;
    }

    /**
     * @return float
     */
    public function getGrandTotalCost(): float
    {
        return $this->grandTotalCost;
    }

    /**
     * @param float $grandTotalCost
     * @return Cart
     */
    public function setGrandTotalCost(float $grandTotalCost): Cart
    {
        $this->grandTotalCost = $grandTotalCost;
        return $this;
    }

    /**
     * @return float
     */
    public function getGrandTotalPrice(): float
    {
        return $this->grandTotalPrice;
    }

    /**
     * @param float $grandTotalPrice
     * @return Cart
     */
    public function setGrandTotalPrice(float $grandTotalPrice): Cart
    {
        $this->grandTotalPrice = $grandTotalPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getGrandTotalPriceWithCreditCardFees(): float
    {
        return $this->grandTotalPriceWithCreditCardFees;
    }

    /**
     * @param float $grandTotalPriceWithCreditCardFees
     * @return Cart
     */
    public function setGrandTotalPriceWithCreditCardFees(float $grandTotalPriceWithCreditCardFees): Cart
    {
        $this->grandTotalPriceWithCreditCardFees = $grandTotalPriceWithCreditCardFees;
        return $this;
    }

    /**
     * @return float
     */
    public function getGrandTotalProfit(): float
    {
        return $this->grandTotalProfit;
    }

    /**
     * @param float $grandTotalProfit
     * @return Cart
     */
    public function setGrandTotalProfit(float $grandTotalProfit): Cart
    {
        $this->grandTotalProfit = $grandTotalProfit;
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
     * @return Cart
     */
    public function setDateUpdated(?\DateTime $dateUpdated): Cart
    {
        $this->dateUpdated = $dateUpdated;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateAdded(): ?\DateTime
    {
        return $this->dateAdded;
    }

    /**
     * @param \DateTime|null $dateAdded
     * @return Cart
     */
    public function setDateAdded(?\DateTime $dateAdded): Cart
    {
        $this->dateAdded = $dateAdded;
        return $this;
    }

    /**
     * @return CartItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param CartItem[] $items
     * @return Cart
     */
    public function setItems(array $items): Cart
    {
        $this->items = $items;
        return $this;
    }
}