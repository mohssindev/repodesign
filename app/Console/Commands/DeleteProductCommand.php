<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ProductService;

class DeleteProductCommand extends Command
{
    private $categoryService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to delete an existing Product.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ProductService $productService)
    {
        parent::__construct();
        $this->productService = $productService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $id = $this->ask('Enter the ID of the product that you want to delete: ');
        $deletedProduct = $this->productService->destroy($id);
        if ($deletedProduct) {
            return $this->info('The Product was deleted sucessfully.');
        } else {
            return $this->error('Something went wrong !, the Product with this ID does not exist!');
        }
    }
}
