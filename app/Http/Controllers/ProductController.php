<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\ProductSearch\ProductSearch;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Get a list of all the products stored in the database
     * Default page size is 20
     */
    public function index()
    {
        $products = Product::with('images')->paginate(20);

        return  $products;
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        return $product;
    }

    public function filter(Request $request)
    {
        return  ProductSearch::apply($request);
    }
}
