<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

    public function index()
    {
     $user = User::where('id', [1])
             ->get();
        return view('pages.user.view', ['user' => $user]);
    }


    public function showLoginForm(Request $request)
    {
    //   dd($request->all());

      $validatedData = $request->validate([
        'username' => 'required',
        'password' => 'required'
    ]);

        if (!$validatedData) {
            return response()->redirectTo('pages.login')->with('error', 'Username and password are required.');
        }

        $credentials = $request->only('username', 'password');

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return view('pages.login');
            
        }

        if (Hash::check($credentials['password'], $user->password)) {
            return view('pages.dashboard');
        } else {
            return view('pages.login');
        }

        return view('pages.dashboard');
    }


    public function update(Request $request, user $user)
    {

        try {
            $user = User::whereId($user->id)->update([
                'first_name'    => $request->first_name,
                'last_name'     => $request->last_name,
                'email'         => $request->email,
                'mobile_number' => $request->mobile_number,
                'status'        => '1'
            ]);

            $user = User::where('id', [5])
            ->get();
            return response()->redirectTo('/team/list')->with('message', 'Profile Updated Sucessfully');


        }
         catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }


}
