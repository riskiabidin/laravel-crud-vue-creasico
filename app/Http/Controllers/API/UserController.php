<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public function dashboard()
    {
        $user = Auth::User();
        $result = [
            'data' => $user,
            'code' => 200,
            'message' => 'dashboard successfully!',
        ];

        return response()->json($result);
    }
    public function index()
    {
        $users = User::all();
        $result = [
            'data' => $users,
            'code' => 200,
            'message' => 'listing users successfully!',
        ];

        return response()->json($result);
    }
    function create()
    {
        return view('usuarios.create');
    }

    function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'type' => 'required',
        ]);
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'type' => $request['type'],
        ]);

        $result = [
            'data' => $user,
            'code' => 200,
            'message' => 'inserted user successfully!',
        ];

        return response()->json($result);
    }

    function show($id)
    {
        $user = User::findOrFail($id);
        $result = [
            'data' => $user,
            'code' => 200,
            'message' => 'load data user successfully!',
        ];
        return response()->json($result);
    }

    function edit($id)
    {
        $user = User::findOrFail($id);
        $result = [
            'data' => $user,
            'code' => 200,
            'message' => 'load data user successfully!',
        ];
        return response()->json($result);
    }

    function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if (!empty($request->password)) {
            $request->merge(['password' => Hash::make($request['password'])]);
        }
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'type' => 'required',
        ]);
        $user->update($request->all());
        $result = [
            'data' => $user,
            'code' => 200,
            'message' => 'updated user successfully!',
        ];

        return response()->json($result);
    }

    function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $result = [
            'data' => $user,
            'code' => 200,
            'message' => 'deleted user successfully!',
        ];
        return response()->json($result);
    }
}
