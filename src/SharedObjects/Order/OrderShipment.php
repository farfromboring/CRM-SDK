<?php
namespace CRM_SDK\SharedObjects\Order;

use CRM_SDK\SharedObjects\Address\Address;
use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\SharedObjects\Shipping\TrackingNumber;
use CRM_SDK\Traits\CreateTrait;
use CRM_SDK\Traits\IDTrait;

class OrderShipment implements APIObjectInterface
{
    use CreateTrait;
    use IDTrait;

    /** @var ShippingCarrier|null */
    private $carrier;

    /** @var ShippingMethod|null */
    private $shippingMethod;

    /** @var TrackingNumber[] */
    private $trackingNumbers;

    /** @var string|null */
    private $recipientAtAddress;

    /** @var Address */
    private $address;

    /** @var bool */
    private $isPickup = false;

    /** @var bool  */
    private $hasShipped = false;

    /** @var bool  */
    private $isDelivered = false;

    /** @var \DateTime|null  */
    private $inHandsDate;

    /** @var \DateTime|null  */
    private $estimatedPickupDate;

    /** @var \DateTime|null  */
    private $estimatedShipDate;

    /** @var \DateTime|null  */
    private $dateShipped;

    /** @var \DateTime|null  */
    private $dateDelivered;

    /** @var \DateTime|null  */
    private $datePickedUp;

    /** @var array */
    private $cartItemIDs = [];

    /**
     * @param array $results
     * @return OrderShipment
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);

        if( isset($results['carrier']) && is_array($results['carrier']) ) {
            $this->setCarrier(ShippingCarrier::create()->populateFromAPIResults($results['carrier']));
        }

        if( isset($results['shipping_method']) && is_array($results['shipping_method']) ) {
            $this->setShippingMethod(ShippingMethod::create()->populateFromAPIResults($results['shipping_method']));
        }

        if( !empty($results['tracking_numbers']) )
        {
            $tns = [];
            foreach($results['tracking_numbers'] as $tracking_number)
            {
                $tns[] = TrackingNumber::create()->populateFromAPIResults($tracking_number);
            }
            $this->setTrackingNumbers($tns);
        }

        $this->setRecipientAtAddress($results['recipient_at_address']);

        $this->setAddress(!empty($results['address']) ? Address::create()->populateFromAPIResults($results['address']) : null);

        $this->setIsPickup((bool) $results['is_pickup']);

        $this->setHasShipped((bool) $results['has_shipped']);
        $this->setIsDelivered((bool) $results['is_delivered']);

        $this->setInHandsDate((!empty($results['in_hands_date']) ? new \DateTime($results['in_hands_date']) : null));
        $this->setEstimatedPickupDate((!empty($results['estimated_pickup_date']) ? new \DateTime($results['estimated_pickup_date']) : null));
        $this->setEstimatedShipDate((!empty($results['estimated_ship_date']) ? new \DateTime($results['estimated_ship_date']) : null));
        $this->setDateShipped((!empty($results['date_shipped']) ? new \DateTime($results['date_shipped']) : null));
        $this->setDateDelivered((!empty($results['date_delivered']) ? new \DateTime($results['date_delivered']) : null));
        $this->setDatePickedUp((!empty($results['date_picked_up']) ? new \DateTime($results['date_picked_up']) : null));

        if( !empty($results['cart_item_ids']) && is_array($results['cart_item_ids']) ) {
            $this->setCartItemIDs($results['cart_item_ids']);
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
            'carrier_id'=>($this->getCarrier() ? $this->getCarrier()->getId() : null),
            'shipping_method_id'=>($this->getShippingMethod() ? $this->getShippingMethod()->getId() : null),

            'recipient_at_address'=>$this->getRecipientAtAddress(),
            'address'=>($this->getAddress() ? $this->getAddress()->getId() : null),

            'is_pickup'=>$this->isPickup(),
            'is_delivered'=>$this->isDelivered(),

            'in_hands_date'=>($this->getInHandsDate() ? $this->getInHandsDate()->format("Y-m-d") : null),
            'estimated_pickup_date'=>($this->getEstimatedPickupDate() ? $this->getEstimatedPickupDate()->format("Y-m-d") : null),
            'estimated_ship_date'=>($this->getEstimatedShipDate() ? $this->getEstimatedShipDate()->format("Y-m-d") : null),
            'date_shipped'=>($this->getDateShipped() ? $this->getDateShipped()->format("Y-m-d") : null),
            'date_delivered'=>($this->getDateDelivered() ? $this->getDateDelivered()->format("Y-m-d") : null),
            'date_picked_up'=>($this->getDatePickedUp() ? $this->getDatePickedUp()->format("Y-m-d") : null),
        ];
    }

    /**
     * Is being shipped to the customer, not picked up by them
     *
     * @return bool
     */
    public function isDelivery()
    {
        return !$this->isPickup();
    }

    /**
     * @return TrackingNumber[]
     */
    public function getTrackingNumbers(): array
    {
        return $this->trackingNumbers;
    }

    /**
     * @param TrackingNumber[] $trackingNumbers
     * @return OrderShipment
     */
    public function setTrackingNumbers(array $trackingNumbers): OrderShipment
    {
        $this->trackingNumbers = $trackingNumbers;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRecipientAtAddress(): ?string
    {
        return $this->recipientAtAddress;
    }

    /**
     * @param string|null $recipientAtAddress
     * @return OrderShipment
     */
    public function setRecipientAtAddress(?string $recipientAtAddress): OrderShipment
    {
        $this->recipientAtAddress = $recipientAtAddress;
        return $this;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     * @return OrderShipment
     */
    public function setAddress(Address $address): OrderShipment
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPickup(): bool
    {
        return $this->isPickup;
    }

    /**
     * @param bool $isPickup
     * @return OrderShipment
     */
    public function setIsPickup(bool $isPickup): OrderShipment
    {
        $this->isPickup = $isPickup;
        return $this;
    }

    /**
     * @return ShippingCarrier|null
     */
    public function getCarrier(): ?ShippingCarrier
    {
        return $this->carrier;
    }

    /**
     * @param ShippingCarrier|null $carrier
     * @return OrderShipment
     */
    public function setCarrier(?ShippingCarrier $carrier): OrderShipment
    {
        $this->carrier = $carrier;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHasShipped(): bool
    {
        return $this->hasShipped;
    }

    /**
     * @param bool $hasShipped
     * @return OrderShipment
     */
    public function setHasShipped(bool $hasShipped): OrderShipment
    {
        $this->hasShipped = $hasShipped;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDelivered(): bool
    {
        return $this->isDelivered;
    }

    /**
     * @param bool $isDelivered
     * @return OrderShipment
     */
    public function setIsDelivered(bool $isDelivered): OrderShipment
    {
        $this->isDelivered = $isDelivered;
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
     * @return OrderShipment
     */
    public function setInHandsDate(?\DateTime $inHandsDate): OrderShipment
    {
        $this->inHandsDate = $inHandsDate;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getEstimatedPickupDate(): ?\DateTime
    {
        return $this->estimatedPickupDate;
    }

    /**
     * @param \DateTime|null $estimatedPickupDate
     * @return OrderShipment
     */
    public function setEstimatedPickupDate(?\DateTime $estimatedPickupDate): OrderShipment
    {
        $this->estimatedPickupDate = $estimatedPickupDate;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getEstimatedShipDate(): ?\DateTime
    {
        return $this->estimatedShipDate;
    }

    /**
     * @param \DateTime|null $estimatedShipDate
     * @return OrderShipment
     */
    public function setEstimatedShipDate(?\DateTime $estimatedShipDate): OrderShipment
    {
        $this->estimatedShipDate = $estimatedShipDate;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateShipped(): ?\DateTime
    {
        return $this->dateShipped;
    }

    /**
     * @param \DateTime|null $dateShipped
     * @return OrderShipment
     */
    public function setDateShipped(?\DateTime $dateShipped): OrderShipment
    {
        $this->dateShipped = $dateShipped;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateDelivered(): ?\DateTime
    {
        return $this->dateDelivered;
    }

    /**
     * @param \DateTime|null $dateDelivered
     * @return OrderShipment
     */
    public function setDateDelivered(?\DateTime $dateDelivered): OrderShipment
    {
        $this->dateDelivered = $dateDelivered;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDatePickedUp(): ?\DateTime
    {
        return $this->datePickedUp;
    }

    /**
     * @param \DateTime|null $datePickedUp
     * @return OrderShipment
     */
    public function setDatePickedUp(?\DateTime $datePickedUp): OrderShipment
    {
        $this->datePickedUp = $datePickedUp;
        return $this;
    }

    /**
     * @return ShippingMethod|null
     */
    public function getShippingMethod(): ?ShippingMethod
    {
        return $this->shippingMethod;
    }

    /**
     * @param ShippingMethod|null $shippingMethod
     * @return OrderShipment
     */
    public function setShippingMethod(?ShippingMethod $shippingMethod): OrderShipment
    {
        $this->shippingMethod = $shippingMethod;
        return $this;
    }

    /**
     * @return array
     */
    public function getCartItemIDs(): array
    {
        return $this->cartItemIDs;
    }

    /**
     * @param array $cartItemIDs
     * @return OrderShipment
     */
    public function setCartItemIDs(array $cartItemIDs): OrderShipment
    {
        $this->cartItemIDs = $cartItemIDs;
        return $this;
    }
}