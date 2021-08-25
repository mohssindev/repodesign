<?php

namespace App\Services;

use App\Managers\CategoryManager;
use App\Models\Category;
use Illuminate\Support\Collection;

class CategoryService
{
    private $categoryManager;

    public function __construct(CategoryManager $categoryManager)
    {
        $this->categoryManager = $categoryManager;
    }

    /**
     * @return Collection|Category[]
     */
    public function getAll()
    {
        return $this->categoryManager->getAll();
    }

    public function findById(int $id): ?Category
    {
        return $this->categoryManager->findById($id);
    }

    public function create(string $name, ?Category $parentCategory = null): Category
    {
        return $this->categoryManager->create($name, $parentCategory);
    }

    public function destroy(int $id)
    {
        return $this->categoryManager->destroy($id);
    }
}
