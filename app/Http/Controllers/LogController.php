<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
use App\Models\Log;
use App\Models\Group;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['logs'] = $this->listing();
        $data['groups'] = Group::orderBy('group_id', 'desc')->where('employer_id', Auth::user()->id)->get();
        // dd($data);
        return Inertia::render('Employer/Log/List', $data);
    }
    public function listing(){

        $keywords = request()->keywords;
        $group_id = request()->group_id;
        $date = request()->date;

        $logs = Log::orderBy('log_id', 'desc')->with('employee', function($group){
            $group->with('group');
        })->where('employer_id', Auth::user()->id);
       
        if ( $group_id ) {
            $logs->whereHas('employee.group', function ($query) use ($group_id) {
                $query->where('group_id', $group_id);
            });
        }
        if( $keywords ){
            $logs->whereHas('employee', function ($query) use ($keywords) {
                $query->where('name', 'LIKE', "%$keywords%");
            });
        }
        if( $date ){
            $logs->whereDate('created_at', $date);
        }
        $logs = $logs->paginate(15);
        return $logs;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
