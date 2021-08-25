<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{
    /**
     * @return Category[]|Collection
     */
    public function getAll()
    {
        return Category::query()->get();
    }

    public function create(string $name, ?int $parentCategory = null): Category
    {
        return Category::query()
            ->create(
                [
                    Category::NAME_COLUMN => $name,
                    Category::PARENT_ID_COLUMN => $parentCategory
                ]
            );
    }

    public function destroy(int $id): bool
    {
        return Category::query()
            ->where('id', $id)
            ->delete() === 1;
    }

    public function findById(int $id): ?Category
    {
        return Category::query()
            ->where(Category::ID_COLUMN, $id)
            ->first();
    }

    public function findByName(string $name): ?Category
    {
        return Category::query()
            ->where(Category::NAME_COLUMN, $name)
            ->first();
    }
}
