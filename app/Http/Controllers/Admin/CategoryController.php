<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {

    	$categories = Category::all();

    	return view('admin.category.index', compact('categories'));

    }
   	public  function create(){

   		return view('admin.category.create');

   	}

   	public function store(Request $request){

   		$vali = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:category'
        		]);

        if ($vali->fails()) {

            return Redirect::back()->withErrors($vali)->withInput();
        } else { 
			
			$category = new Category();
			$category->name = $request->input('name');
			$category->save();

            toastr()->success('Data has been saved successfully!');

            return Redirect::to(route('admin.category'));
        }
   	}

   	public function delete(int $id){

		$category = Category::findOrFail($id);
		$category->delete();

        toastr()->success('Data has been delete  successfully!');
        return Redirect::to(route('admin.category'));
   	}

   	public function edit(int $id) {

		  $category = Category::findOrFail($id);

    	return view('admin.category.edit', compact('category'));
   	}

   	public function update(Request $request, int $id){

   		$vali = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:category'
        		]);

        if ($vali->fails()) {

            return Redirect::back()->withErrors($vali)->withInput();
        } else { 
			
			$category = Category::findOrFail($id);
			$category->name = $request->input('name');
			$category->save();

            toastr()->success('Data has been updated successfully!');

            return Redirect::to(route('admin.category'));
        }
   	}
}
