<?php
namespace CRM_SDK\ResponseObjects\Product;

class WishlistProduct extends Product
{
    /** @var int */
    private $wishlistProductID;
    /** @var \DateTime|null */
    private $dateAddedToWishlist;

    /**
     * User constructor.
     * @param array $results
     * @throws \Exception
     */
    public function __construct(array $results)
    {
        $this->setWishlistProductID((int) $results['wishlist_product_id']);
        $this->setDateAdded((!empty($results['date_added_to_wishlist']) ? new \DateTime($results['date_added_to_wishlist']) : null));

        parent::__construct($results);

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