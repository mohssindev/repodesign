<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CategoryService;

class CreateCategoryCommand extends Command
{
    private $categoryService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create a new Category';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CategoryService $categoryService)
    {
        parent::__construct();
        $this->categoryService = $categoryService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('Enter a category name: ');
        $parent_id = $this->ask('Enter the ID of the parent category: ');
        if ($parent_id && !$this->parentExist($parent_id)) {
            $this->error('Parent does not exist');
        }
        $category = $this->categoryService->create($name, $parent_id);
        if ($category) {
            return $this->info('Category was created sucessfully.');
        } else {
            return $this->error('Something went wrong !, try again.');
        }
    }

    public function parentExist($id)
    {
        return $this->categoryService->findById($id);
    }
}
