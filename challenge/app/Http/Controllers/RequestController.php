<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Request as RequestModel;
use App\Http\Requests\StudentRequest;

class RequestController extends Controller
{
    public function store(StudentRequest $request)
    {
        $validatedData = $request->validated();

        RequestModel::create($validatedData);

        return redirect()->route('homepage')->with('success', 'Student added successfully');
    }
}
