<?php

namespace App\Managers;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProductManager
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @return LengthAwarePaginator|Product[]
     */
    public function getPaginated(int $page, int $perPage)
    {
        return $this->productRepository->getPaginated($page, $perPage);
    }

    public function create(array $attributes): Product
    {
        return $this->productRepository->create($attributes);
    }

    public function destroy(int $id)
    {
        return $this->productRepository->destroy($id);
    }

    /**
     * @param Category $category
     *
     * @return Product[]|Collection
     */
    public function getByCategoryPaginated(Category $category, int $page = 1, int $perPage = 10)
    {
        return $this->productRepository->getByCategoryPaginated($category->getId(), $page, $perPage);
    }
}
