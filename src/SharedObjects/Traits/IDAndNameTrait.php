<?php
namespace CRM_SDK\SharedObjects\Traits;

trait IDAndNameTrait
{
    use IDTrait;

    /** @var string|null */
    private $name;

    /**
     * @param array $results
     * @return IDAndNameTrait
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results): self
    {
        $this->setId((int) $results['id']);
        $this->setName($results['name']);

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'=>$this->getId(),
            'name'=>$this->getName()
        ];
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return self
     */
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }
}