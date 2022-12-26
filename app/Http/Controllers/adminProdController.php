<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class adminProdController extends Controller
{
    public function products(){
        $products = Product::orderBy('id','DESC')->paginate(10);
        return view('admin.products.index', compact('products'));
    }
}
