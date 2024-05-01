<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
// use Session;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Sidemenu;
use Illuminate\Support\Facades\Auth;


class CustomAuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }  
      

    public function customLogin(Request $request)
    {

       
        $validator = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            $userData = [
                'email' => $user->email,
                'name' => $user->name,
                'role_id' => $user->role_id
            ];

            session(['userData' => $userData]);
        
            return view('dashboard', [
                'userData' => $user->role_id
                ]);
        } else {
            abort(403, 'Invalid Login.');
        }
        
    }


    public function dashboardpage()
{
    $userData = session('userData');

    if ($userData) {
        $email = $userData['email'];
        $name = $userData['name'];
        $role_id = $userData['role_id'];

        return view('dashboard', [
            'userData' => $userData['role_id']
            ]);

    } 
}



    

    public function registration()
    {
        return view('auth.registration');
    }
      
    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return response()->redirectTo('/roles/list')->with('message', 'Roles Assigned Sucessfully');
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'role_id' => $data['role_id'],
        'password' => Hash::make($data['password'])
      ]);
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
}