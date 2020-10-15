<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Events\Product\ProductCreatedEvent;
use App\Exceptions\InvalidDataBagException;
use App\Exceptions\InvalidDataItemException;
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
        $product = $this->createProductEntity($name, $priceValue);
        $product = $this->productRepository->save($product);
        event(new ProductCreatedEvent($product));

        return $product;
    }

    /**
     * Creates product entity with specified data.
     * Throws exception if data is invalid.
     * @param string $name
     * @param float $priceValue
     * @return Product
     * @throws InvalidDataBagException
     */
    private function createProductEntity(string $name, float $priceValue): Product
    {
        $unprocessableException = new InvalidDataBagException();
        $productName = $this->createProductName($name, $unprocessableException);
        $productPrice = $this->createProductPrice($priceValue, $unprocessableException);
        $unprocessableException->throwIfNotEmpty();

        return (new ProductFactory())->create(
            $productName,
            $productPrice
        );
    }

    /**
     * Creates product name. Throws exception if invalid.
     * @param string $name
     * @param InvalidDataBagException $exception
     * @return ProductName|null
     */
    private function createProductName(string $name, InvalidDataBagException $exception): ?ProductName
    {
        try {
            return new ProductName($name);
        } catch (InvalidDataItemException $e) {
            $exception->addError($e->setErrorSource('name'));
            return null;
        }
    }

    /**
     * Creates product price. Throws exception if invalid.
     * @param float $price
     * @param InvalidDataBagException $exception
     * @return ProductPrice|null
     */
    private function createProductPrice(float $price, InvalidDataBagException $exception): ?ProductPrice
    {
        try {
            return new ProductPrice($price, Currency::getDefaultCurrency());
        } catch (InvalidDataItemException $e) {
            $exception->addError($e->setErrorSource('price'));
            return null;
        }
    }

}
