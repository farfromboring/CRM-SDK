<?php
namespace CRM_SDK\SharedObjects\Form;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\CreateTrait;
use CRM_SDK\Traits\IDAndNameTrait;

class FormSubmissionStatus implements APIObjectInterface
{
    use CreateTrait;

    const RECEIVED = 1;
    const RESPONDED = 2;
    const RECEIVED_FOLLOW_UP = 3;
    const DUPLICATE = 4;
    const SPAM = 5;
    const TEST = 6;
    const COMPLETED = 7;

    use IDAndNameTrait;

    /** @var boolean */
    private $requiresRepAttention;
    /** @var boolean */
    private $requiresUserAttention;
    /** @var boolean */
    private $isComplete;

    /**
     * @param array $results
     * @return FormSubmissionStatus
     */
    public function populateFromAPIResults(array $results): self
    {
        $this->setId((int) $results['id']);
        $this->setName($results['name']);
        $this->setRequiresRepAttention((bool) $results['requires_rep_attention']);
        $this->setRequiresUserAttention((bool) $results['requires_user_attention']);
        $this->setIsComplete((bool) $results['is_complete']);

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
            'requires_rep_attention'=>$this->isRequiresRepAttention(),
            'requires_user_attention'=>$this->isRequiresUserAttention(),
            'is_complete'=>$this->isComplete()
        ];
    }

    /**
     * @return bool
     */
    public function isRequiresRepAttention(): bool
    {
        return $this->requiresRepAttention;
    }

    /**
     * @param bool $requiresRepAttention
     * @return FormSubmissionStatus
     */
    public function setRequiresRepAttention(bool $requiresRepAttention): FormSubmissionStatus
    {
        $this->requiresRepAttention = $requiresRepAttention;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRequiresUserAttention(): bool
    {
        return $this->requiresUserAttention;
    }

    /**
     * @param bool $requiresUserAttention
     * @return FormSubmissionStatus
     */
    public function setRequiresUserAttention(bool $requiresUserAttention): FormSubmissionStatus
    {
        $this->requiresUserAttention = $requiresUserAttention;
        return $this;
    }

    /**
     * @return bool
     */
    public function isComplete(): bool
    {
        return $this->isComplete;
    }

    /**
     * @param bool $isComplete
     * @return FormSubmissionStatus
     */
    public function setIsComplete(bool $isComplete): FormSubmissionStatus
    {
        $this->isComplete = $isComplete;
        return $this;
    }
}