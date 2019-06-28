<?php
namespace CRM_SDK\ResponseObjects\PublicStores;

use CRM_SDK\SharedObjects\Traits\CreateTrait;

class SiteIntegrations
{
    use CreateTrait;

    /** @var bool */
    private $isRecaptchaEnabled;
    /** @var string|null */
    private $recaptchaPublicKey;
    /** @var string|null */
    private $recaptchaPrivateKey;

    /**
     * @param array $results
     * @return SiteIntegrations
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setIsRecaptchaEnabled((bool) $results['is_recaptcha_enabled']);
        $this->setRecaptchaPublicKey($results['recaptcha_public_key']);
        $this->setRecaptchaPrivateKey($results['recaptcha_private_key']);

        return $this;
    }

    /**
     * @return bool
     */
    public function isRecaptchaEnabled(): bool
    {
        return $this->isRecaptchaEnabled;
    }

    /**
     * @param bool $isRecaptchaEnabled
     * @return SiteIntegrations
     */
    public function setIsRecaptchaEnabled(bool $isRecaptchaEnabled): SiteIntegrations
    {
        $this->isRecaptchaEnabled = $isRecaptchaEnabled;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRecaptchaPublicKey(): ?string
    {
        return $this->recaptchaPublicKey;
    }

    /**
     * @param string|null $recaptchaPublicKey
     * @return SiteIntegrations
     */
    public function setRecaptchaPublicKey(?string $recaptchaPublicKey): SiteIntegrations
    {
        $this->recaptchaPublicKey = $recaptchaPublicKey;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRecaptchaPrivateKey(): ?string
    {
        return $this->recaptchaPrivateKey;
    }

    /**
     * @param string|null $recaptchaPrivateKey
     * @return SiteIntegrations
     */
    public function setRecaptchaPrivateKey(?string $recaptchaPrivateKey): SiteIntegrations
    {
        $this->recaptchaPrivateKey = $recaptchaPrivateKey;
        return $this;
    }
}