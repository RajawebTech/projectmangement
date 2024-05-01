<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customers;
use App\Models\Amcfrequency;
use App\Models\Certifications;
use Illuminate\Support\Facades\Session;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{

    public function index()
    {
                $customers = Customers::whereNotIn('status', [2])
                ->orderBy('created_at', 'desc')
                ->get();

        return view('pages.customers.list', ['customers' => $customers]);
    }


    public function create()
    {
        //  dd(request()->all());

            $certificates = Certifications::whereNotIn('status', [2])
            ->orderBy('created_at', 'desc')
            ->get();

            $amcfrequency = Amcfrequency::whereNotIn('status', [2])
            ->orderBy('created_at', 'desc')
            ->get();

            return view('pages.customers.add', 
            [
                'certificates' => $certificates,
                'amcfrequency' => $amcfrequency

        ]);
    }


    public function store(Request $request, Customers $customers)
    {

        try {

                $customers = Customers::create([
                    'customer_name'    => $request->customer_name,
                    'contact_name'    => $request->contact_name,
                    'email_id'    => $request->email_id,
                    'mobile_number'    => $request->mobile_number,
                    'address'    => $request->address,
                    'amc_frequency'    => $request->frequency_type,
                    'certification_standard_id'    => json_encode($request->certificates),
                    'status'        => '1'
                ]);
      

            return response()->redirectTo('/customers/list')->with('message', 'Customers created successfully');


        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }



    public function edit(Customers $customers)
    {
             
        $customersdata = Customers::where('id', $customers->id)->first();

        $certificateselect = []; 
        
        if ($customersdata && isset($customersdata->certification_standard_id)) {
            $certificateselect = json_decode($customersdata->certification_standard_id, true);
        }
        
        $certificatedropdown = Certifications::whereNotIn('status', [2])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('pages.customers.edit', [
            'customers' => $customers,
            'certificatedropdown' => $certificatedropdown,
            'certificateselect' => $certificateselect
        ]);
        
        
    }



    public function view(Customers $customers)
    {


          $changecertificateName = $customers->certification_standard_id;

          $certificationIds = json_decode($changecertificateName);
              
          $certificates = [];
                            
          foreach ($certificationIds as $certificationId) {
                     $certification = Certifications::where('id', $certificationId)
                                       ->select('standard')
                                       ->first();
                            
        if ($certification) {
                  $certificates[] = $certification;
                }
         }
                            
        // dd($certificates);

            return view('pages.customers.view', [
                'customers' => $customers,
                'certificates'=> $certificates
            ]);
    }



    public function update(Request $request, Customers $customers)
    {

        try {

            // Store Data
            $customers_updated = Customers::whereId($customers->id)->update([
                'customer_name'    => $request->customer_name,
                'contact_name'    => $request->contact_name,
                'email_id'    => $request->email_id,
                'mobile_number'    => $request->mobile_number,
                'address'    => $request->address,
                'amc_frequency'    => $request->frequency_type,
                'certification_standard_id'    => json_encode($request->certificates),
                'status'        => '1'
            ]);

            DB::commit();


            return response()->redirectTo('/customers/list')->with('message', 'Customers Updated successfully');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }





    public function delete(Customers $customers)
    {
        try {
            $customers_updated = Customers::whereId($customers->id)->update([
                'status'        => '2'
            ]);
            
            $customers = Customers::whereNotIn('status', [2])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('pages.customers.list', ['customers' => $customers]);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


}
