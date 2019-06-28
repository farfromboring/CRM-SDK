<?php
namespace CRM_SDK\ResponseObjects\Wishlist;

use CRM_SDK\ResponseObjects\Product\WishlistProduct;
use CRM_SDK\SharedObjects\Traits\CreateTrait;

class Wishlist
{
    use CreateTrait;

    /** @var int  */
    private $totalProducts = 0;

    /** @var WishlistProduct[] */
    private $products = [];

    /**
     * @param array $results
     * @return Wishlist
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setTotalProducts((int) $results['total_products']);

        if( !empty($results['products']) ) {
            $cart_items = [];
            foreach ($results['products'] as $product)
            {
                $cart_items[] = new WishlistProduct($product);
            }
            $this->setProducts($cart_items);
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getTotalProducts(): int
    {
        return $this->totalProducts;
    }

    /**
     * @param int $totalProducts
     * @return Wishlist
     */
    public function setTotalProducts(int $totalProducts): Wishlist
    {
        $this->totalProducts = $totalProducts;
        return $this;
    }

    /**
     * @return WishlistProduct[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param WishlistProduct[] $products
     * @return Wishlist
     */
    public function setProducts(array $products): Wishlist
    {
        $this->products = $products;
        return $this;
    }
}