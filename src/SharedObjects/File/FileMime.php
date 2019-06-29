<?php
namespace CRM_SDK\SharedObjects\File;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Traits\IDToArrayTrait;

class FileMime implements APIObjectInterface
{
    use APIObjectTrait;
    use IDToArrayTrait;
    use IDAndNameTrait;

    /** @var bool */
    private $isWebSafe;

    /** @var string */
    private $mime;

    /**
     * @param array $results
     * @return FileMime
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);
        $this->setName($results['name']);
        $this->setIsWebSafe((bool) $results['is_web_safe']);
        $this->setMime($results['mime']);

        return $this;
    }

    /**
     * @return bool
     */
    public function isWebSafe(): bool
    {
        return $this->isWebSafe;
    }

    /**
     * @param bool $isWebSafe
     * @return FileType
     */
    public function setIsWebSafe(bool $isWebSafe): FileMime
    {
        $this->isWebSafe = $isWebSafe;
        return $this;
    }

    /**
     * @return string
     */
    public function getMime(): string
    {
        return $this->mime;
    }

    /**
     * @param string $mime
     * @return FileType
     */
    public function setMime(string $mime): FileMime
    {
        $this->mime = $mime;
        return $this;
    }
}