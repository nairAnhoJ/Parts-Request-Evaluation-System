<?php

namespace App\Http\Controllers;

use App\Models\PresUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // Show the login form
    public function index(){
        if(Auth()->user() != null){
            if(Auth()->user()->role == '0'){
                return redirect()->route('users.index');
            }
        }
        return view('login');
    }

    // Process the login request
    public function login(Request $request){
        $credentials = $request->validate([
            'id_number' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard()->attempt($credentials)) {
            if(Auth::user()->first_time_login == '1'){
                return redirect()->route('password.change');
            }else{
                return redirect()->route('dashboard.index');

                // if(Auth()->user()->role == '0'){
                //     return redirect()->route('users.index');
                // }
            }
        } else {
            return back()->withInput()->withErrors(['error' => 'Invalid credentials']);
        }
    }

    public function change(){
        if(Auth::user()->first_time_login == '1'){
            return view('change-password');
        }else{
            return redirect()->route('users.index');
        }
    }

    public function passwordUpdate(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|confirmed',
            // Other validation rules for the registration form
        ]);
    
        if ($validator->fails()) {
            if($request->password != $request->password_confirmation){
                return redirect()->back()->withInput()->withErrors([
                    'error' => 'The password you enter does not match.',
                ]);
            }else{
                return redirect()->back()->withInput()->withErrors([
                    'error' => 'Invalid Password.',
                ]);
            }
        }

        $hashedPassword = Hash::make($request->password);
        $user = User::where('id', Auth::user()->id)->first();
        $user->password = $hashedPassword;
        $user->first_time_login = 0;
        $user->save();

        // DB::table('users')->where('id', Auth::user()->id)->update([
        //     'password' => $hashedPassword,
        //     'first_time_login' => 0
        // ]);

        return redirect()->route('dashboard.index');
    }

    // Logout the user
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
