<?php
namespace CRM_SDK\SharedObjects\Form;

use CRM_SDK\SharedObjects\SharedObjectInterface;
use CRM_SDK\SharedObjects\Traits\CreateTrait;
use CRM_SDK\SharedObjects\Traits\IDTrait;

class FormSubmission implements SharedObjectInterface
{
    use CreateTrait;

    use IDTrait;

    /** @var Form */
    private $form;

    /** @var FormSubmissionStatus */
    private $status;

    /** @var string|null */
    private $preview;

    /** @var array */
    private $values = [];

    /** @var \DateTime|null */
    private $dateSubmitted;

    /** @var integer|null */
    private $productID;

    /** @var string */
    private $userID;

    /**
     * @param array $results
     * @return FormSubmission
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);
        $this->setForm((new Form())->populateFromAPIResults($results['form']));
        $this->setStatus((new FormSubmissionStatus())->populateFromAPIResults($results['status']));
        $this->setPreview($results['preview']);
        $this->setValues($results['values']);
        $this->setProductID($results['product_id']);
        $this->setDateSubmitted(new \DateTime($results['date_submitted']));

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'=>$this->getId(),
            'form_key'=>($this->getForm() ? $this->getForm()->getFormKey() : null),
            'status_id'=>($this->getStatus() ? $this->getStatus()->getId() : null),
            'preview'=>$this->getPreview(),
            'values'=>$this->getValues(),
            'product_id'=>$this->getProductID(),
            'date_submitted'=>($this->getDateSubmitted() ? $this->getDateSubmitted()->format("Y-m-d H:i:s") : null),
            'user_id'=>$this->getUserID(),
        ];
    }

    /**
     * @return Form
     */
    public function getForm(): Form
    {
        return $this->form;
    }

    /**
     * @param Form $form
     * @return FormSubmission
     */
    public function setForm(Form $form): FormSubmission
    {
        $this->form = $form;
        return $this;
    }

    /**
     * @return FormSubmissionStatus
     */
    public function getStatus(): FormSubmissionStatus
    {
        return $this->status;
    }

    /**
     * @param FormSubmissionStatus $status
     * @return FormSubmission
     */
    public function setStatus(FormSubmissionStatus $status): FormSubmission
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPreview(): ?string
    {
        return $this->preview;
    }

    /**
     * @param string|null $preview
     * @return FormSubmission
     */
    public function setPreview(?string $preview): FormSubmission
    {
        $this->preview = $preview;
        return $this;
    }

    /**
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @param array $values
     * @return FormSubmission
     */
    public function setValues(array $values): FormSubmission
    {
        $this->values = $values;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateSubmitted(): ?\DateTime
    {
        return $this->dateSubmitted;
    }

    /**
     * @param \DateTime|null $dateSubmitted
     * @return FormSubmission
     */
    public function setDateSubmitted(?\DateTime $dateSubmitted): FormSubmission
    {
        $this->dateSubmitted = $dateSubmitted;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserID(): string
    {
        return $this->userID;
    }

    /**
     * @param string $userID
     * @return FormSubmission
     */
    public function setUserID(string $userID): FormSubmission
    {
        $this->userID = $userID;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getProductID(): ?int
    {
        return $this->productID;
    }

    /**
     * @param int|null $productID
     * @return FormSubmission
     */
    public function setProductID(?int $productID): FormSubmission
    {
        $this->productID = $productID;
        return $this;
    }
}