<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Workitems;
use App\Models\Teams;

use Illuminate\Support\Facades\Session;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class WorkitemsController extends Controller
{

    public function index()
    {
                $workitems = Workitems::whereNotIn('status', [2])
                ->orderBy('created_at', 'desc')
                ->get();

                $teams = Teams::whereNotIn('status', [2])
                ->orderBy('created_at', 'desc')
                ->get();

        return view('pages.workitems.list', [
            'workitems' => $workitems,
            'teams' => $teams,
        ]);
    }


    public function create()
    {
       
        $teams = Teams::whereNotIn('status', [2])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('pages.workitems.add', [
            'teams' => $teams,       
         ]);
  
    }


    public function store(Request $request, Workitems $workitems)
    {

        
        try {

            $workitems = Workitems::create([
                'work_item_name'    => $request->work_item_name,
                'assign_to'    => $request->assign_to,
                'start_date'    => $request->start_date,
                'end_date'    => $request->end_date,
                'description'    => $request->description,
                'status'        => '1'
            ]);

            
        return response()->redirectTo('/workitems/list')->with('message', 'Workitems created successfully');

            // return view('pages.workitems.list',['message' => 'Workitems Created Sucessfully','workitems'=>$workitems]);


        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }



    public function edit(Workitems $workitems)
    {

        return view('pages.workitems.edit')->with([
            'workitems'  => $workitems
        ]);
    }



    public function update(Request $request, Workitems $workitems)
    {
    

        DB::beginTransaction();
        try {

            // Store Data
            $workitems_updated = Workitems::whereId($workitems->id)->update([
                'work_item_name'    => $request->work_item_name,
                'assign_to'    => $request->assign_to,
                'start_date'    => $request->start_date,
                'end_date'    => $request->end_date,
                'description'    => $request->description,
                'status'        => '1'
            ]);

            DB::commit();


            return response()->redirectTo('/workitems/list')->with('message', 'Workitems Updated successfully');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }





    public function delete(Workitems $workitems)
    {
        try {
            $workitems_updated = Workitems::whereId($workitems->id)->update([
                'status'        => '2'
            ]);
            
            $workitems = Workitems::whereNotIn('status', [2])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('pages.workitems.list', ['workitems' => $workitems]);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }





    public function filterWorkitems(Request $request)
{
    $fromDate = $request->input('fromDate');
    $toDate = $request->input('toDate');
    $teamName = $request->input('assign_to');

    $workitemsQuery = Workitems::whereNotIn('status', [2]);

    if ($fromDate && $toDate) {
        $workitemsQuery->whereBetween('created_at', [$fromDate, $toDate]);
    }

    if ($teamName) {
        $workitemsQuery->where('assign_to', $teamName);
    }

    $workitems = $workitemsQuery->orderBy('created_at', 'desc')->get();

    $teams = Teams::whereNotIn('status', [2])->orderBy('created_at', 'desc')->get();

    return view('pages.workitems.list', [
        'teams' => $teams,
        'workitems' => $workitems
    ]);
}



}
