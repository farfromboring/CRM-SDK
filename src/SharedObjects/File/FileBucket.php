<?php
namespace CRM_SDK\SharedObjects\File;

use CRM_SDK\SharedObjects\SharedObjectInterface;
use CRM_SDK\SharedObjects\Traits\CreateTrait;
use CRM_SDK\SharedObjects\Traits\IDAndNameTrait;
use CRM_SDK\SharedObjects\Traits\IDToArrayTrait;

class FileBucket implements SharedObjectInterface
{
    use CreateTrait;
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