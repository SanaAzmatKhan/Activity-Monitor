<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Notifications\DemoRequest;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
        $data['users'] = User::orderBy('id', 'desc')->paginate(15);
        return Inertia::render('Admin/Dashboard', $data);
    }

    public function emp_index(){
        return Inertia::render('Employer/Dashboard');
    }
}
