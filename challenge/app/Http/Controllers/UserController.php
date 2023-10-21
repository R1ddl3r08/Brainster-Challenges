<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('type', 'regular')->get();

        return response()->json($users);
    }

    public function delete($id)
    {
        $user = User::find($id);

        if(!$user){
            return response()->json(['message' => 'User not found'], 400);
        }

        $user->delete();

        return response()->json(['message' => 'Account deleted successfully'], 200);
    }

    public function deactivate($id)
    {
        $user = User::find($id);

        if(!$user){
            return response()->json(['message' => 'User not found'], 400);
        }

        $user->update(['is_active' => false]);

        return response()->json(['message' => 'User deactivated successfully'], 200);
    }
}
