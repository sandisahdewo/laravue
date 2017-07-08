<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Items;
use DB;

class ItemsController extends Controller
{
    public function index() {
    	return view('master.items.index');
    }

    public function get() {
    	return Items::all();
    }

    public function create(Request $request) {
    	$this->validate($request, [
    		'code' => 'required|numeric',
    		'name' => 'required'
    	]);

        $items = Items::create($request->all());

    	return response()->json(['success' => true]);
    }

    public function find($id) {
    	return Items::find($id);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'code' => 'required|numeric',
            'name' => 'required'
        ]);

        Items::find($id)->update($request->all());

        return response()->json(['success' => true]);
    }

    public function delete(Request $request) {
        DB::transaction(function() use ($request){
            foreach ($request->all() as $value) {
                Items::destroy($value['id']);
            }
        });
        return response()->json(['success' => true]);
    }
}
