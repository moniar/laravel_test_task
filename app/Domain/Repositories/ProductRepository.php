<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Entities\Product;

/**
 * Class ProductRepository
 * @package App\Domain\Repositories
 */
interface ProductRepository
{
    /**
     * Loads product by specified id.
     * @param int $productId
     * @return Product
     */
    public function load(int $productId): Product;

    /**
     * Saves specified product.
     * @param Product $product
     * @return Product
     */
    public function save(Product $product): Product;
}
