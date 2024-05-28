<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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

                        $editButton = '<button type="button" class="editBtn btn btn-primary btn-sm ml-2" data-id="' . $data->id . '">Edit</button>';

                        $deleteButton = $user->id !== $data->id
                            ? '<button type="button" class="deleteBtn btn btn-danger btn-sm ml-2" data-id="' . $data->id . '">Delete</button>'
                            : '';


                        return  $editButton . $deleteButton;
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
            $user = User::find($request->user_id);
            if (!$user) {
                abort(404);
            }

            $data = $request->only(['full_name', 'user_name', 'email', 'mobile_number', 'date_of_birth']);
            // Don't update the password if it's not provided
            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->password);
            }

            $user->update($data);
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
            $user->delete();
            return response()->json([
                'success' => 'User Deleted Successfully'
            ], 201);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = User::find($request->user_id);

        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['errors' => ['old_password' => ['Old password does not match']]], 422);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['success' => 'Password changed successfully']);
    }
}
