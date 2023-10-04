<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\DeleteProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request as QueryRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class MainController extends Controller
{
    //
    public function dashboard()
    {
        return Inertia::render('Praxxys/Dashboard');
    }

    public function products(QueryRequest $request)
    {
        $filters = $request::only('search', 'view', 'category');
        $products = Product::filter($filters)->limit($filters['view'] ?? 5)->paginate($filters['view'] ?? 5)->appends($filters);

        return Inertia::render('Praxxys/Products', [
            'Products' => $products,
            'Filters' => $filters
        ]);
    }

    public function createProducts()
    {

        return Inertia::render('Praxxys/CreateProduct');
    }

    public function addProducts(CreateProductRequest $request)
    {
        $validated_data = $request->validated();
        // dd($validated_data);
        DB::transaction(function () use ($validated_data) {
            $product = Product::create([
                'name' => $validated_data['name'],
                'category' => $validated_data['category'],
                'description' => $validated_data['description'],
                'date' => $validated_data['date'],
                'time' => Carbon::now()->format('h:i:s'),
            ]);

            if (isset($validated_data['files'])) {
                if (is_array($validated_data['files'])) {
                    foreach ($validated_data['files'] as $file) {
                        $product->productImage()->create([
                            'filename' => $file->storePublicly('ProductImages',  ['disk' => 'public'])
                        ]);
                    }
                } else {
                    $product->productImage()->create([
                        'filename' => $validated_data['files']->storePublicly('ProductImages',  ['disk' => 'public'])
                    ]);
                }
            }
        });

        return Redirect::route('products');
    }

    public function deleteProduct(DeleteProductRequest $request)
    {
        $validated_data = $request->validated();

        DB::transaction(function () use ($validated_data) {

            $product = Product::findOrFail($validated_data['id']);
            $product->delete();
        });

        return Redirect::back();
    }

    public function updateProduct(UpdateProductRequest $request)
    {
        $validated_data = $request->validated();

        DB::transaction(function () use ($validated_data) {
            $product = Product::findOrFail($validated_data['id']);
            $product->update([
                'name' => $validated_data['name'],
                'category' => $validated_data['category'],
                'description' => $validated_data['description'],
                'date' => $validated_data['date'],
                'time' => Carbon::now()->format('h:i:s'),
            ]);

            if (isset($validated_data['files'])) {
                if (is_array($validated_data['files'])) {
                    foreach ($validated_data['files'] as $file) {
                        $product->productImage()->create([
                            'filename' => $file->storePublicly('ProductImages',  ['disk' => 'public'])
                        ]);
                    }
                } else {
                    $product->productImage()->create([
                        'filename' => $validated_data['files']->storePublicly('ProductImages',  ['disk' => 'public'])
                    ]);
                }
            }
        });

        return Redirect::back();
    }

    public function videoPlayer(){
        return Inertia::render('Praxxys/VideoPlayer');
    }
}
