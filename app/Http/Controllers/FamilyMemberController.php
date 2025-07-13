<?php

namespace App\Http\Controllers;

use App\Models\Family_member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Enum;
use PhpParser\Node\Expr\Empty_;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class FamilyMemberController extends Controller
{

    public function addMember(Request $request)
    {
        $request->validate([
            'Full_Name' => 'required|between:3,30',
            "date_of_birth" => "required|date:Y-m-d",
            'gender' => "required|in:male,female",
            'relation' => 'required',
            'photo' => 'nullable'
        ]);

        if ($request->gender === "male") {
            $gender = 0;
        } else if ($request->gender === "female") {
            $gender = 1;
        }
        // $gender = $request->gender === "male" ? 0 : 1;

        $image = $request->file('photo');
        if ($image) {
            $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put($fileName, file_get_contents($image));
            $url_photo = Storage::url($fileName ?? null);
        } else {
            $url_photo = null;
        }

        $user_id = auth()->user()->id;

        $familyMember = new Family_member();
        $familyMember->user_id = $user_id;
        $familyMember->full_name = $request->Full_Name;
        $familyMember->date_of_birth = $request->date_of_birth;
        $familyMember->gender = $gender;
        $familyMember->relation = $request->relation;
        $familyMember->photo = $url_photo;
        $familyMember->save();

        $data['FamilyMember'] = $familyMember;
        $data['FamilyMember']['age'] = $familyMember->age;


        return response()->json([
            "Data" => $data,
            "Message" => "Member Added Successfuly",
            "Status" => 200
        ]);
    }

    public function getallmember()
    {
        $myid = auth()->user()->id;

        $data = Family_member::query()->where('user_id', $myid)->get();

        if (count($data) <= 0) {
            return response()->json([
                "data" => null,
                "Message" => "Not Found Data",
                "Status" => 404
            ]);
        } else {
            return response()->json([
                "data" => $data,
                "Message" => "This Is All Members",
                "Status" => 200
            ]);
        }
    }
}
