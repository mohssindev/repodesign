<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

class ListProductsController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    public function __invoke(Request $request)
    {
        $perPage = (int)$request->get('count', 20);
        $page = (int)$request->get('page', 1);

        $productsPaginated = $this->productService->getPaginated($page, $perPage);

        $products = $productsPaginated->getCollection();

        $products = $this->arrayResponse($products);

        $productsPaginated->setCollection($products);

        return response()->json($productsPaginated);
    }

    private function arrayResponse(Collection $products): Collection
    {
        return $products->map(function (Product $product) {
            return [
                'id'          => $product->getId(),
                'name'        => $product->getName(),
                'description' => $product->getDescription(),
                'price'       => $product->getPrice(),
                'image'       => asset($product->getImage()),
                'category'    => $product->getCategory()->getName()
            ];
        });
    }
}
