<?php

namespace App\Managers;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class CategoryManager
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return Category[]|Collection
     */
    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function findById(int $id): ?Category
    {
        return $this->categoryRepository->findById($id);
    }

    public function create(string $name, ?Category $parentCategory = null)
    {
        return $this->categoryRepository->create($name, optional($parentCategory)->getId());
    }

    public function destroy(int $id)
    {
        return $this->categoryRepository->destroy($id);
    }
}
