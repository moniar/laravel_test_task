<?php

declare(strict_types=1);

namespace App\Events\Product;

use App\Domain\Entities\Product;

/**
 * Class ProductCreatedEvent
 * @package App\Events\Product
 */
class ProductCreatedEvent
{
    /**
     * Product that was created.
     * @var Product
     */
    private Product $product;

    /**
     * ProductCreatedEvent constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Gets product that was created.
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }
}
