<?php
namespace CRM_SDK\Traits;

trait IDTrait
{
    /** @var int|null */
    private $id;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return mixed
     */
    public function setId(?int $id)
    {
        $this->id = $id;
        return $this;
    }
}