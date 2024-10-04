<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\cv;
use App\Models\employe;
use Auth;


class createCVController extends Controller
{
    public function createCV(Request $request){
        $createCV=new cv;
        $id=Auth::id();
        $companyId=employe::where('user_id',$id )->first();
        $findId=$companyId->id;
        $request->validate([

            'name'=>'required',
            'university'=>'required',
            'mobileNumber'=>'required',
            'email'=>'required',
            'location'=>'required',
            'DateOfBirth'=>'required',
            'Nationality'=>'required',
            'UniversityStartDate'=>'required',
            'UniversityEndDate'=>'required',
            'RecommendationLetter'=>'required',
            'language1'=>'required',
            'language2'=>'',
            'language3'=>'',
            'tecnicalSkills1'=>'required',
            'tecnicalSkills2'=>'',
            'tecnicalSkills3'=>'',
            'softSkill1'=>'required',
            'softSkill2'=>'',
            'softSkill3'=>'',
            'interests1'=>'required',
            'interests2'=>'',
            'courses1'=>'required',
            'courses2'=>'',
            'courses3'=>'',
            'AboutYou'=>'required',
            'educations'=>'required',
            'specialization'=>'required',

        ]);

        $createCV->employe_id=$findId;
        $createCV->name=$request->name;
        $createCV->university=$request->university;
        $createCV->mobileNumber=$request->mobileNumber;
        $createCV->email=$request->email;
        $createCV->location=$request->location;
        $createCV->DateOfBirth=$request->DateOfBirth;
        $createCV->Nationality=$request->Nationality;
        $createCV->UniversityStartDate =$request->UniversityStartDate;
        $createCV->UniversityEndDate =$request->UniversityEndDate;
        $createCV->RecommendationLetter =$request->RecommendationLetter;
        $createCV->language1 =$request->language1;
        $createCV->language2 =$request->language2;
        $createCV->language3 =$request->language3;
        $createCV->tecnicalSkills1 =$request->tecnicalSkills1;
        $createCV->tecnicalSkills2 =$request->tecnicalSkills2;
        $createCV->tecnicalSkills3 =$request->tecnicalSkills3;
        $createCV->softSkill1 =$request->softSkill1;
        $createCV->softSkill2 =$request->softSkill2;
        $createCV->softSkill3 =$request->softSkill3;
        $createCV->interests1 =$request->interests1;
        $createCV->interests2 =$request->interests2;
        $createCV->courses1 =$request->courses1;
        $createCV->courses2 =$request->courses2;
        $createCV->courses3 =$request->courses3;
        $createCV->AboutYou =$request->AboutYou;
        $createCV->educations =$request->educations;
        $createCV->specialization =$request->specialization;


        $createCV->save();
        return response()->json(['message'=>'Your CV created successfully.'],201);
    }


    public function ShowThisCV($id){

        $show=cv::find($id)->get();
        return response($show);

    }

    public function ShowAllCV(){
        $id=Auth::id();
        $companyId=employe::where('user_id',$id )->first();
        $findId=$companyId->id;
        $showAll=cv::where('employe_id',$findId)->get();
        return response($showAll);

    }




}
