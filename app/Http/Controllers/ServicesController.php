<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Services;
use App\Models\Customers;
use App\Models\Amcfrequency;
use App\Models\Certifications;
use App\Models\Workitems;
use App\Models\Teams;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;


class ServicesController extends Controller
{

    public function index()
    {

        
            $services = Services::whereNotIn('status', [2])
            ->orderBy('id', 'desc') 
            ->get();

            $customers = Customers::whereNotIn('status', [2])
                    ->orderBy('id', 'desc') 
                    ->get();


        return view('pages.services.list', [
            'services' => $services,
            'customers' => $customers
        ]);
    }


    public function filterServices(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $customerName = $request->input('customer_name');
        $servicestatus = $request->input('service_status');

        $servicesQuery = Services::whereNotIn('status', [2]);

        if ($fromDate && $toDate) {
            $servicesQuery->whereBetween('created_at', [$fromDate, $toDate]);
        }

        if ($customerName) {
            $servicesQuery->where('customer_name', $customerName);
        }

        if ($servicestatus) {
            $servicesQuery->where('service_status', $servicestatus);
        }

        $services = $servicesQuery->orderBy('created_at', 'desc')->get();

        $customers = Customers::whereNotIn('status', [2])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('pages.services.list', [
            'services' => $services,
            'customers' => $customers
        ]);
    }


    public function create()
    {
        //  dd(request()->all());

            $customers = Customers::whereNotIn('status', [2])
            ->orderBy('created_at', 'desc')
            ->get();

            $certificates = Certifications::whereNotIn('status', [2])
            ->orderBy('created_at', 'desc')
            ->get();

            $workitems = Workitems::whereNotIn('status', [2])
            ->orderBy('created_at', 'desc')
            ->get();

            $teams = Teams::whereNotIn('status', [2])
            ->orderBy('created_at', 'desc')
            ->get();

            $amc = Amcfrequency::whereNotIn('status', [2])
            ->orderBy('created_at', 'desc')
            ->get();


            return view('pages.services.add', [
                'certificates' => $certificates,
                'customers' => $customers,
                'workitems' => $workitems,
                'teams' => $teams,
                'amc' => $amc
            ]);
            
    }


    public function store(Request $request, Services $services)
    {
        // dd(request()->all());
        $customerName = $request->customer_name;
        $serviceType = $request->types_of_services;
        $amcFrequency = $request->amc_frequency;
        $dueDate = $request->due_date;
        $plannedAuditor = $request->planned_auditor;
        $workItems =  $request->work_items; 
        $workLogs = $request->work_logs;
        $serviceStatus = $request->service_status;
        $status = '1';
        
        try {
            $services = Services::create([
                'customer_name' => $customerName,
                'types_of_services' => $serviceType,
                'amc_frequency' => $amcFrequency,
                'due_date' => $dueDate,
                'planned_auditor' => $plannedAuditor,
                'work_items' => json_encode($workItems),
                'work_logs' => $workLogs,
                'service_status' => $serviceStatus,
                'status' => $status
            ]);
        
            return redirect('/services/list')->with('message', 'Services created successfully');
        } catch (\Exception $e) {
            // Log the error or handle it in any other way
            dd($e->getMessage());
        }
        
        
    }



    public function edit(Services $services)
    {
             
        
            $certificatesLists = Certifications::whereNotIn('status', [2])
            ->orderBy('created_at', 'desc')
            ->get();

            $teamsList = Teams::whereNotIn('status', [2])
            ->orderBy('created_at', 'desc')
            ->get();

            $workitems = Workitems::whereNotIn('status', [2])
            ->orderBy('created_at', 'desc')
            ->get();

        // Edit Work Items select

            $servicesdata = Services::where('id', $services->id)->first();


            $serviceselect = []; 
            
            if ($servicesdata && isset($servicesdata->work_items)) {
                $serviceselect = json_decode($servicesdata->work_items, true);
            }

            // dd($serviceselect);
            
            $servicedropdown = Workitems::whereNotIn('status', [2])
                ->orderBy('created_at', 'desc')
                ->get();



            return view('pages.services.edit', [
                'services' => $services,
                'certificatesLists' => $certificatesLists,
                'teamsList' => $teamsList,
                'workitems' => $workitems,
                'servicedropdown' => $servicedropdown,
                'serviceselect' => $serviceselect
            ]);
    }



    public function view(Services $services)
    {



        $servicesdata = Services::where('id', $services->id)->first();

        $serviceselect = []; 
        
        if ($servicesdata && isset($servicesdata->work_items)) {
            $serviceselect = json_decode($servicesdata->work_items, true);
        }
        
        // Use whereIn instead of where to retrieve multiple Workitems
        $workitems = Workitems::whereIn('id', $serviceselect)->get();
        
        return view('pages.services.view', [
            'services' => $services,
            'workitems' => $workitems // Rename the variable to reflect that it contains multiple Workitems
        ]);
        
    }



    public function update(Request $request, Services $services)
    {

        try {

        //  dd(request()->all());

            $customerName = $request->customer_name;
            $serviceType = $request->types_of_services;
            $plannedAuditor = $request->planned_auditor;
            $workItems =json_encode($request->work_items);
            $workLogs = $request->work_logs;
            $amcFrequency = $request->amc_frequency;
            $serviceStatus = $request->service_status;
            $status = '1';
            
            if ($amcFrequency === 'yearly' && $serviceStatus === 'completed') {
                $dueDate = date('Y-m-d', strtotime('+1 year', strtotime($request->due_date)));
                $services = Services::find($services->id); 
                if ($services) {
                    $services->update([
                        'service_status' => 'completed',
                        'status' => '1',
                    ]);
                }

            } elseif ($amcFrequency === 'half_yearly' && $serviceStatus === 'completed') {
                // dd(request()->all());
                $dueDate = date('Y-m-d', strtotime('+6 months', strtotime($request->due_date)));
                $services = Services::find($services->id); 
                if ($services) {
                    $services->update([
                        'service_status' => 'completed',
                        'status' => '1',
                    ]);
                }

            } elseif ($amcFrequency === 'once_a_quarter' && $serviceStatus === 'completed') {
                $dueDate = date('Y-m-d', strtotime('+3 months', strtotime($request->due_date)));
                $services = Services::find($services->id); 
                if ($services) {
                    $services->update([
                        'service_status' => 'completed',
                        'status' => '1',
                    ]);
                }

            } elseif ($amcFrequency === 'twice_a_month' && $serviceStatus === 'completed') {
                $dueDate = date('Y-m-d', strtotime('+2 months', strtotime($request->due_date)));
                $services = Services::find($services->id); 
                if ($services) {
                    $services->update([
                        'service_status' => 'completed',
                        'status' => '1',
                    ]);
                }

            } elseif ($amcFrequency === 'once_a_month' && $serviceStatus === 'completed') {
                $dueDate = date('Y-m-d', strtotime('+1 months', strtotime($request->due_date)));
                $services = Services::find($services->id); 
                if ($services) {
                    $services->update([
                        'service_status' => 'completed',
                        'status' => '1',
                    ]);
                }
            } 
            
            else {
                $dueDate = $request->due_date;
                $customerName = $request->customer_name;
                $standard = $request->standard;
                $serviceType = $request->types_of_services;
                $plannedAuditor = $request->planned_auditor;
                $workItems = json_encode($request->work_items);
                $workLogs = $request->work_logs;
                $amcFrequency = $request->amc_frequency;
                $serviceStatus = $request->service_status;

                DB::table('services')->where('id', $services->id)->update([
                    'customer_name' => $request->customer_name,
                    'amc_frequency' => $request->amc_frequency,
                    'types_of_services' => $request->types_of_services,
                    'due_date' => $request->due_date,
                    'planned_auditor' => $request->planned_auditor,
                    'work_items' =>  json_encode($request->work_items),
                    'service_status' => $request->service_status,
                    'work_logs' => $request->work_logs,
                    'status' => 1
                ]);
            }
        
            if ($serviceStatus === 'completed') {
                DB::table('services')->insert([
                    'customer_name' => $customerName,
                    'types_of_services' => $serviceType,
                    'due_date' => $dueDate,
                    'planned_auditor' => $plannedAuditor,
                    'work_items' => $workItems,
                    'work_logs' => $workLogs,
                    'amc_frequency' => $amcFrequency,
                    'status' => $status,
                    'service_status' => 'planned'
                ]);
            }
        
            DB::commit();
            return response()->redirectTo('/services/list')->with('message', 'Services Updated successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
    }





    public function delete(Services $services)
    {
        try {

            $services_updated = DB::update('UPDATE services SET status = ? WHERE id = ?', ['2', $services->id]);
            
            
            $services = Services::whereNotIn('status', [2])
            ->orderBy('created_at', 'desc')
            ->get();

            $customers = Customers::whereNotIn('status', [2])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('pages.services.list', [
            'services' => $services,
            'customers' => $customers
    ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


}
