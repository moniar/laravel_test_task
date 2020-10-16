<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Repositories\ProductRepository;
use App\Domain\Services\ProductService;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Tools\RequestDescription\RequestValidator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * @return Response
     */
    public function store(Request $request, ProductRepository $productRepository): Response
    {
        (new RequestValidator($request, new CreateProductRequest()))->validate();

        $service = new ProductService($productRepository);
        $product = $service->createProduct($request->get('name'), (float)$request->get('price'));

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
