<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product as Model;
use App\Models\Category as Related;

class ProductController extends Controller
{
    public $ent = 'Product';

    public function all() {
        $records = Model::with('category')->get();

        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function add(Request $request) {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'desc' => 'required',
            'weight' => 'required',
            'expire' => 'required',
            'stocks' => 'required|numeric',
            'price' => 'required|numeric',
            'category_id' => 'required',
        ]);

        $record = new Model();
        $keys = ['id', 'name', 'desc', 'weight', 'expire', 'stocks', 'price', 'category_id'];
        foreach ($keys as $key) {
            $record->$key = $request->$key;
        }
        $record->save();

        return response(['msg' => "Added $this->ent"]);
    }

    public function edit($id) {
        $record = Model::find($id);

        $data = [
            'record' => $record,
        ];

        return response($data);
    }

    public function upd(Request $request) {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'desc' => 'required',
            'weight' => 'required',
            'expire' => 'required',
            'stocks' => 'required|numeric',
            'price' => 'required|numeric',
            'category_id' => 'required',
        ]);

        $record = Model::find($request->id);
        $keys = ['id', 'name', 'desc', 'weight', 'expire', 'stocks', 'price', 'category_id'];
        foreach ($keys as $key) {
            $upd[$key] = $request->$key;
        }
        $record->update($upd);

        return response(['msg' => "Updated $this->ent"]);
    }

    public function del($id) {
        $record = Model::find($id)->delete();
        return response(['msg' => "Deleted $this->ent"]);
    }
}
