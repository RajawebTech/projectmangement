<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Teams;
use App\Models\User;
use Illuminate\Support\Facades\Session;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{

    public function index()
    {
        $usersList = User::select('users.name', 'users.email', 'roles.name as rolename')
                    ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
                    ->orderBy('users.created_at', 'asc') 
                    ->get();

        return view('pages.roles.list', ['usersList' => $usersList]);
    }


    public function create()
    {
       

        $teams = Teams::whereNotIn('status', [2])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('pages.roles.add', [
            'teams' => $teams,       
         ]);
    }



    public function edit(Roles $roles)
    {

        $getEventbannerImages = Roles::where('id', $roles->id)
                                ->select('image')
                                ->get();
        return view('pages.roles.edit')->with([
            'roles'  => $roles,
            'getEventbannerImages' => $getEventbannerImages
        ]);
    }



    public function update(Request $request, Roles $roles)
    {
        // Validations
        $request->validate([
            'name'    => 'required'
        ]);


        DB::beginTransaction();
        try {

            // Store Data
            $roles_updated = Roles::whereId($roles->id)->update([
                'name'    => $request->name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'address' => $request->address,
                'status'        => '1'
            ]);

            DB::commit();


            return response()->redirectTo('/team/list')->with('message', 'Roles Updated successfully');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }





    public function delete(Roles $roles)
    {
        try {

            // dd($roles->id);
            $roles_updated = Roles::whereId($roles->id)->update([
                'status'        => '2'
            ]);
            
            $roles = Roles::whereNotIn('status', [2])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('pages.roles.list', ['roles' => $roles]);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


}
