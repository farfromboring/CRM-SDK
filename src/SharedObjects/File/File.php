<?php
namespace CRM_SDK\SharedObjects\File;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\IDToArrayTrait;
use CRM_SDK\Traits\IDTrait;
use CRM_SDK\Traits\APIObjectTrait;

class File implements APIObjectInterface
{
    use APIObjectTrait;
    use IDToArrayTrait;
    use IDTrait;

    /** @var string */
    private $filename;

    /** @var int */
    private $size;

    /** @var FileType|null */
    private $type;

    /** @var FileMime|null */
    private $mime;

    /** @var FileBucket|null */
    private $bucket;

    /** @var string */
    private $url;
    /** @var string */
    private $thumbnailURL;
    /** @var string */
    private $LgThumbnailURL;

    /**
     * @param array $results
     * @return File
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);
        $this->setFilename($results['filename']);
        $this->setSize((int) $results['size']);
        $this->setType(FileType::create()->populateFromAPIResults($results['type']));
        $this->setMime(FileMime::create()->populateFromAPIResults($results['mime']));
        $this->setBucket(FileBucket::create()->populateFromAPIResults($results['bucket']));

        $this->setURL($results['url']);
        $this->setThumbnailURL($results['thumbnail_url']);
        $this->setLgThumbnailURL($results['lg_thumbnail_url']);

        return $this;
    }

    /**
     * @return bool
     */
    public function isImage()
    {
        return $this->getType()->getId() === FileType::IMAGE;
    }

    /**
     * @return bool
     */
    public function isPDF()
    {
        return $this->getType()->getId() === FileType::PDF;
    }

    /**
     * @return bool
     */
    public function isEmbroideryImage()
    {
        return $this->getType()->getId() === FileType::EMBROIDERY_IMPRINTING;
    }

    /**
     * @return bool
     */
    public function hasThumbnail()
    {
        return !empty($this->getThumbnailURL() ?: $this->getLgThumbnailURL());
    }

    /**
     * @return string|null
     */
    public function getSmallestAvailableThumbnailURL()
    {
        //return thumbnail, lg thumbnail, or (if websafe) original file
        return $this->getThumbnailURL() ?: ($this->getLgThumbnailURL() ?: ($this->getMime()->isWebSafe() ? $this->getUrl() : null));
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     * @return File
     */
    public function setFilename(string $filename): File
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     * @return File
     */
    public function setSize(int $size): File
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return FileType|null
     */
    public function getType(): ?FileType
    {
        return $this->type;
    }

    /**
     * @param FileType|null $type
     * @return File
     */
    public function setType(?FileType $type): File
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return FileMime|null
     */
    public function getMime(): ?FileMime
    {
        return $this->mime;
    }

    /**
     * @param FileMime|null $mime
     * @return File
     */
    public function setMime(?FileMime $mime): File
    {
        $this->mime = $mime;
        return $this;
    }

    /**
     * @return FileBucket|null
     */
    public function getBucket(): ?FileBucket
    {
        return $this->bucket;
    }

    /**
     * @param FileBucket|null $bucket
     * @return File
     */
    public function setBucket(?FileBucket $bucket): File
    {
        $this->bucket = $bucket;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return File
     */
    public function setUrl(string $url): File
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getThumbnailURL(): string
    {
        return $this->thumbnailURL;
    }

    /**
     * @param string $thumbnailURL
     * @return File
     */
    public function setThumbnailURL(string $thumbnailURL): File
    {
        $this->thumbnailURL = $thumbnailURL;
        return $this;
    }

    /**
     * @return string
     */
    public function getLgThumbnailURL(): string
    {
        return $this->LgThumbnailURL;
    }

    /**
     * @param string $LgThumbnailURL
     * @return File
     */
    public function setLgThumbnailURL(string $LgThumbnailURL): File
    {
        $this->LgThumbnailURL = $LgThumbnailURL;
        return $this;
    }
}