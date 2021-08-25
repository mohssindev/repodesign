<?php

namespace App\Services;

use App\Managers\CategoryManager;
use App\Managers\ProductManager;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    private const PRODUCT_IMAGES_PATH = '/products';

    /** @var ProductManager  */
    private $productManager;

    /** @var Filesystem */
    private $filesystem;

    public function __construct(ProductManager $productManager,CategoryManager $categoryManager, Filesystem $filesystem)
    {
        $this->productManager = $productManager;
        $this->categoryManager = $categoryManager;
        $this->filesystem = $filesystem;
    }

    /**
     * @return LengthAwarePaginator|Product[]
     */
    public function getPaginated(int $page, int $perPage)
    {
        $productsPaginated = $this->productManager->getPaginated($page, $perPage);

        $products = $productsPaginated->getCollection();

        $products = $products->map(function (Product $product) {

            return $this->hydrate($product);
        });

        $productsPaginated->setCollection($products);

        return $productsPaginated;
    }

    public function create(array $attributes): Product
    {
        $attrs = $attributes;

        /** @var UploadedFile $productImage */
        $productImage = Arr::get($attrs, 'image');
        $newImagePath = null;

        if ($productImage !== null) {
            $newImagePath = Storage::disk('public')->put(self::PRODUCT_IMAGES_PATH, $productImage);
        }

        $attrs['image'] = $newImagePath;

        $product = $this->productManager->create($attrs);

        return $this->hydrate($product);
    }

    public function destroy(int $id)
    {
        return $this->productManager->destroy($id);
    }

    public function getByCategoryPaginated($category, int $page = 1, int $perPage = 10)
    {
        $productsPaginated = $this->productManager->getByCategoryPaginated($category, $page, $perPage);
        $products = $productsPaginated->getCollection();
        $products = $products->map(function (Product $product) {
            return $this->hydrate($product);
        });
        $productsPaginated->setCollection($products);

        return $productsPaginated;
    }

    private function hydrate(Product $product): Product
    {
        $category = $this->categoryManager->findById($product->getCategoryId());

        if ($category instanceof Category) {

            $product->setCategory($category);
        }

        return $product;
    }
}
