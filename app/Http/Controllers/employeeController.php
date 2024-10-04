<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\job;
use App\Models\employe;
use App\Models\numberOfEmployee;
use App\Models\suggested_freind;
use Auth;
use Illuminate\Support\Facades\Storage;


class employeeController extends Controller
{
    public function createEmployeeProfile(Request $request) {
        $AddProfile = new employe;
        $user_id = Auth::id();
        $request->validate([
            'profileImage' => 'required|image|max:2048',
            'employeeName' => 'required',
            'location' => 'required',
            'employeeSpecialization' => 'required',
            'employeeAcademicStatus' => 'required',
            'employeeComunnicationTool' => 'required',
            'expectedSalary' => 'required',
            'yearsOfExperience' => 'required',
        ]);

        if ($request->hasFile('profileImage')) {
            $profileImage = $request->file('profileImage');
            $profileImageName = $profileImage->getClientOriginalName();
            $path = $profileImage->storeAs('public/uploads', $profileImageName);
            $AddProfile->profileImage = Storage::url($path);
        }

        $AddProfile->user_id = $user_id;
        $AddProfile->employeeName = $request->employeeName;
        $AddProfile->location = $request->location;
        $AddProfile->employeeSpecialization = $request->employeeSpecialization;
        $AddProfile->employeeAcademicStatus = $request->employeeAcademicStatus;
        $AddProfile->employeeComunnicationTool = $request->employeeComunnicationTool;
        $AddProfile->expectedSalary = $request->expectedSalary;
        $AddProfile->yearsOfExperience = $request->yearsOfExperience;

        $AddProfile->save();

        if ($AddProfile) {
            $newEm = numberOfEmployee::find(1);
            $newEm->numberOfEmployee = $newEm->numberOfEmployee + 1;
            $newEm->update();

            $addNewSuggestion = new suggested_freind;
            $addNewSuggestion->employe_id = $AddProfile->id;
            $addNewSuggestion->save();
        }

        return response()->json(['message' => 'Your profile created successfully.'], 201);
    }







    public function updateEmployeeProfile(Request $request, $id) {
        $updateProfile = employe::findOrFail($id);
        $user_id = Auth::id();

        $request->validate([
            'profileImage' => 'nullable|image|max:2048',
            'employeeName' => 'required',
            'location' => 'required',
            'employeeSpecialization' => 'required',
            'employeeAcademicStatus' => 'required',
            'employeeComunnicationTool' => 'required',
            'expectedSalary' => 'required',
            'yearsOfExperience' => 'required',
        ]);

        if ($request->hasFile('profileImage')) {
            $profileImage = $request->file('profileImage');
            $profileImageName = $profileImage->getClientOriginalName();
            $path = $profileImage->storeAs('public/uploads', $profileImageName);
            $updateProfile->profileImage = Storage::url($path);
        }

        $updateProfile->user_id = $user_id;
        $updateProfile->employeeName = $request->employeeName;
        $updateProfile->location = $request->location;
        $updateProfile->employeeSpecialization = $request->employeeSpecialization;
        $updateProfile->employeeAcademicStatus = $request->employeeAcademicStatus;
        $updateProfile->employeeComunnicationTool = $request->employeeComunnicationTool;
        $updateProfile->expectedSalary = $request->expectedSalary;
        $updateProfile->yearsOfExperience = $request->yearsOfExperience;

        $updateProfile->save();

        return response()->json(['message' => 'Your profile has been updated successfully.'], 200);
    }


    public function ShowMyPage(){

        $Id=Auth::id();
        $Item=employe::where('user_id',$Id)->first();
        return response($Item, 200);

       }

    public function ShowEmployeeProfile($id){

        $profile=employe::find($id);
        if( $profile){
            return response($profile,200);
        }
        return response()->json(['message'=>'Error,He do not have personal page.'],201);

    }




}
