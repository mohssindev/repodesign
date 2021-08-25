<?php

namespace App\Http\Controllers\Products;

use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductFormRequest;
use App\Models\Product;

class StoreProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    public function __invoke(CreateProductFormRequest $request)
    {

        //dd($request->allFiles());
        $attrs = $request->validated();
        $attrs['image'] = $request->file('image');

        $product = $this->productService->create($attrs);

        return response()->json($this->itemResponse($product));
    }

    private function itemResponse(Product $product): array
    {
        return [
                'id'          => $product->getId(),
                'name'        => $product->getName(),
                'description' => $product->getDescription(),
                'price'       => $product->getPrice(),
                'image'       => asset($product->getImage()),
                'category'    => $product->getCategory()->getName()
        ];
    }
}
