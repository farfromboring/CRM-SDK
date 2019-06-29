<?php
namespace CRM_SDK\SharedObjects\CreditCard;

use CRM_SDK\SharedObjects\Address\Address;
use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\IDTrait;

class CreditCard implements APIObjectInterface
{
    use APIObjectTrait;
    use IDTrait;

    /** @var CreditCardType|null */
    private $type;

    /** @var CreditCardStatus|null */
    private $status;

    /** @var string|null */
    private $nickname;

    /** @var string|null */
    private $nameOnCard;

    /** @var \DateTime|null */
    private $expDate;

    /** @var string|null */
    private $lastFour;

    /** @var Address|null */
    private $billingAddress;

    /**
     * @param array $results
     * @return CreditCard
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);

        if( !empty($results['type']) ) {
            $this->setType(CreditCardType::create()->populateFromAPIResults($results['type']));
        }
        if( !empty($results['status']) ) {
            $this->setStatus(CreditCardStatus::create()->populateFromAPIResults($results['status']));
        }
        if( !empty($results['nickname']) ) {
            $this->setNickname($results['nickname']);
        }
        if( !empty($results['name_on_card']) ) {
            $this->setNameOnCard($results['name_on_card']);
        }
        if( !empty($results['exp_date']) ) {
            $this->setExpDate(new \DateTime($results['exp_date']));
        }
        if( !empty($results['last_four']) ) {
            $this->setLastFour($results['last_four']);
        }
        if( !empty($results['billing_address']) ) {
            $this->setBillingAddress(Address::create()->populateFromAPIResults($results['billing_address']));
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
            'status'=>($this->getStatus() ? $this->getStatus()->toArray() : null),
            'nickname'=>$this->getNickname(),
            'name_on_card'=>$this->getNameOnCard(),
            'exp_date'=>($this->getExpDate() ? $this->getExpDate()->format("Y-m-d") : null),
            'billing_address'=>($this->getBillingAddress() ? $this->getBillingAddress()->toArray() : null),

        ];
    }

    /**
     * @return CreditCardType|null
     */
    public function getType(): ?CreditCardType
    {
        return $this->type;
    }

    /**
     * @param CreditCardType|null $type
     * @return CreditCard
     */
    public function setType(?CreditCardType $type): CreditCard
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return CreditCardStatus|null
     */
    public function getStatus(): ?CreditCardStatus
    {
        return $this->status;
    }

    /**
     * @param CreditCardStatus|null $status
     * @return CreditCard
     */
    public function setStatus(?CreditCardStatus $status): CreditCard
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return Address|null
     */
    public function getBillingAddress(): ?Address
    {
        return $this->billingAddress;
    }

    /**
     * @param Address|null $billingAddress
     * @return CreditCard
     */
    public function setBillingAddress(?Address $billingAddress): CreditCard
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * @param string|null $nickname
     * @return CreditCard
     */
    public function setNickname(?string $nickname): CreditCard
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNameOnCard(): ?string
    {
        return $this->nameOnCard;
    }

    /**
     * @param string|null $nameOnCard
     * @return CreditCard
     */
    public function setNameOnCard(?string $nameOnCard): CreditCard
    {
        $this->nameOnCard = $nameOnCard;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getExpDate(): ?\DateTime
    {
        return $this->expDate;
    }

    /**
     * @param \DateTime|null $expDate
     * @return CreditCard
     */
    public function setExpDate(?\DateTime $expDate): CreditCard
    {
        $this->expDate = $expDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastFour(): ?string
    {
        return $this->lastFour;
    }

    /**
     * @param string|null $lastFour
     * @return CreditCard
     */
    public function setLastFour(?string $lastFour): CreditCard
    {
        $this->lastFour = $lastFour;
        return $this;
    }
}