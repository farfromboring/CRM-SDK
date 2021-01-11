<?php
namespace CRM_SDK\SharedObjects\Wishlist;

use CRM_SDK\SharedObjects\Product\Product;
use CRM_SDK\Traits\APIObjectTrait;

class WishlistProduct extends Product
{
    use APIObjectTrait;

    /** @var int */
    private $wishlistProductID;
    /** @var \DateTime|null */
    private $dateAddedToWishlist;

    /**
     * @param array $results
     * @return WishlistProduct
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setWishlistProductID((int) $results['wishlist_product_id']);
        $this->setDateAddedToWishlist((!empty($results['date_added_to_wishlist']) ? new \DateTime($results['date_added_to_wishlist']) : null));

        parent::populateFromAPIResults($results);

        return $this;
    }

    /**
     * @return int
     */
    public function getWishlistProductID(): int
    {
        return $this->wishlistProductID;
    }

    /**
     * @param int $wishlistProductID
     * @return WishlistProduct
     */
    public function setWishlistProductID(int $wishlistProductID): WishlistProduct
    {
        $this->wishlistProductID = $wishlistProductID;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateAddedToWishlist(): ?\DateTime
    {
        return $this->dateAddedToWishlist;
    }

    /**
     * @param \DateTime|null $dateAddedToWishlist
     * @return WishlistProduct
     */
    public function setDateAddedToWishlist(?\DateTime $dateAddedToWishlist): WishlistProduct
    {
        $this->dateAddedToWishlist = $dateAddedToWishlist;
        return $this;
    }
}