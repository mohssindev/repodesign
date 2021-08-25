<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ProductService;
use App\Http\Requests\CreateProductFormRequest;

class CreateProductCommand extends Command
{
    private $productService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create a new Product';

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
    public function handle(CreateProductFormRequest $request)
    {
        $attributes = [];
        $attributes['name'] = $this->ask('Enter product name: ');
        $attributes['description'] = $this->ask('Enter product description: ');
        $attributes['price'] = $this->ask('Enter product price: ');
        $attributes['category_id'] = $this->ask('Enter category ID of the product: ');
        $attributes['image'] = $this->ask('Enter the absolute path of the product image: ');

        $attributes = $request->validated();
        $attributes['image'] = $request->file('image');

        $product = $this->productService->create($attributes);
        if ($product) {
            return $this->info('Product was created sucessfully.');
        } else {
            return $this->error('Something went wrong !, try again.');
        }
    }
}
