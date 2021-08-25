<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\ProductService;
use App\Services\CategoryService;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

class GetProductsByCategoryController extends Controller
{
    /** @var ProductService  */
    private $productService;

    /** @var CategoryService */
    private $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function __invoke(Request $request, int $id)
    {
        $category = $this->categoryService->findById($id);
        $page = (int)$request->get('page', 1);
        $perPage = (int)$request->get('count', 20);

        if (!$category instanceof Category) {
            return response()->json(
                ['error' => 'category not found'],
                Response::HTTP_NOT_FOUND
            );
        }

        $productsPaginated = $this->productService->getByCategoryPaginated($category, $page, $perPage);

        $products = $productsPaginated->getCollection();
        $products = $this->arrayResponse($products);
        $productsPaginated->setCollection($products);

        return response()->json($productsPaginated, Response::HTTP_OK);
    }

    private function arrayResponse(Collection $products): Collection
    {
        return $products->map(function (Product $product) {
            return [
                'id'          => $product->getId(),
                'name'        => $product->getName(),
                'description' => $product->getDescription(),
                'price'       => $product->getPrice(),
                'image'       => $product->getImage(),
                'category'    => $product->getCategory()->getName()
            ];
        });
    }
}
