<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Domain\Entities\Product;
use App\Domain\VOs\Currency;
use App\Domain\VOs\Product\ProductId;
use App\Domain\VOs\Product\ProductName;
use App\Domain\VOs\Product\ProductPrice;
use App\Models\Product as ProductModel;

/**
 * Class ProductRepository
 * @package App\Repositories
 */
class ProductRepository implements \App\Domain\Repositories\ProductRepository
{
    /**
     * Loads product by specified id.
     * @param ProductId $productId
     * @return Product
     */
    public function load(ProductId $productId): Product
    {
        $model = ProductModel::findOrFail($productId);
        return $this->getProductFromModel($model);
    }

    /**
     * Finds product by specified name. Returns null if not found.
     * @param ProductName $productName
     * @return Product|null
     */
    public function findByProductName(ProductName $productName): ?Product
    {
        $model = ProductModel::where('name', '=', (string)$productName)->firstOrFail();
        return $this->getProductFromModel($model);
    }

    /**
     * Saves specified product.
     * @param Product $product
     * @return Product
     */
    public function save(Product $product): Product
    {
        $new = null === $product->getId();
        if ($new) {
            $model = new ProductModel();
        } else {
            $model = ProductModel::find($product->getId());
        }

        $model->name = (string)$product->getName();
        $model->price = $product->getPrice()->getValue();
        $model->currency = $product->getPrice()->getCurrency();
        $model->save();

        return $this->getProductFromModel($model);
    }

    /**
     * Gets domain product object from model product object.
     * @param ProductModel $model
     * @return Product
     * @throws \App\Exceptions\InvalidDataItemException
     */
    private function getProductFromModel(ProductModel $model): Product
    {
        return new Product(
            new ProductName($model->name),
            new ProductPrice($model->price, new Currency($model->currency)),
            new ProductId($model->id)
        );
    }
}
