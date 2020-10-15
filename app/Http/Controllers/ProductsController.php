<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Repositories\ProductRepository;
use App\Domain\Services\ProductService;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

/**
 * Class ProductsController
 * @package App\Http\Controllers
 */
class ProductsController extends Controller
{
    /**
     * Handling request for creating a new product.
     * @param Request $request
     * @param ProductRepository $productRepository
     * @return ProductResource
     */
    public function store(Request $request, ProductRepository $productRepository): ProductResource
    {
        $service = new ProductService($productRepository);
        $product = $service->createProduct($request->get('name'), $request->get('price'));
        return new ProductResource($product);
    }
}
