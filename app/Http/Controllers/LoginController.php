<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\loginFormRequest;
use App\Models\User;

class LoginController extends Controller
{
    public function loginPage()
    {
        return view('login');
    }

    public function storeData(loginFormRequest $request)
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
