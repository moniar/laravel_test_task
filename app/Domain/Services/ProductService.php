<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Entities\Product;
use App\Domain\Factories\ProductFactory;
use App\Domain\Repositories\ProductRepository;
use App\Domain\VOs\Currency;
use App\Domain\VOs\Product\ProductName;
use App\Domain\VOs\Product\ProductPrice;

/**
 * Class ProductService
 * @package App\Domain\Services
 */
class ProductService
{
    /**
     * Repository of products.
     * @var ProductRepository
     */
    private ProductRepository $productRepository;

    /**
     * ProductService constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Creates new product.
     * @param string $name
     * @param float $priceValue
     * @return Product
     */
    public function createProduct(string $name, float $priceValue): Product
    {
        $product = (new ProductFactory())->create(
            new ProductName($name),
            new ProductPrice(
                $priceValue,
                Currency::getDefaultCurrency()
            )
        );
        return $this->productRepository->save($product);
    }
}
