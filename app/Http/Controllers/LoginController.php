<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    public function home()
    {
        return view('welcome');
    }  

    public function index()
    {
        return view('auth.login');
    }  

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        // dd($credentials);
        if(auth()->attempt(array('email' => $request->email, 'password' => $request->password))){
            if (auth()->user()->role === 'student') {
                return redirect()->intended('dashboard')
                // ->withSuccess('Signed in');
                ->with('success','It is successMessage');
            }
            elseif(auth()->user()->role === 'guidance') {
            return redirect()->intended('dashboard')
                        // ->withSuccess('Signed in');
                        ->with('success','It is successMessage');
        }
    }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
   
        return redirect("login")->withSuccess('You are not allowed to access');
    }
     
 
    public function signOut() {
        Session::flush();
        Auth::logout();
   
        return Redirect('login');
    }

    public function postSignup(Request $request){
        $this->validate($request, [
            'email' => 'email| required| unique:users',
            'password' => 'required| min:4'
        ]);

         $user = new User([
          'name' => $request->input('fname'),
          'email' => $request->input('email'),
          'password' => bcrypt($request->input('password')),
          'role'=>"student"

        ]);

         $user->save();
        return redirect()->back();
    }

}
