<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\User;

class UserController extends Controller
{
    public function profilePage()
    {
        $user = Auth::user();

        return view('profile', compact('user'));
    }
    public function allUsers(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            if ($request->ajax()) {
                $data = User::select(['id', 'full_name', 'user_name', 'email', 'mobile_number', 'date_of_birth']);
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($user) {
                        $showButton = $user->id !== $data->id
                            ? '<button type="button" class="showBtn btn btn-warning btn-sm ml-2" data-id="' . $data->id . '">Show</button>'
                            : '';

                        $editButton = '<button type="button" class="editBtn btn btn-primary btn-sm ml-2" data-id="' . $data->id . '">Edit</button>';

                        $deleteButton = $user->id !== $data->id
                            ? '<button type="button" class="deleteBtn btn btn-danger btn-sm ml-2" data-id="' . $data->id . '">Delete</button>'
                            : '';


                        return $showButton . $editButton . $deleteButton;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('users', compact('user'));
        }
        return redirect()->route('profile');
    }

    public function addUser(Request $request)
    {
        if ($request->user_id != null) {
            $userId =  User::find($request->user_id);
            if (!$userId) {
                abort(404);
            }
            $userId->update([
                'full_name' => $request->get('full_name'),
                'user_name' => $request->get('user_name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'mobile_number' => $request->get('mobile_number'),
                'date_of_birth' => $request->get('date_of_birth'),
            ]);
            return response()->json([
                'success' => "User Edited Successfully",
            ], 201); 
        } else {

            $request->validate(
                [
                    'full_name' => 'required|string|max:255',
                    'user_name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:8',
                    'mobile_number' => 'required|string|max:20',
                    'date_of_birth' => 'required|date',
                ]
            );
            User::create([
                'full_name' => $request->get('full_name'),
                'user_name' => $request->get('user_name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'mobile_number' => $request->get('mobile_number'),
                'date_of_birth' => $request->get('date_of_birth'),
            ]);

            return response()->json([
                'success' => "User Added Successfully",
            ], 201);
        }
    }

    public function editUser($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }


    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user -> delete(); 
            return response()->json([
                'success' => 'User Deleted Successfully'
                ] , 201);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}
