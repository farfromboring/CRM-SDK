<?php
namespace CRM_SDK\SharedObjects\Traits;

trait DateAddedTrait
{
    /** @var \DateTime|null */
    private $dateAdded;

    /**
     * @return \DateTime|null
     */
    public function getDateAdded(): ?\DateTime
    {
        return $this->dateAdded;
    }

    /**
     * @param \DateTime|null $dateAdded
     * @return self
     */
    public function setDateAdded(?\DateTime $dateAdded): self
    {
        $this->dateAdded = $dateAdded;
        return $this;
    }
}