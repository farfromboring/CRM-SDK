<?php
namespace CRM_SDK\SharedObjects\Order;

use CRM_SDK\SharedObjects\Address\Address;
use CRM_SDK\SharedObjects\CreditCard\CreditCard;
use CRM_SDK\SharedObjects\Payment\PaymentStatus;
use CRM_SDK\SharedObjects\Payment\PaymentTerms;
use CRM_SDK\SharedObjects\SharedObjectInterface;
use CRM_SDK\SharedObjects\Traits\CreateTrait;
use CRM_SDK\SharedObjects\Traits\IDTrait;
use CRM_SDK\SharedObjects\User\User;

class OrderPayment implements SharedObjectInterface
{
    use CreateTrait;
    use IDTrait;

    /** @var PaymentMethod|null */
    private $method;

    /** @var PaymentStatus|null */
    private $status;

    /** @var PaymentTerms|null */
    private $terms;

    /** @var CreditCard|null */
    private $creditCard;

    /** @var Address|null */
    private $billingAddress;

    /** @var User|null */
    private $billingRecipient;

    /** @var float|null */
    private $creditCardFeePercent;

    /** @var float|null */
    private $creditCardFee;

    /** @var float|null */
    private $paymentAmountBeforeFee;

    /** @var float|null */
    private $paymentAmount;

    /** @var string|null */
    private $checkNumber;

    /** @var string|null */
    private $ccAuthCode;

    /** @var string|null */
    private $ccTransID;

    /** @var \DateTime|null */
    private $dateInvoiced;

    /** @var \DateTime|null */
    private $datePaid;

    /** @var \DateTime|null */
    private $dateRefunded;

    /**
     * @param array $results
     * @return OrderPayment
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);

        if( !empty($results['status']) && is_array($results['status']) ) {
            $this->setStatus(PaymentStatus::create()->populateFromAPIResults($results['status']));
        }

        if( !empty($results['method']) && is_array($results['method']) ) {
            $this->setMethod(PaymentMethod::create()->populateFromAPIResults($results['method']));
        }

        if( !empty($results['terms']) && is_array($results['terms']) ) {
            $this->setTerms(PaymentTerms::create()->populateFromAPIResults($results['terms']));
        }

        if( !empty($results['credit_card']) && is_array($results['credit_card']) ) {
            $this->setCreditCard(CreditCard::create()->populateFromAPIResults($results['credit_card']));
        }

        if( !empty($results['billing_address']) && is_array($results['billing_address']) ) {
            $this->setBillingAddress(Address::create()->populateFromAPIResults($results['billing_address']));
        }

        if( !empty($results['billing_recipient']) && is_array($results['billing_recipient']) ) {
            $this->setBillingRecipient(User::create()->populateFromAPIResults($results['billing_recipient']));
        }

        $this->setCreditCardFeePercent($results['credit_card_fee_percent']);
        $this->setCreditCardFee(($results['credit_card_fee'] ? (float) $results['credit_card_fee'] : null));
        $this->setPaymentAmountBeforeFee(($results['payment_amount_before_fee'] ? (float) $results['payment_amount_before_fee'] : null));
        $this->setPaymentAmount(($results['payment_amount'] ? (float) $results['payment_amount'] : null));

        $this->setCcAuthCode($results['check_number']);
        $this->setCcAuthCode($results['cc_auth_code']);
        $this->setCcTransID($results['cc_trans_id']);

        $this->setDateInvoiced((!empty($results['date_invoiced']) ? new \DateTime($results['date_invoiced']) : null));
        $this->setDatePaid((!empty($results['date_paid']) ? new \DateTime($results['date_paid']) : null));
        $this->setDateRefunded((!empty($results['date_refunded']) ? new \DateTime($results['date_refunded']) : null));

        return $this;
    }

    public function toArray(): array
    {
        return [
            'id'=>$this->getId(),

            'status_id'=>($this->getStatus() ? $this->getStatus()->getId() : null),
            'method_id'=>($this->getMethod() ? $this->getMethod()->getId() : null),
            'terms_id'=>($this->getTerms() ? $this->getTerms()->getId() : null),
            'credit_card_id'=>($this->getCreditCard() ? $this->getCreditCard()->getId() : null),

            'billing_address_id'=>($this->getBillingAddress() ? $this->getBillingAddress()->getId() : null),
            'billing_recipient'=>($this->getBillingRecipient() ? $this->getBillingRecipient()->getId() : null),

            'credit_card_fee_percent'=>$this->getCreditCardFeePercent(),
            'payment_amount'=>$this->getPaymentAmount(),

            'check_number'=>$this->getCheckNumber(),
            'cc_auth_code'=>$this->getCcAuthCode(),
            'cc_trans_id'=>$this->getCcTransID(),

            'date_invoiced'=>($this->getDateInvoiced() ? $this->getDateInvoiced()->format("Y-m-d") : null),
            'date_paid'=>($this->getDatePaid() ? $this->getDatePaid()->format("Y-m-d") : null),
            'date_refunded'=>($this->getDateRefunded() ? $this->getDateRefunded()->format("Y-m-d") : null),
        ];
    }

    /**
     * Useful if you want to show the auth code and transaction ID, if it's a credit card payment.
     *
     * @return bool
     */
    public function isByCreditCard()
    {
        return $this->getMethod()->getId() === PaymentMethod::CREDIT_CARD;
    }

    /**
     * Useful if you want to show the check number, f it's a check payment.
     *
     * @return bool
     */
    public function isByCheck()
    {
        return $this->getMethod()->getId() === PaymentMethod::CHECK;
    }

    /**
     * @return PaymentMethod|null
     */
    public function getMethod(): ?PaymentMethod
    {
        return $this->method;
    }

    /**
     * @param PaymentMethod|null $method
     * @return OrderPayment
     */
    public function setMethod(?PaymentMethod $method): OrderPayment
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return PaymentTerms|null
     */
    public function getTerms(): ?PaymentTerms
    {
        return $this->terms;
    }

    /**
     * @param PaymentTerms|null $terms
     * @return OrderPayment
     */
    public function setTerms(?PaymentTerms $terms): OrderPayment
    {
        $this->terms = $terms;
        return $this;
    }

    /**
     * @return PaymentStatus|null
     */
    public function getStatus(): ?PaymentStatus
    {
        return $this->status;
    }

    /**
     * @param PaymentStatus|null $status
     * @return OrderPayment
     */
    public function setStatus(?PaymentStatus $status): OrderPayment
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return CreditCard|null
     */
    public function getCreditCard(): ?CreditCard
    {
        return $this->creditCard;
    }

    /**
     * @param CreditCard|null $creditCard
     * @return OrderPayment
     */
    public function setCreditCard(?CreditCard $creditCard): OrderPayment
    {
        $this->creditCard = $creditCard;
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
     * @return OrderPayment
     */
    public function setBillingAddress(?Address $billingAddress): OrderPayment
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }

    /**
     * @return User|null
     */
    public function getBillingRecipient(): ?User
    {
        return $this->billingRecipient;
    }

    /**
     * @param User|null $billingRecipient
     * @return OrderPayment
     */
    public function setBillingRecipient(?User $billingRecipient): OrderPayment
    {
        $this->billingRecipient = $billingRecipient;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getCreditCardFeePercent(): ?float
    {
        return $this->creditCardFeePercent;
    }

    /**
     * @param float|null $creditCardFeePercent
     * @return OrderPayment
     */
    public function setCreditCardFeePercent(?float $creditCardFeePercent): OrderPayment
    {
        $this->creditCardFeePercent = $creditCardFeePercent;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getCreditCardFee(): ?float
    {
        return $this->creditCardFee;
    }

    /**
     * @param float|null $creditCardFee
     * @return OrderPayment
     */
    public function setCreditCardFee(?float $creditCardFee): OrderPayment
    {
        $this->creditCardFee = $creditCardFee;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPaymentAmountBeforeFee(): ?float
    {
        return $this->paymentAmountBeforeFee;
    }

    /**
     * @param float|null $paymentAmountBeforeFee
     * @return OrderPayment
     */
    public function setPaymentAmountBeforeFee(?float $paymentAmountBeforeFee): OrderPayment
    {
        $this->paymentAmountBeforeFee = $paymentAmountBeforeFee;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPaymentAmount(): ?float
    {
        return $this->paymentAmount;
    }

    /**
     * @param float|null $paymentAmount
     * @return OrderPayment
     */
    public function setPaymentAmount(?float $paymentAmount): OrderPayment
    {
        $this->paymentAmount = $paymentAmount;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCheckNumber(): ?string
    {
        return $this->checkNumber;
    }

    /**
     * @param string|null $checkNumber
     * @return OrderPayment
     */
    public function setCheckNumber(?string $checkNumber): OrderPayment
    {
        $this->checkNumber = $checkNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCcAuthCode(): ?string
    {
        return $this->ccAuthCode;
    }

    /**
     * @param string|null $ccAuthCode
     * @return OrderPayment
     */
    public function setCcAuthCode(?string $ccAuthCode): OrderPayment
    {
        $this->ccAuthCode = $ccAuthCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCcTransID(): ?string
    {
        return $this->ccTransID;
    }

    /**
     * @param string|null $ccTransID
     * @return OrderPayment
     */
    public function setCcTransID(?string $ccTransID): OrderPayment
    {
        $this->ccTransID = $ccTransID;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateInvoiced(): ?\DateTime
    {
        return $this->dateInvoiced;
    }

    /**
     * @param \DateTime|null $dateInvoiced
     * @return OrderPayment
     */
    public function setDateInvoiced(?\DateTime $dateInvoiced): OrderPayment
    {
        $this->dateInvoiced = $dateInvoiced;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDatePaid(): ?\DateTime
    {
        return $this->datePaid;
    }

    /**
     * @param \DateTime|null $datePaid
     * @return OrderPayment
     */
    public function setDatePaid(?\DateTime $datePaid): OrderPayment
    {
        $this->datePaid = $datePaid;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateRefunded(): ?\DateTime
    {
        return $this->dateRefunded;
    }

    /**
     * @param \DateTime|null $dateRefunded
     * @return OrderPayment
     */
    public function setDateRefunded(?\DateTime $dateRefunded): OrderPayment
    {
        $this->dateRefunded = $dateRefunded;
        return $this;
    }
}