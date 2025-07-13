<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\userregister;
use App\Models\balance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class authcontroller extends Controller
{
    public function register(Request $request)
    {
        $data = [];
        $request->validate([
            "Firstname" => 'required|between:3,9',
            "Lastname" => 'required|between:3,9',
            "photo" => "nullable",
            "gender" => 'required|in:male,female',
            "date_of_birth" => "required|date:Y-m-d", #....
            "email" => 'required|unique:users,email|email',
            "password" => "required|between:8,16|confirmed"
        ]);


        $image = $request->file('photo');
        if ($image) {
            $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
            // حفظ الصورة في مجلد التخزين (Storage) الذي تحدده
            Storage::disk('public')->put($fileName, file_get_contents($image));
            $url_photo = Storage::url($fileName ?? null);
        } else {
            $url_photo = null;
        }

        if ($request->gender === "male") {
            $gender = 0;
        } else if ($request->gender === "female") {
            $gender = 1;
        }
        //return $image;
        // توليد اسم عشوائي للصورة

        $user = new User();
        $user->first_name = $request->Firstname;
        $user->last_name = $request->Lastname;
        $user->photo = $url_photo;
        $user->gender = $gender;
        $user->email = $request->email;
        $user->date_of_birth = $request->date_of_birth;
        $user->password = Hash::make($request->password);
        $user->save();

        $UserInfo = User::where('email', $request->email)->first();

        $token = $UserInfo->createToken('Register Token')->plainTextToken;

        $data['user'] = $user;
        $data['user']['age'] = $user->age;
        $data['token'] = $token;

        // Mail::to('ahmdmrwan47@gmail.com')->send(new userregister($UserInfo));

        return response()->json([
            "message" => "seccefull Rigisetered",
            'Data' => $data,
            'status' => 201
        ]);
    }
    public function login(Request $request)
    {
        $request->validate([
            "email" => 'required|email',
            "password" => 'required'
        ]);

        $data = [];
        if (!auth()->attempt($request->only(['email', 'password']))) {
            return response()->json([
                'Data' => [],
                'Massage' => 'The email or password is Not Correct please try again',
                'status' => 500
            ], 500);
        }
        $info = User::where('email', $request->email)->first();
        $token = $info->createToken("auth_token")->plainTextToken;
        return response()->json([
            'Data' => $info,
            'token' => $token,
            'message' => 'login succesfuly',
            'status' => 200
        ]);
    }


    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        return response()->json([
            'data' => [],
            'Massage' => 'you logging out',
            'satatus' => 200
        ]);
    }
}
