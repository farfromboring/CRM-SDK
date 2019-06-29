<?php
namespace CRM_SDK\SharedObjects\Shipping;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\IDTrait;

class TrackingNumber implements APIObjectInterface
{
    use APIObjectTrait;
    use IDTrait;

    /** @var string */
    private $trackingNumber;

    /** @var string|null */
    private $trackingURL;

    /** @var \DateTime */
    private $dateShipped;

    /** @var \DateTime|null */
    private $estimatedDeliveryDate;

    /** @var \DateTime|null */
    private $dateDelivered;

    /**
     * @param array $results
     * @return TrackingNumber
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);

        $this->setTrackingNumber($results['tracking_number']);
        $this->setTrackingURL($results['tracking_url']);

        $this->setDateShipped(new \DateTime($results['date_shipped']));
        $this->setEstimatedDeliveryDate(($results['est_delivery_date'] ? new \DateTime($results['est_delivery_date']) : null));
        $this->setDateDelivered(($results['date_delivered'] ? new \DateTime($results['date_delivered']) : null));

        return $this;
    }

    public function toArray(): array
    {
        return [
            'id'=>$this->getId(),
            'tracking_number'=>$this->getTrackingNumber(),
            'tracking_url'=>$this->getTrackingURL(),
            'date_shipped'=>($this->getDateShipped() ? $this->getDateShipped()->format("Y-m-d") : null),
            'est_delivery_date'=>($this->getEstimatedDeliveryDate() ? $this->getEstimatedDeliveryDate()->format("Y-m-d") : null),
            'date_delivered'=>($this->getDateDelivered() ? $this->getDateDelivered()->format("Y-m-d") : null),
        ];
    }

    /**
     * @return string
     */
    public function getTrackingNumber(): string
    {
        return $this->trackingNumber;
    }

    /**
     * @param string $trackingNumber
     * @return TrackingNumber
     */
    public function setTrackingNumber(string $trackingNumber): TrackingNumber
    {
        $this->trackingNumber = $trackingNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTrackingURL(): ?string
    {
        return $this->trackingURL;
    }

    /**
     * @param string|null $trackingURL
     * @return TrackingNumber
     */
    public function setTrackingURL(?string $trackingURL): TrackingNumber
    {
        $this->trackingURL = $trackingURL;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateShipped(): \DateTime
    {
        return $this->dateShipped;
    }

    /**
     * @param \DateTime $dateShipped
     * @return TrackingNumber
     */
    public function setDateShipped(\DateTime $dateShipped): TrackingNumber
    {
        $this->dateShipped = $dateShipped;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getEstimatedDeliveryDate(): ?\DateTime
    {
        return $this->estimatedDeliveryDate;
    }

    /**
     * @param \DateTime|null $estimatedDeliveryDate
     * @return TrackingNumber
     */
    public function setEstimatedDeliveryDate(?\DateTime $estimatedDeliveryDate): TrackingNumber
    {
        $this->estimatedDeliveryDate = $estimatedDeliveryDate;
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
     * @return TrackingNumber
     */
    public function setDateDelivered(?\DateTime $dateDelivered): TrackingNumber
    {
        $this->dateDelivered = $dateDelivered;
        return $this;
    }


}