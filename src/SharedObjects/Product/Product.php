<?php
namespace CRM_SDK\SharedObjects\Product;

use CRM_SDK\SharedObjects\SharedObjectInterface;
use CRM_SDK\SharedObjects\Supplier\Supplier;
use CRM_SDK\SharedObjects\Traits\DateAddedTrait;
use CRM_SDK\SharedObjects\Traits\IDToArrayTrait;
use CRM_SDK\SharedObjects\Traits\IDTrait;
use CRM_SDK\SharedObjects\Traits\CreateTrait;

class Product implements SharedObjectInterface
{
    use CreateTrait;

    use IDTrait;
    use IDToArrayTrait;
    use DateAddedTrait;

    /** @var DataSource|null */
    private $dataSource;
    /** @var string|null */
    private $externalID;
    /** @var boolean */
    private $isCustom = false;
    /** @var string|null */
    private $publicSKU;
    /** @var string|null */
    private $SKU;
    /** @var Supplier|null */
    private $supplier;
    /** @var string|null */
    private $permalink;
    /** @var string|null */
    private $name;
    /** @var string|null */
    private $shortDescription;
    /** @var string|null */
    private $description;

    /** @var string|null */
    private $primaryImageURL;
    /** @var string|null */
    private $primaryVideoURL;
    /** @var ProductImage[] */
    private $images = [];

    /** @var Catalog|null */
    private $catalog;

    /** @var boolean */
    private $rushService = false;
    /** @var boolean */
    private $fullColorProcess = false;
    /** @var boolean */
    private $madeInAmerica = false;

    /** @var float|null */
    private $lowestPrice;
    /** @var float|null */
    private $highestPrice;

    /** @var boolean */
    private $onSale = false;
    /** @var float|null */
    private $salePrice;
    /** @var \DateTime|null */
    private $saleExpires;

    /** @var array|null */
    private $allData;

    /** @var string[]|null */
    private $colors;

    /** @var string[]|null */
    private $sizes;

    /** @var string[]|null */
    private $materials;

    /** @var string[]|null */
    private $themes;

    /** @var string[]|null */
    private $shapes;

    /** @var ProductCategory[]|null */
    private $categories;

    /** @var Product[]|null */
    private $relatedProducts;

    /**
     * @param array $results
     * @return Product
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);
        $this->setDataSource(DataSource::create()->populateFromAPIResults($results['data_source']));
        $this->setExternalID($results['external_id']);
        $this->setIsCustom($results['is_custom']);
        $this->setPublicSKU($results['public_sku']);
        $this->setSKU($results['sku']);
        $this->setSupplier(Supplier::create()->populateFromAPIResults($results['supplier']));
        $this->setPermalink($results['permalink']);
        $this->setName($results['name']);
        $this->setShortDescription($results['short_description']);
        $this->setDescription($results['description']);
        $this->setPrimaryImageURL($results['primary_image_url']);
        $this->setPrimaryVideoURL($results['primary_video_url']);

        if( $results['catalog'] ) {
            $this->setCatalog(Catalog::create()->populateFromAPIResults($results['catalog']));
        }

        $this->setRushService((bool) $results['has_rush_service']);
        $this->setFullColorProcess((bool) $results['has_full_color_process']);
        $this->setMadeInAmerica((bool) $results['is_made_in_america']);

        if( $results['lowest_price'] ) {
            $this->setLowestPrice((float)$results['lowest_price']);
        }
        if( $results['highest_price'] ) {
            $this->setHighestPrice((float)$results['highest_price']);
        }
        $this->setOnSale((bool) $results['is_on_sale']);
        if( $results['sale_price'] ) {
            $this->setSalePrice((float)$results['sale_price']);
        }
        if( $results['sale_expires'] ) {
            $this->setSaleExpires(new \DateTime($results['sale_expires']));
        }
        $this->setAllData(json_decode($results['all_data'], true));
        if( $results['date_added'] )
        {
            $this->setDateAdded(new \DateTime($results['date_added']));
        }
        $images = [];
        if( $results['images'] )
        {
            foreach($results['images'] as $img)
            {
                $images[] = ProductImage::create()->populateFromAPIResults($img);
            }
        }
        $this->setImages($images);

        if( !empty($results['related_products']) )
        {
            foreach($results['related_products'] as $related_by=>$products)
            {
                foreach($products as $prod_key=>$prod)
                {
                    $results['related_products'][$related_by][$prod_key] = Product::create()->populateFromAPIResults($prod);
                }
            }
            $this->setRelatedProducts($results['related_products']);
        }

        if( $results['categories'] )
        {
            $categories = [];
            foreach($results['categories'] as $cat)
            {
                $categories[] = ProductCategory::create()->populateFromAPIResults($cat);
            }
            $this->setCategories($categories);
        }

        if( $results['attributes'] )
        {
            $this->setColors(!empty($results['attributes']['colors']) ? $results['attributes']['colors'] : null);
            $this->setSizes(!empty($results['attributes']['sizes']) ? $results['attributes']['sizes'] : null);
            $this->setMaterials(!empty($results['attributes']['materials']) ? $results['attributes']['colors'] : null);
            $this->setThemes(!empty($results['attributes']['themes']) ? $results['attributes']['themes'] : null);
            $this->setShapes(!empty($results['attributes']['shapes']) ? $results['attributes']['shapes'] : null);
        }

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
     * @return Product
     */
    public function setDataSource(?DataSource $dataSource): Product
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
     * @return Product
     */
    public function setExternalID(?string $externalID): Product
    {
        $this->externalID = $externalID;
        return $this;
    }
    /**
     * @return bool
     */
    public function isCustom(): bool
    {
        return $this->isCustom;
    }
    /**
     * @param bool $isCustom
     * @return Product
     */
    public function setIsCustom(bool $isCustom): Product
    {
        $this->isCustom = $isCustom;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getPublicSKU(): ?string
    {
        return $this->publicSKU;
    }
    /**
     * @param string|null $publicSKU
     * @return Product
     */
    public function setPublicSKU(?string $publicSKU): Product
    {
        $this->publicSKU = $publicSKU;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getSKU(): ?string
    {
        return $this->SKU;
    }
    /**
     * @param string|null $SKU
     * @return Product
     */
    public function setSKU(?string $SKU): Product
    {
        $this->SKU = $SKU;
        return $this;
    }
    /**
     * @return Supplier|null
     */
    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }
    /**
     * @param Supplier|null $supplier
     * @return Product
     */
    public function setSupplier(?Supplier $supplier): Product
    {
        $this->supplier = $supplier;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getPermalink(): ?string
    {
        return $this->permalink;
    }
    /**
     * @param string|null $permalink
     * @return Product
     */
    public function setPermalink(?string $permalink): Product
    {
        $this->permalink = $permalink;
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
     * @return Product
     */
    public function setName(?string $name): Product
    {
        $this->name = $name;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }
    /**
     * @param string|null $shortDescription
     * @return Product
     */
    public function setShortDescription(?string $shortDescription): Product
    {
        $this->shortDescription = $shortDescription;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
    /**
     * @param string|null $description
     * @return Product
     */
    public function setDescription(?string $description): Product
    {
        $this->description = $description;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getPrimaryImageURL(): ?string
    {
        return $this->primaryImageURL;
    }
    /**
     * @param string|null $primaryImageURL
     * @return Product
     */
    public function setPrimaryImageURL(?string $primaryImageURL): Product
    {
        $this->primaryImageURL = $primaryImageURL;
        return $this;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param array $images
     * @return Product
     */
    public function setImages(array $images): Product
    {
        $this->images = $images;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getPrimaryVideoURL(): ?string
    {
        return $this->primaryVideoURL;
    }
    /**
     * @param string|null $primaryVideoURL
     * @return Product
     */
    public function setPrimaryVideoURL(?string $primaryVideoURL): Product
    {
        $this->primaryVideoURL = $primaryVideoURL;
        return $this;
    }
    /**
     * @return Catalog|null
     */
    public function getCatalog(): ?Catalog
    {
        return $this->catalog;
    }
    /**
     * @param Catalog|null $catalog
     * @return Product
     */
    public function setCatalog(?Catalog $catalog): Product
    {
        $this->catalog = $catalog;
        return $this;
    }
    /**
     * @return bool
     */
    public function isRushService(): bool
    {
        return $this->rushService;
    }
    /**
     * @param bool $rushService
     * @return Product
     */
    public function setRushService(bool $rushService): Product
    {
        $this->rushService = $rushService;
        return $this;
    }
    /**
     * @return bool
     */
    public function isFullColorProcess(): bool
    {
        return $this->fullColorProcess;
    }
    /**
     * @param bool $fullColorProcess
     * @return Product
     */
    public function setFullColorProcess(bool $fullColorProcess): Product
    {
        $this->fullColorProcess = $fullColorProcess;
        return $this;
    }
    /**
     * @return bool
     */
    public function isMadeInAmerica(): bool
    {
        return $this->madeInAmerica;
    }
    /**
     * @param bool $madeInAmerica
     * @return Product
     */
    public function setMadeInAmerica(bool $madeInAmerica): Product
    {
        $this->madeInAmerica = $madeInAmerica;
        return $this;
    }
    /**
     * @return float|null
     */
    public function getLowestPrice(): ?float
    {
        return $this->lowestPrice;
    }
    /**
     * @param float|null $lowestPrice
     * @return Product
     */
    public function setLowestPrice(?float $lowestPrice): Product
    {
        $this->lowestPrice = $lowestPrice;
        return $this;
    }
    /**
     * @return float|null
     */
    public function getHighestPrice(): ?float
    {
        return $this->highestPrice;
    }
    /**
     * @param float|null $highestPrice
     * @return Product
     */
    public function setHighestPrice(?float $highestPrice): Product
    {
        $this->highestPrice = $highestPrice;
        return $this;
    }
    /**
     * @return bool
     */
    public function isOnSale(): bool
    {
        return $this->onSale;
    }
    /**
     * @param bool $onSale
     * @return Product
     */
    public function setOnSale(bool $onSale): Product
    {
        $this->onSale = $onSale;
        return $this;
    }
    /**
     * @return float|null
     */
    public function getSalePrice(): ?float
    {
        return $this->salePrice;
    }
    /**
     * @param float|null $salePrice
     * @return Product
     */
    public function setSalePrice(?float $salePrice): Product
    {
        $this->salePrice = $salePrice;
        return $this;
    }
    /**
     * @return \DateTime|null
     */
    public function getSaleExpires(): ?\DateTime
    {
        return $this->saleExpires;
    }
    /**
     * @param \DateTime|null $saleExpires
     * @return Product
     */
    public function setSaleExpires(?\DateTime $saleExpires): Product
    {
        $this->saleExpires = $saleExpires;
        return $this;
    }
    /**
     * @return array|null
     */
    public function getAllData(): ?array
    {
        return $this->allData;
    }
    /**
     * @param array|null $allData
     * @return Product
     */
    public function setAllData(?array $allData): Product
    {
        $this->allData = $allData;
        return $this;
    }

    /**
     * @return Product[]|null
     */
    public function getRelatedProducts(): ?array
    {
        return $this->relatedProducts;
    }

    /**
     * @param Product[]|null $relatedProducts
     * @return Product
     */
    public function setRelatedProducts(?array $relatedProducts): Product
    {
        $this->relatedProducts = $relatedProducts;
        return $this;
    }

    /**
     * @return ProductCategory[]|null
     */
    public function getCategories(): ?array
    {
        return $this->categories;
    }

    /**
     * @param ProductCategory[]|null $categories
     * @return Product
     */
    public function setCategories(?array $categories): Product
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getColors(): ?array
    {
        return $this->colors;
    }

    /**
     * @param string[]|null $colors
     * @return Product
     */
    public function setColors(?array $colors): Product
    {
        $this->colors = $colors;
        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getSizes(): ?array
    {
        return $this->sizes;
    }

    /**
     * @param string[]|null $sizes
     * @return Product
     */
    public function setSizes(?array $sizes): Product
    {
        $this->sizes = $sizes;
        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getMaterials(): ?array
    {
        return $this->materials;
    }

    /**
     * @param string[]|null $materials
     * @return Product
     */
    public function setMaterials(?array $materials): Product
    {
        $this->materials = $materials;
        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getThemes(): ?array
    {
        return $this->themes;
    }

    /**
     * @param string[]|null $themes
     * @return Product
     */
    public function setThemes(?array $themes): Product
    {
        $this->themes = $themes;
        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getShapes(): ?array
    {
        return $this->shapes;
    }

    /**
     * @param string[]|null $shapes
     * @return Product
     */
    public function setShapes(?array $shapes): Product
    {
        $this->shapes = $shapes;
        return $this;
    }

    /**
     * @return array|Product
     */
    public function getRelatedByTheme()
    {
        return !empty($this->relatedProducts['by_theme']) ? $this->relatedProducts['by_theme'] : null;
    }

    /**
     * @return array|Product
     */
    public function getRelatedByPrice()
    {
        return !empty($this->relatedProducts['by_price']) ? $this->relatedProducts['by_price'] : null;
    }

    /**
     * @return array|Product
     */
    public function getRelatedByCategory()
    {
        return !empty($this->relatedProducts['by_category']) ? $this->relatedProducts['by_category'] : null;
    }
}