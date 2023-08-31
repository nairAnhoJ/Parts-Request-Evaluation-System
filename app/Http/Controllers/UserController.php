<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(){
        $users = DB::table('pres_users')->get();

        return view('admin.users.index', compact('users'));
    }

    public function add(){
        return view('admin.users.add');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->with('error', "Oops! It seems like you missed a few required fields.")->withInput();
        }

        $id = $request->id;
        $name = $request->name;
        $role = $request->role;

        $unique = false;
        $key = null;

        while (!$unique) {
            $key = Str::uuid()->toString();
            $existingModel = User::where('key', $key)->first();
            if (!$existingModel) {
                $unique = true;
            }
        }

        $user = new User();
        $user->id_number = strtoupper($id);
        $user->name = strtoupper($name);
        $user->role = $role;
        $user->key = $key;
        $user->save();

        return redirect()->route('users.index')->with('success', "New user added successfully!");
    }

    public function edit($key){
        $user = User::where('key', $key)->first();

        return view('admin.users.edit', compact('user', 'key'));
    }

    public function update(Request $request, $key){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->with('error', "Oops! It seems like you missed a few required fields.")->withInput();
        }

        $id = $request->id;
        $name = $request->name;
        $role = $request->role;

        $user = User::where('key', $key)->first();
        $user->id_number = strtoupper($id);
        $user->name = strtoupper($name);
        $user->role = $role;
        $user->save();

        return redirect()->route('users.index')->with('success', "User edited successfully!");
    }

    public function delete($key){
        User::where('key', $key)->delete();

        return redirect()->route('users.index')->with('success', "User deleted successfully!");
    }

    public function reset($key){
        $user = User::where('key', $key)->first();
        $user->password = Hash::make('password2023');
        $user->first_time_login = 1;
        $user->save();

        return redirect()->route('users.index')->with('success', "Password has been reset successfully!");
    }
}
