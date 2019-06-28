<?php
namespace CRM_SDK\SharedObjects\Order;

use CRM_SDK\SharedObjects\Cart\Cart;
use CRM_SDK\SharedObjects\SharedObjectInterface;

class Order extends Cart implements SharedObjectInterface
{
    /** @var OrderStatus */
    private $status;

    /** @var bool */
    private $isSampleOrder;

    /** @var OrderShipment[] */
    private $shipments;

    /** @var OrderPayment[] */
    private $payments;

    /** @var int|null */
    private $reOrderOf;

    /** @var bool */
    private $requiresPayment;

    /** @var \DateTime|null */
    private $orderDate;

    /**
     * @param array $results
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        if( !empty($results['shipments']) )
        {
            foreach($results['shipments'] as $shipment)
            {
                $this->shipments[] = OrderShipment::create()->populateFromAPIResults($shipment);
            }
        }

        if( !empty($results['payments']) )
        {
            foreach($results['payments'] as $payment)
            {
                $this->payments[] = OrderPayment::create()->populateFromAPIResults($payment);
            }
        }

        $this->setStatus(OrderStatus::create()->populateFromAPIResults($results['status']));
        $this->setReOrderOf(($results['reorder_of'] ? (int) $results['reorder_of'] : null));
        $this->setOrderDate(($results['order_date'] ? new \DateTime($results['order_date']) : null));
        $this->setRequiresPayment((bool) $results['requires_payment']);
        $this->setIsSampleOrder((bool) $results['is_sample_order']);

        parent::populateFromAPIResults($results);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'status_id'=>($this->getStatus() ? $this->getStatus()->getId() : null),
            'order_date'=>($this->getOrderDate() ? $this->getOrderDate()->format("Y-m-d H:i:s") : null),
            'requires_payment'=>$this->isRequiresPayment(),
            'is_sample_order'=>$this->isSampleOrder(),
        ]);
    }

    /**
     * If this order is 100% delivered, paid for, etc.
     *
     * @return bool
     */
    public function isCompleted()
    {
        return $this->getStatus()->getId() === OrderStatus::COMPLETED;
    }

    /**
     * @return OrderStatus
     */
    public function getStatus(): OrderStatus
    {
        return $this->status;
    }

    /**
     * @param OrderStatus $status
     * @return Order
     */
    public function setStatus(OrderStatus $status): Order
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return OrderShipment[]
     */
    public function getShipments(): array
    {
        return $this->shipments;
    }

    /**
     * @param OrderShipment[] $shipments
     * @return Order
     */
    public function setShipments(array $shipments): Order
    {
        $this->shipments = $shipments;
        return $this;
    }

    /**
     * @return OrderPayment[]
     */
    public function getPayments(): array
    {
        return $this->payments;
    }

    /**
     * @param OrderPayment[] $payments
     * @return Order
     */
    public function setPayments(array $payments): Order
    {
        $this->payments = $payments;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getReOrderOf(): ?int
    {
        return $this->reOrderOf;
    }

    /**
     * @param int|null $reOrderOf
     * @return Order
     */
    public function setReOrderOf(?int $reOrderOf): Order
    {
        $this->reOrderOf = $reOrderOf;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getOrderDate(): ?\DateTime
    {
        return $this->orderDate;
    }

    /**
     * @param \DateTime|null $orderDate
     * @return Order
     */
    public function setOrderDate(?\DateTime $orderDate): Order
    {
        $this->orderDate = $orderDate;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRequiresPayment(): bool
    {
        return $this->requiresPayment;
    }

    /**
     * @param bool $requiresPayment
     * @return Order
     */
    public function setRequiresPayment(bool $requiresPayment): Order
    {
        $this->requiresPayment = $requiresPayment;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSampleOrder(): bool
    {
        return $this->isSampleOrder;
    }

    /**
     * @param bool $isSampleOrder
     * @return Order
     */
    public function setIsSampleOrder(bool $isSampleOrder): Order
    {
        $this->isSampleOrder = $isSampleOrder;
        return $this;
    }
}