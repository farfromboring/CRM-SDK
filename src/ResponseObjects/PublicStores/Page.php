<?php
namespace CRM_SDK\ResponseObjects\PublicStores;

use CRM_SDK\Traits\IDTrait;

class Page
{
    use IDTrait;

    /** @var string|null */
    private $url;
    /** @var string|null */
    private $name;
    /** @var PageType|null */
    private $pageType;
    /** @var Sidebar|null */
    private $leftSidebar;
    /** @var Sidebar|null */
    private $rightSidebar;
    /** @var string|null */
    private $metaTitle;
    /** @var string|null */
    private $metaDescription;
    /** @var boolean */
    private $AllowSEIndex = false;
    /** @var boolean */
    private $editable = false;
    /** @var string|null */
    private $editURL;
    /** @var string|null */
    private $content;

    /**
     * Page constructor.
     * @param array $results
     * @throws \Exception
     */
    public function __construct(array $results)
    {
        $this->setId((int) $results['id']);
        $this->setUrl($results['url']);
        $this->setName($results['name']);
        $this->setPageType(new PageType($results['page_type']));
        if( $results['left_sidebar'] ) {
            $this->setLeftSidebar(new Sidebar($results['left_sidebar']));
        }
        if( $results['right_sidebar'] ) {
            $this->setRightSidebar(new Sidebar($results['right_sidebar']));
        }
        $this->setMetaTitle($results['meta_title']);
        $this->setMetaDescription($results['meta_description']);
        $this->setAllowSEIndex($results['allow_se_index']);
        $this->setEditable($results['is_editable']);
        $this->setEditURL($results['edit_url']);

        if( isset($results['content']) )
        {
            $this->setContent($results['content']);
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     * @return Page
     */
    public function setUrl(?string $url): Page
    {
        $this->url = $url;
        return $this;
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
     * @return Page
     */
    public function setName(?string $name): Page
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return PageType|null
     */
    public function getPageType(): ?PageType
    {
        return $this->pageType;
    }

    /**
     * @param PageType|null $pageType
     * @return Page
     */
    public function setPageType(?PageType $pageType): Page
    {
        $this->pageType = $pageType;
        return $this;
    }

    /**
     * @return Sidebar|null
     */
    public function getLeftSidebar(): ?Sidebar
    {
        return $this->leftSidebar;
    }

    /**
     * @param Sidebar|null $leftSidebar
     * @return Page
     */
    public function setLeftSidebar(?Sidebar $leftSidebar): Page
    {
        $this->leftSidebar = $leftSidebar;
        return $this;
    }

    /**
     * @return Sidebar|null
     */
    public function getRightSidebar(): ?Sidebar
    {
        return $this->rightSidebar;
    }

    /**
     * @param Sidebar|null $rightSidebar
     * @return Page
     */
    public function setRightSidebar(?Sidebar $rightSidebar): Page
    {
        $this->rightSidebar = $rightSidebar;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    /**
     * @param string|null $metaTitle
     * @return Page
     */
    public function setMetaTitle(?string $metaTitle): Page
    {
        $this->metaTitle = $metaTitle;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    /**
     * @param string|null $metaDescription
     * @return Page
     */
    public function setMetaDescription(?string $metaDescription): Page
    {
        $this->metaDescription = $metaDescription;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAllowSEIndex(): bool
    {
        return $this->AllowSEIndex;
    }

    /**
     * @param bool $AllowSEIndex
     * @return Page
     */
    public function setAllowSEIndex(bool $AllowSEIndex): Page
    {
        $this->AllowSEIndex = $AllowSEIndex;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEditable(): bool
    {
        return $this->editable;
    }

    /**
     * @param bool $editable
     * @return Page
     */
    public function setEditable(bool $editable): Page
    {
        $this->editable = $editable;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEditURL(): ?string
    {
        return $this->editURL;
    }

    /**
     * @param string|null $editURL
     * @return Page
     */
    public function setEditURL(?string $editURL): Page
    {
        $this->editURL = $editURL;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     * @return Page
     */
    public function setContent(?string $content): Page
    {
        $this->content = $content;
        return $this;
    }
}