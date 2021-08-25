<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;

class ListCategoriesController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }


    public function __invoke()
    {
        $categories = $this->categoryService->getAll();

        return response()->json($categories);
    }
}
