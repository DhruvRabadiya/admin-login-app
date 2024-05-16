<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\signupFormRequest;
use App\Models\User;

class SignupController extends Controller
{
    public function signupPage()
    {
        return view('signup ');
    }

    public function storeData(signupFormRequest $request)
    {
        $data = new User;
        $data->full_name = $request->fullName;
        $data->user_name = $request->userName;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->mobile_number = $request->mobileNumber;
        $data->date_of_birth = $request->DateOfBirth;
        echo $data->save();


        return back()->with('success' , 'form submitted successfully');
    }
}
