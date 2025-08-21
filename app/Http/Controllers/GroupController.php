<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Group;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['groups'] = $this->listing();
        return Inertia::render('Employer/Group/List', $data);
    }

    public function listing(){

        $keywords = request()->keywords;

        $groups = Group::where('employer_id', Auth::user()->id)->orderBy('group_id', 'desc');
       
        if( $keywords ){
            $groups->where('name', 'LIKE', "%$keywords%");
        }

        $groups = $groups->paginate(15);
        return $groups;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Employer/Group/Create');
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
            'description' => 'required|string',
        ]);
        
        $group = new Group;
        $group->name = $request->name;
        $group->description = $request->description;
        $group->employer_id = Auth::user()->id;
        $group->save();

        return response()->json($return);
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
        $data['group'] = Group::where('group_id', $id)->first();
        $data['csrf_token'] = csrf_token();
        return Inertia::render('Employer/Group/Edit', $data);
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
                'description' => 'required|string',
            ]);
            $group = Group::where('group_id', $request->id)->first();
            $group->name = $request->name;
            $group->description = $request->description;
            $group->save();
      
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
        Group::where('group_id', $id)->delete();
        return response()->json($return);
    }
}
