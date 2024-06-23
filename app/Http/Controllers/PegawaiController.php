<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::get();
            return response()->json(['data' => $data]);
        }
        return view('Admin.view');
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json(['data' => $user]);
        }
        return response()->json(['message' => 'User not found'], 404);
    }


    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json(['data' => $user, 'message' => 'User created successfully']);
    }

    // Update user details
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->update($request->all());
            return response()->json(['data' => $user, 'message' => 'User updated successfully']);
        }
        return response()->json(['message' => 'User not found'], 404);
    }


    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully']);
        }
        return response()->json(['message' => 'User not found'], 404);
    }
}
