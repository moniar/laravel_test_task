<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\VOs\Name;
use App\Domain\VOs\Price;
use App\Domain\VOs\Product\ProductId;
use App\Domain\VOs\Product\ProductName;
use App\Domain\VOs\Product\ProductPrice;

/**
 * Class Product
 * @package App\Domain\Entities
 */
class Product
{
    /**
     * Product id. Null for not existing objects.
     * @var ProductId|null
     */
    private ?ProductId $id;

    /**
     * Product name.
     * @var Name
     */
    private ProductName $name;

    /**
     * Product price.
     * @var Price
     */
    private ProductPrice $price;

    /**
     * Product constructor.
     * @param ProductName $name
     * @param ProductPrice $price
     * @param ProductId|null $id
     */
    public function __construct(ProductName $name, ProductPrice $price, ?ProductId $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * Gets product id.
     * @return ProductId|null
     */
    public function getId(): ?ProductId
    {
        return $this->id;
    }

    /**
     * Gets product name.
     * @return ProductName
     */
    public function getName(): ProductName
    {
        return $this->name;
    }

    /**
     * Get's product price.
     * @return ProductPrice
     */
    public function getPrice(): ProductPrice
    {
        return $this->price;
    }
}
