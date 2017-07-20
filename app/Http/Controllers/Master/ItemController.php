<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use DB;

class ItemController extends Controller
{
    public function index() {
    	return view('master.items.index');
    }

    public function get() {
    	return Item::with('category')->get();
    }

    public function create(Request $request) {
    	$this->validate($request, [
    		'code' => 'required|numeric',
    		'name' => 'required',
            'category_id' => 'required'
    	]);
        $items = Item::create($request->all());

    	return response()->json(['success' => true]);
    }

    public function find($id) {
    	return Item::with('category')->find($id);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'code' => 'required|numeric',
            'name' => 'required',
            'category_id' => 'required'
        ]);

        Item::find($id)->update($request->all());

        return response()->json(['success' => true]);
    }

    public function delete(Request $request) {
        DB::transaction(function() use ($request){
            foreach ($request->all() as $value) {
                Item::destroy($value['id']);
            }
        });
        return response()->json(['success' => true]);
    }
}
