<?php
namespace CRM_SDK\SharedObjects\File;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Traits\IDToArrayTrait;

class FileBucket implements APIObjectInterface
{
    use APIObjectTrait;
    use IDToArrayTrait;
    use IDAndNameTrait;

    /** @var string */
    private $bucket;

    /**
     * @param array $results
     * @return FileBucket
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);
        $this->setName($results['name']);
        $this->setBucket($results['bucket']);

        return $this;
    }

    /**
     * @return string
     */
    public function getBucket(): string
    {
        return $this->bucket;
    }

    /**
     * @param string $bucket
     * @return FileBucket
     */
    public function setBucket(string $bucket): FileBucket
    {
        $this->bucket = $bucket;
        return $this;
    }
}