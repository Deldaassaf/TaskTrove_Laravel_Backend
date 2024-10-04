<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\company;
use App\Models\depositOperatin;
use App\Models\numberOfCompany;
use Auth;
use Illuminate\Support\Facades\Storage;
class companyController extends Controller
{
    public function createCompanyProfile(Request $request) {
        $AddProfile = new company;
        $user_id = Auth::id();
        $request->validate([
            'profileImage' => 'required|image|max:2048',
            'companyName' => 'required',
            'companyAbout' => 'required',
            'companyLocation' => 'required',
            'NumberOfEmployees' => 'required',
        ]);

        if ($request->hasFile('profileImage')) {
            $profileImage = $request->file('profileImage');
            $profileImageName = $profileImage->getClientOriginalName();
            $path = $profileImage->storeAs('public/uploads', $profileImageName);
            $profileImageUrl = Storage::url($path);
            $AddProfile->profileImage = $profileImageUrl;
        }

        $AddProfile->user_id = $user_id;
        $AddProfile->companyName = $request->companyName;
        $AddProfile->companyAbout = $request->companyAbout;
        $AddProfile->companyLocation = $request->companyLocation;
        $AddProfile->NumberOfEmployees = $request->NumberOfEmployees;

        $AddProfile->save();

        if ($AddProfile) {
            $createPortfolio = new depositOperatin;
            $createPortfolio->existingAmount = 0;
            $createPortfolio->company_id = $AddProfile->id;
            $createPortfolio->save();

            $newCo = numberOfCompany::find(1);
            $newCo->numberOfCompany = $newCo->numberOfCompany + 1;
            $newCo->update();

            return response()->json([
                'message' => 'Your profile created successfully.'
            ], 201);
        }
    }


    public function updateProfile(Request $request){

        $user_id=Auth::id();
        $UpdateProfile=company::where('user_id',$user_id)->first();

       $request->validate([
           'companyName'=>'required',
           'companyAbout'=>'required',
           'companyLocation'=>'required',
           'NumberOfEmployees'=>'required',
       ]);

       if($request->hasFile('profileImage')){
        $files=Storage::disk('public')->put('/',$request->file('profileImage'));
     }
       else{
        unset($UpdateProfile['profileImage']);
       }
       $UpdateProfile->user_id=$user_id;
       $UpdateProfile->profileImage=$request->profileImage;
       $UpdateProfile->companyName=$request->companyName;
       $UpdateProfile->companyAbout=$request->companyAbout;
       $UpdateProfile->companyLocation=$request->companyLocation;
       $UpdateProfile->NumberOfEmployees=$request->NumberOfEmployees;


       $UpdateProfile->update();
       return response()->json(['message'=>'Your profile updated successfully.'],201);

    }


    public function ShowMyPage(){

     $Id=Auth::id();
     $Item=company::where('user_id',$Id)->get();
     return response($Item, 200);

    }


    public function ShowCompanyProfile($id){

       $profile=company::find($id);
       if( $profile){
        return response($profile,200);
       }

       return response()->json(['message'=>'Error, It do not have account .'],201);
    }



    public function checkProfile()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $hasProfile = $user->company()->exists(); // يفترض أن للمستخدم علاقة profile

        return response()->json(['hasProfile' => $hasProfile]);
    }


    public function AllCompany(){
        $showAllCompany=company::all();
        return responce( $showAllCompany);
    }

}
