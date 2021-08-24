<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller {
  
	public function index() {

    	$products = Product::all();

    	return view('user.product.index', compact('products'));

    }

    public  function create(){

    	$categories = Category::all();

   		return view('user.product.create', compact('categories'));

   	}

   	public function store(Request $request){

   		$vali= Validator::make($request->all(), [
			'name' => 'required|string:max:255',
            'image' => 'required|file|mimes:jpeg,jpg,png,gif|max:10000',
            'quantity' => 'required|integer|min:1',
            'category' => 'required|integer|exists:category,id',
            'price' => 'required|integer|min:1',
            'description' => 'required|string',
        ]);

        if ($vali->fails()) {

            return Redirect::back()->withErrors($vali)->withInput();
        } else { 
			
			$image = $request->file('image');
            $user_id = Auth::id();

			$product = new Product();
            $product->name = $request->input('name');
            $product->img = Storage::disk('public')->put('shop', $image);
            $product->price = $request->input('price');
            $product->quantity = $request->input('quantity');
            $product->description = $request->input('description');
            $product->category_id = $request->input('category');
            $product->user_id = $user_id;
            $product->save();

            toastr()->success('Data has been saved successfully!');

            return Redirect::to(route('user.product'));
        }
   	}

	public function edit(int $id){

		$product = Product::findOrFail($id);

		$categories = Category::all();

    	return view('user.product.edit', compact('product','categories'));

	}
	
	public function update(Request $request, int $id){

   		$vali= Validator::make($request->all(), [
			'name' => 'required|string:max:255',
            'image' => 'required|file|mimes:jpeg,jpg,png,gif|max:10000',
            'quantity' => 'required|integer|min:1',
            'category' => 'required|integer|exists:category,id',
            'price' => 'required|integer|min:1',
            'description' => 'required|string',
        ]);

        if ($vali->fails()) {

            return Redirect::back()->withErrors($vali)->withInput();
        } else { 
			
			$image = $request->file('image');
            $user_id = Auth::id();

			$product = Product::findOrFail($id);;
            $product->name = $request->input('name');
            $product->img = Storage::disk('public')->put('shop', $image);
            $product->price = $request->input('price');
            $product->quantity = $request->input('quantity');
            $product->description = $request->input('description');
            $product->category_id = $request->input('category');
            $product->user_id = $user_id;
            $product->save();

            toastr()->success('Data has been updated successfully!');

            return Redirect::to(route('user.product'));
        }

    }

    public function delete(int $id){

    	$product = Product::findOrFail($id);
		$product->delete();

        toastr()->success('Data has been delete  successfully!');
        return Redirect::to(route('user.product'));

    }

}