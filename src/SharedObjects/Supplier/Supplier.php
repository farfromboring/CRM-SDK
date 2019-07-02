<?php
namespace CRM_SDK\SharedObjects\Supplier;

use CRM_SDK\SharedObjects\Product\DataSource;
use CRM_SDK\Traits\DateAddedTrait;
use CRM_SDK\Traits\IDTrait;
use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;

class Supplier implements APIObjectInterface
{
    use APIObjectTrait;
    use IDTrait;
    use DateAddedTrait;

    /** @var string|null */
    private $name;
    /** @var DataSource|null */
    private $dataSource;
    /** @var string|null */
    private $externalID;
    /** @var string|null */
    private $phone;
    /** @var string|null */
    private $email;
    /** @var string|null */
    private $website;

    /**
     * @param array $results
     * @return Supplier
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);
        $this->setName($results['name']);
        $this->setDataSource(DataSource::create()->populateFromAPIResults($results['data_source']));
        $this->setExternalID($results['external_id']);
        $this->setPhone($results['phone']);
        $this->setEmail($results['email']);
        $this->setWebsite($results['website']);
        if( $results['date_added'] ) {
            $this->setDateAdded(new \DateTime($results['date_added']));
        }

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'=>$this->getId()
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
     * @return Supplier
     */
    public function setName(?string $name): Supplier
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateAdded(): ?\DateTime
    {
        return $this->dateAdded;
    }

    /**
     * @param \DateTime|null $dateAdded
     * @return Supplier
     */
    public function setDateAdded(?\DateTime $dateAdded): Supplier
    {
        $this->dateAdded = $dateAdded;
        return $this;
    }

    /**
     * @return DataSource|null
     */
    public function getDataSource(): ?DataSource
    {
        return $this->dataSource;
    }

    /**
     * @param DataSource|null $dataSource
     * @return Supplier
     */
    public function setDataSource(?DataSource $dataSource): Supplier
    {
        $this->dataSource = $dataSource;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getExternalID(): ?string
    {
        return $this->externalID;
    }

    /**
     * @param string|null $externalID
     * @return Supplier
     */
    public function setExternalID(?string $externalID): Supplier
    {
        $this->externalID = $externalID;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return Supplier
     */
    public function setPhone(?string $phone): Supplier
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Supplier
     */
    public function setEmail(?string $email): Supplier
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * @param string|null $website
     * @return Supplier
     */
    public function setWebsite(?string $website): Supplier
    {
        $this->website = $website;
        return $this;
    }
}