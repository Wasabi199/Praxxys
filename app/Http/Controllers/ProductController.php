<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\DeleteImageRequest;
use App\Http\Requests\DeleteProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class ProductController extends Controller
{
    //
    public function products(FacadesRequest $request)
    {
        $filters = $request::only('search', 'view', 'category');
        $products = Product::with('productImage')->filter($filters)->limit($filters['view'] ?? 5)->paginate($filters['view'] ?? 5)->appends($filters);
        $categories = Category::all();
        return Inertia::render('Praxxys/Products', [
            'Categories' => $categories,
            'Products' => $products,
            'Filters' => $filters
        ]);
    }

    public function createProducts()
    {
        $categories = Category::all();

        return Inertia::render('Praxxys/CreateProduct', [
            'Categories' => $categories
        ]);
    }

    public function addProducts(CreateProductRequest $request)
    {
        $validated_data = $request->validated();
        // dd($validated_data);
        DB::transaction(function () use ($validated_data) {
            $product = Product::create([
                'name' => $validated_data['name'],
                'category' => $validated_data['category'],
                'price' => $validated_data['price'],
                'description' => $validated_data['description'],
                'date' => $validated_data['date'],
                'time' => Carbon::now()->format('h:i:s'),
            ]);

            if (isset($validated_data['files'])) {
                if (is_array($validated_data['files'])) {
                    foreach ($validated_data['files'] as $file) {
                        $product->productImage()->create([
                            'filename' => 'storage/' . $file->storePublicly('ProductImages',  ['disk' => 'public'])
                        ]);
                    }
                } else {
                    $product->productImage()->create([
                        'filename' => 'storage/' . $validated_data['files']->storePublicly('ProductImages',  ['disk' => 'public'])
                    ]);
                }
            }
        });

        return Redirect::route('products')->with('message', [NotificationService::notificationItem('success', '', 'Product Created Success')]);
    }

    public function deleteProduct(DeleteProductRequest $request)
    {
        $validated_data = $request->validated();
        DB::transaction(function () use ($validated_data) {

            $product = Product::findOrFail($validated_data['id']);
            $product->delete();
        });

        return Redirect::back()->with('message', [NotificationService::notificationItem('success', '', 'Product Deleted Success')]);
    }

    public function updateProduct(UpdateProductRequest $request)
    {
        $validated_data = $request->validated();
        // dd($validated_data['files']);
        DB::transaction(function () use ($validated_data,$request) {
            $product = Product::findOrFail($validated_data['id']);
            $product->update([
                'name' => $validated_data['name'],
                'category' => $validated_data['category'],
                'description' => $validated_data['description'],
                'date' => $validated_data['date'],
                'time' => Carbon::now()->format('h:i:s'),
            ]);

            if (isset($request['files'])) {
                if (is_array($request['files'])) {
                    foreach ($request['files'] as $file) {
                        $product->productImage()->create([
                            'filename' => 'storage/' . $file->storePublicly('ProductImages',  ['disk' => 'public'])
                        ]);
                    }
                } else {
                    $product->productImage()->create([
                        'filename' => 'storage/' . $request['files']->storePublicly('ProductImages',  ['disk' => 'public'])
                    ]);
                }
            }
        });

        return Redirect::back()->with('message', [NotificationService::notificationItem('success', '', 'Product Updated Success')]);
    }

    public function deleteImage(DeleteImageRequest $request)
    {
        $validated_data = $request->validated();
        DB::transaction(function () use ($validated_data) {
            $image = ProductImage::findOrFail($validated_data['id']);
            $image->delete();
        });
    }
}
