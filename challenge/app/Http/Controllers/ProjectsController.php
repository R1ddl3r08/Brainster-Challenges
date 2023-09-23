<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Requests\ProjectRequest;

class ProjectsController extends Controller
{
    public function index()
    {
        $allProjects = Project::get();

        return view('homepage', ['allProjects' => $allProjects]);
    }

    public function create(ProjectRequest $request)
    {
        $validatedData = $request->validated();

        Project::create($validatedData);

        return redirect()->route('admin.dashboard')->with('success', 'Project created successfully');
    }

    public function edit(ProjectRequest $request)
    {
        $project = Project::find($request->input('projectId'));

        if (!$project) {
            return redirect()->route('edit.product')->with('error', 'Project not found');
        }

        $validatedData = $request->validated();

        $project->update($validatedData);

        return redirect()->route('edit.product')->with('success', 'Project updated successfully');
    }

    public function delete(Request $request)
    {
        $projectId = $request->input('projectId');

        $project = Project::find($projectId);

        if (!$project) {
            return redirect()->route('edit.product')->with('error', 'Project not found');
        }
    
        $project->delete();

        return redirect()->route('edit.product')->with('success', 'Project deleted successfully');
    }
}
