<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminProductController extends Controller
{
    //
    public function products(){
        $products = Product::all()->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }
}
