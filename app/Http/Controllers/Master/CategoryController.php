<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{

	public function get() {
		return Category::get();
	}

    public function create(Request $request) {
    	$this->validate($request, [
    		'code' => 'required|numeric|unique:categories,code',
    		'name' => 'required'
    	]);

    	Category::create($request->all());

    	return response()->json([
    		'success' => 'true'
		]);
    }

    public function find($id) {
    	return Category::find($id);
    }

    public function update(Request $request, $id) {
    	$this->validate($request, [
    		'code' => 'required|unique:categories,code,'.$id,
    		'name' => 'required'
    	]);
    	Category::find($id)->update($request->all());

    	return response()->json([
    		'success' => 'true'
		]);
    }

    public function delete($id) {
    	Category::destroy($id);

    	return response()->json([
    		'success' => 'true'
		]);
    }
}
