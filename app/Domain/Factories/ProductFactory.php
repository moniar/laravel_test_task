<?php

declare(strict_types=1);

namespace App\Domain\Factories;

use App\Domain\Entities\Product;
use App\Domain\VOs\Product\ProductName;
use App\Domain\VOs\Product\ProductPrice;

/**
 * Class ProductFactory
 * @package App\Domain\Factories
 */
class ProductFactory
{
    /**
     * Creates new product for specified data.
     * @param ProductName $name
     * @param ProductPrice $price
     * @return Product
     */
    public function create(ProductName $name, ProductPrice $price): Product
    {
        return new Product($name, $price);
    }
}
