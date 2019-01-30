<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Data found!',
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data not found!',
                'data' => ''
            ], 404);
        }
    }

    public function showAll()
    {
        $user = User::all();

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Data found!',
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data not found!',
                'data' => ''
            ], 404);
        }
    }
    
}
