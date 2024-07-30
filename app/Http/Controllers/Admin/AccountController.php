<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Account as Model;

class AccountController extends Controller
{
    public $ent = 'Account';

    public function all() {
        $records = Model::all();

        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function add(Request $request) {
        $request->validate([
            'name' => 'required', 
            'pass' => 'required',
            'type' => 'required',
        ]);

        $record = new Model();
        $keys = ['name', 'pass', 'type'];
        foreach ($keys as $key) {
            if ($key == 'pass') {
                $record->$key = Hash::make($request->$key);
            }
            else {
                $record->$key = $request->$key;
            }
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
            'name' => 'required', 
            'pass' => 'required',
            'type' => 'required',
        ]);

        $record = Model::find($request->id);
        $keys = ['name', 'pass', 'type'];
        foreach ($keys as $key) {
            if ($key == 'pass') {
                $upd[$key] = Hash::make($request->$key);
            }
            else {
                $upd[$key] = $request->$key;
            }
        }
        $record->update($upd);

        return response(['msg' => "Updated $this->ent"]);
    }

    public function del($id) {
        $record = Model::find($id)->delete();
        return response(['msg' => "Deleted $this->ent"]);
    }
}
