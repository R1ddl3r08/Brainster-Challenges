<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $action = 'add';
        return view('adminDashboard', compact('action'));
    }

    public function edit()
    {
        $action = 'edit';
        $projects = Project::get();

        return view('adminDashboard', compact('action', 'projects'));
    }
}
