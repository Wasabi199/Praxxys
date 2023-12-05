<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use Database\Factories\ProductImageFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'username' => 'Admin',
            'email' => 'admin@admin.com',
            'usertype'=>1
        ]);

        User::factory()->create([
            'username' => 'Customer',
            'email' => 'customer@customer.com',
            'usertype'=>2
        ]);

        Product::factory(50)->has(ProductImage::factory(1),'productImage')->create();

        $categories = ['shoe','bag','gadgets'];

        foreach($categories as $category){
            Category::create([
                'category'=>$category
            ]);
        }
    }
}
