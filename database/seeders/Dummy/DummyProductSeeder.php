<?php

namespace Database\Seeders\Dummy;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DummyProductSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = File::json('database/seeders/data/products.json');

        foreach ($products as $product) {
            Product::factory()->create($product);
        }

        dump(Product::all()->toArray());
    }
}
