<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CategoryService;

class DeleteCategoryCommand extends Command
{
    private $categoryService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to delete an existing category.';

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
        $id = $this->ask('Enter the ID of the category that you want to delete: ');
        $deletedCategory = $this->categoryService->destroy($id);
        if ($deletedCategory) {
            return $this->info('Category was deleted sucessfully.');
        } else {
            return $this->error('Something went wrong !, the category with this ID does not exist!');
        }
    }
}
