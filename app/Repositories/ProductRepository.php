<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProductRepository
{
    /**
     * Retrieve all categories
     *
     * @return LengthAwarePaginator|Product[]
     */
    public function getPaginated(int $page, int $perPage)
    {
        return Product::query()
            ->paginate(
                $perPage,
                ['*'],
                'page',
                $page
            );
    }

    public function create(array $attributes): Product
    {
        return Product::query()
            ->create($attributes);
    }

    public function destroy(int $id): bool
    {
        return Product::query()
            ->where('id', $id)
            ->delete() === 1;
    }

    public function findById(int $id): ?Product
    {
        return Product::query()
            ->where(Product::ID_COLUMN, $id)
            ->first();
    }

    public function findByName(string $name): ?Product
    {
        return Product::query()
            ->where(Product::NAME_COLUMN, $name)
            ->first();
    }

    /**
     * @param int $categoryId
     *
     * @return Product[]|Collection
     */
    public function getByCategoryPaginated(int $categoryId, int $page = 1, int $perPage = 10)
    {
        return Product::query()
        ->where(Product::CATEGORY_ID_COLUMN, $categoryId)
        ->paginate(
            $perPage,
            ['*'],
            'page',
            $page
        );
    }



}
