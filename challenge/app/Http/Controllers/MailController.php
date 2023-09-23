<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyEmail;
use App\Models\Request as RequestModel;
use App\Http\Requests\StudentRequest;

class MailController extends Controller
{
    public function send(StudentRequest $request)
    {
        $validatedData = $request->validated();
        RequestModel::create($validatedData);

        $email = $request->input('email');
        $phone = $request->input('phone');
        $company = $request->input('company');

        Mail::to($email)->send(new MyEmail($email, $phone, $company));

        return redirect()->route('homepage')->with('success', 'You request has been successfully sent');
    }
}
