<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Entities\Product;
use App\Domain\VOs\Product\ProductId;
use App\Domain\VOs\Product\ProductName;

/**
 * Class ProductRepository
 * @package App\Domain\Repositories
 */
interface ProductRepository
{
    /**
     * Loads product by specified id.
     * @param ProductId $productId
     * @return Product
     */
    public function load(ProductId $productId): Product;

    /**
     * Finds product by specified name. Returns null if not found.
     * @param ProductName $productName
     * @return Product|null
     */
    public function findByProductName(ProductName  $productName): ?Product;

    /**
     * Saves specified product.
     * @param Product $product
     * @return Product
     */
    public function save(Product $product): Product;
}
