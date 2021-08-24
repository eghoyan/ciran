<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Product;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function index() {

    	$products = Product::all();

    	return view('admin.product.index', compact('products'));

    }

    public function active(int $id) {

    	$product = Product::findOrFail($id);
    	$product->status = Product::ACTIVE;
    	$product->save();
    
        toastr()->success('Data has been active successfully!');

    	return Redirect::back();
    }

    public function block(int $id){
    	$product = Product::findOrFail($id);
    	$product->status = Product::BLOCK;
    	$product->save();
    
        toastr()->success('Data has been block successfully!');

    	return Redirect::back();
    }

    public function unblock(int $id){
    	$product = Product::findOrFail($id);
    	$product->status = Product::ACTIVE;
    	$product->save();
    
        toastr()->success('Data has been unblock successfully!');

    	return Redirect::back();
    }
}
