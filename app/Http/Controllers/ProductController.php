<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
     /**
     * Show add product page
     *
     */
    public function showAddProductPage()
    {
        return Inertia::render('Master/AddProduct');
    }

    /**
     * Show product list page
     *
     */
    public function showManageProductPage()
    {
        $products = Products::orderBy('id')->get();
        return Inertia::render('Master/ManageProduct', [
            'products' => $products
        ]);
    }

    /**
     * Show product list page
     *
     */
    public function getProductList(Request $request)
    {
       
        $products = Products::orderBy('id')->get();
        if (!empty($request->searchBy)) {
            $products = Products::orderBy('id')->where('sku', 'LIKE', '%' . $request->searchBy . '%')
            ->orderBy('id')->get();
        }
        return response()->json(['success' => [
            'products' => $products,
        ]]);
    }

    /**
     * Edit  Product
     *
     * @param Products $product
     * @param Request $request
     * @return void
     */
    public function editProduct(Products $product, Request $request)
    {
        return Inertia::render('Master/AddProduct', ['product' => $product]);
    }

    /**
     * Delete product
     *
     * @param Products $product
     * @param Request $request
     */
    public function deleteProduct(Products $product, Request $request)
    {
        $product->delete();
        return redirect('master/manage-product');
    }

    /**
     * Save new product
     *
     * @param Request $request
     */
    public function createOrUpdateProduct(Request $request)
    {
        if ($request->edit && $request->id) {
            Products::where('id', $request->id)->update([
                'sku' => $request->sku,
                'short_name' => $request->short_name,
                'description' => $request->description,
                'description_on_box' => $request->description_on_box,
                'model' => $request->model,
                'color' => $request->color,
                'size' => $request->size,
                'marin_code' => $request->marin_code,
                'barcode_color' => $request->barcode_color,
                'type' => $request->type,
                'insera_code' => $request->insera_code,
                'fork' => $request->fork,
            ]);
        } else {
            Products::create([
                'sku' => $request->sku,
                'short_name' => $request->short_name,
                'description' => $request->description,
                'description_on_box' => $request->description_on_box,
                'model' => $request->model,
                'color' => $request->color,
                'size' => $request->size,
                'marin_code' => $request->marin_code,
                'barcode_color' => $request->barcode_color,
                'type' => $request->type,

            ]);
        }
        return redirect('master/add-product')->with("success", "Added Product");
    }
}
