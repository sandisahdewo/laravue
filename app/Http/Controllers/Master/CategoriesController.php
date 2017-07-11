<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;

class CategoriesController extends Controller
{

	public function get() {
		return Categories::get();
	}

    public function create(Request $request) {
    	$this->validate($request, [
    		'code' => 'required|numeric|unique:categories,code',
    		'name' => 'required'
    	]);

    	Categories::create($request->all());

    	return response()->json([
    		'success' => 'true'
		]);
    }

    public function find($id) {
    	return Categories::find($id);
    }

    public function update(Request $request, $id) {
    	$this->validate($request, [
    		'code' => 'required|unique:categories,code,'.$id,
    		'name' => 'required'
    	]);

    	Categories::find($id)->update($request->all());

    	return response()->json([
    		'success' => 'true'
		]);
    }

    public function delete($id) {
    	Categories::destroy($id);

    	return response()->json([
    		'success' => 'true'
		]);
    }
}
