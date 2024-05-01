<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Certifications;
use Illuminate\Support\Facades\Session;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class CertificationsController extends Controller
{

    public function index()
    {
                $certifications = Certifications::whereNotIn('status', [2])
                ->orderBy('created_at', 'desc')
                ->get();

        return view('pages.certifications.list', ['certifications' => $certifications]);
    }


    public function create()
    {
        return view('pages.certifications.add');
    }


    public function store(Request $request, Certifications $certifications)
    {

          
        $request->validate([
            'standard'    => 'required'
        ]);

    
        try {

            $certifications = Certifications::create([
                'standard'    => $request->standard,
                'certification_body' => $request->certification_body,
                'status'        => '1'
            ]);

            
        return response()->redirectTo('/certifications/list')->with('message', 'Certifications created successfully');

            // return view('pages.certifications.list',['message' => 'Certifications Created Sucessfully','certifications'=>$certifications]);


        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }



    public function edit(Certifications $certifications)
    {

        return view('pages.certifications.edit')->with([
            'certifications'  => $certifications
        ]);
    }



    public function update(Request $request, Certifications $certifications)
    {
        // Validations
        $request->validate([
            'standard'    => 'required'
        ]);


        DB::beginTransaction();
        try {

            // Store Data
            $certifications_updated = Certifications::whereId($certifications->id)->update([
                'standard'    => $request->standard,
                'certification_body' => $request->certification_body,
                'status'        => '1'
            ]);

            DB::commit();


            return response()->redirectTo('/certifications/list')->with('message', 'Certifications Updated successfully');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }





    public function delete(Certifications $certifications)
    {
        try {
            $certifications_updated = Certifications::whereId($certifications->id)->update([
                'status'        => '2'
            ]);
            
            $certifications = Certifications::whereNotIn('status', [2])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('pages.certifications.list', ['certifications' => $certifications]);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


}
