<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Teams;
use Illuminate\Support\Facades\Session;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class TeamsController extends Controller
{
    

    public function list()
    {
                $teams = Teams::whereNotIn('status', [2])
                ->orderBy('created_at', 'desc')
                ->get();

        return view('pages.teams.list', ['teams' => $teams]);
    }


    public function create()
    {
        //  dd(request()->all());
        return view('pages.teams.add');
    }


    public function store(Request $request, Teams $teams)
    {

          
        $request->validate([
            'name'    => 'required'
        ]);

    
        try {

            $imageName = null; // Initialize $imageName

            if (request()->hasFile('files')) {
                $uploadedImage = $request->file('files');
                $imageName = time() . '.' . $uploadedImage->getClientOriginalExtension();
                $destinationPath = public_path('/images/teams');
                $uploadedImage->move($destinationPath, $imageName);
            }

            // dd($imageName);

            $teams = Teams::create([
                'name'    => $request->name,
                'email' => $request->email,
                'image' => $imageName,
                'mobile_number' => $request->mobile_number,
                'address' => $request->address,
                'status'        => '1'
            ]);

            
        return response()->redirectTo('/team/list')->with('message', 'Teams created successfully');

            // return view('pages.teams.list',['message' => 'Teams Created Sucessfully','teams'=>$teams]);


        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }



    public function edit(Teams $teams)
    {

        $getEventbannerImages = Teams::where('id', $teams->id)
                                ->select('image')
                                ->get();
        return view('pages.teams.edit')->with([
            'teams'  => $teams,
            'getEventbannerImages' => $getEventbannerImages
        ]);
    }



    public function update(Request $request, Teams $teams)
    {
        // Validations
        $request->validate([
            'name'    => 'required'
        ]);


        DB::beginTransaction();
        try {

            // Store Data
            $teams_updated = Teams::whereId($teams->id)->update([
                'name'    => $request->name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'address' => $request->address,
                'status'        => '1'
            ]);

            DB::commit();


            return response()->redirectTo('/team/list')->with('message', 'Teams Updated successfully');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }





    public function delete(Teams $teams)
    {
        try {

            // dd($teams->id);
            $teams_updated = Teams::whereId($teams->id)->update([
                'status'        => '2'
            ]);
            
            $teams = Teams::whereNotIn('status', [2])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('pages.teams.list', ['teams' => $teams]);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


}
