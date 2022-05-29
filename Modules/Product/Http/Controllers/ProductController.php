<?php

namespace Modules\Product\Http\Controllers;

use Modules\Product\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Http\Requests\ProductStoreRequest;
use Modules\Product\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository) 
    {
        $this->productRepository = $productRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->productRepository->getAllProducts()
        ]);
    }

    public function store(ProductStoreRequest $request): JsonResponse 
    {
        $product = $request->all();

        return response()->json(
            [
                'data' => $this->productRepository->createProduct($product)
            ],
            Response::HTTP_CREATED
        );
    }

    public function show(Request $request): JsonResponse 
    {
        $id = $request->route('id');

        return response()->json([
            'data' => $this->productRepository->getProductById($id)
        ]);
    }

    public function update(ProductUpdateRequest $request): JsonResponse 
    {
        $id = $request->route('id');
        $product = $request->all();

        return response()->json([
            'data' => $this->productRepository->updateProduct($id, $product)
        ]);
    }

    public function destroy(Request $request): JsonResponse 
    {
        $id = $request->route('id');
        $this->productRepository->deleteProduct($id);

        return response()->json(null, Response::HTTP_OK);
    }
}
