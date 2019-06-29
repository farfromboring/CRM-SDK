<?php
namespace CRM_SDK\Traits;

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
     * @return mixed
     */
    public function setDateAdded(?\DateTime $dateAdded)
    {
        $this->dateAdded = $dateAdded;
        return $this;
    }
}