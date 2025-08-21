<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Employee;
use App\Models\Group;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['employees'] = $this->listing();
        //  Employee::where('employer_id', Auth::user()->id)->with('group')->with('activation')->orderBy('employee_id', 'desc')->paginate(15);
        // dd($data['employees']);
        return Inertia::render('Employer/Employee/List', $data);
    }

    public function listing(){

        $keywords = request()->keywords;

        $employees = Employee::where('employer_id', Auth::user()->id)->with('group')->with('activation')->orderBy('employee_id', 'desc');
       
        if( $keywords ){
            $employees->where('name', 'LIKE', "%$keywords%")->where('email', 'LIKE', "%$keywords%");
        }

        $employees = $employees->paginate(15);
        return $employees;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data['groups'] = Group::orderBy('group_id', 'desc')->where('employer_id', Auth::user()->id)->get();
        return Inertia::render('Employer/Employee/Create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $return = array('error' => '0', 'html' => '');
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|max:255',
            'group' => 'required|integer',
            // 'key' => 'required|string',
        ]);
        
        $employee = new Employee;
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->group_id = $request->group;
        $employee->key = uniqid();
        $employee->employer_id = Auth::user()->id;
        $employee->save();
        return response()->json($return);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['groups'] = Group::orderBy('group_id', 'desc')->where('employer_id', Auth::user()->id)->get();
        $data['employee'] = Employee::where('employee_id', $id)->first();
        $data['csrf_token'] = csrf_token();
        return Inertia::render('Employer/Employee/Edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $return = array('error' => '0', 'html' => '');
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|max:255',
                'group' => 'required|integer',
            ]);
            $employee = Employee::where('employee_id', $request->id)->first();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->group_id = $request->group;
            $employee->save();

        return response()->json($return);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $return = array('success' => '1');
        Employee::where('employee_id', $id)->delete();
        return response()->json($return);
    }
}
