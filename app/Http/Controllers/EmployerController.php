<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::orderBy('id', 'desc')->paginate(15);
        return Inertia::render('Admin/Employer/List', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Employer/Create');
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
            'password' => 'required|min:8|max:16|confirmed|string',
        ]);
        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

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
        $data['user'] = User::where('id', $id)->first();
        $data['csrf_token'] = csrf_token();
        return Inertia::render('Admin/Employer/Edit', $data);
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

        if ($request->has('password')) {
            $request->validate([
                'password' => 'required|min:8|max:16|different:current_password|confirmed|string',
            ]);
            $user = User::where('id', $request->id)->first();
            $user->password = Hash::make($request->password);
            $user->save();
        }
        else{
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|max:255',
            ]);
            $user = User::where('id', $request->id)->first();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
        }

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
        User::where('id', $id)->delete();
        return response()->json($return);
    }
}
