<?php
namespace CRM_SDK\SharedObjects\Wishlist;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;

class Wishlist implements APIObjectInterface
{
    use APIObjectTrait;

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
                $cart_items[] = WishlistProduct::create()->populateFromAPIResults($product);
            }
            $this->setProducts($cart_items);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [

        ];
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