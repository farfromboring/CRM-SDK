<?php
namespace CRM_SDK\SharedObjects\File;

use CRM_SDK\SharedObjects\SharedObjectInterface;
use CRM_SDK\SharedObjects\Traits\CreateTrait;
use CRM_SDK\SharedObjects\Traits\IDAndNameTrait;
use CRM_SDK\SharedObjects\Traits\IDToArrayTrait;

class FileMime implements SharedObjectInterface
{
    use CreateTrait;
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