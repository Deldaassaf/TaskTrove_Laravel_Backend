<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\job;
use App\Models\company;
use App\Models\employe;
use App\Models\portfolio;
use App\Models\depositOperatin;
use App\Models\numberOfJobPosted;
use App\Models\Profit;
use Auth;
use App\Models\categoryCount;
use App\Models\category;
use App\Models\User_Token1;

class JobsController extends Controller
{
    public function AddJob(Request $request ){
        $AddNewJob=new job;
        $id=Auth::id();
        $companyId=company::where('user_id',$id )->first();
        $findId=$companyId->id;
         $company_id=  $findId;
        $request->validate([

            'jobName'=>'required',
            'jobSpecialization'=>'required',
            'jobLocation'=>'required',
            'jobDiscription'=>'required',
            'jobRequirements'=>'required',
            'jobHours'=>'required',
            'jobSalary'=>'required',
            'category'=>'required',
            'jobExperience'=>'required'


        ]);

        $AddNewJob->company_id=$company_id;
        $AddNewJob->jobName=$request->jobName;
        $AddNewJob->jobSpecialization=$request->jobSpecialization;
        $AddNewJob->jobLocation=$request->jobLocation;
        $AddNewJob->category=$request->category;
        $AddNewJob->jobDiscription=$request->jobDiscription;
        $AddNewJob->jobRequirements=$request->jobRequirements;
        $AddNewJob->jobHours=$request->jobHours;
        $AddNewJob->jobSalary =$request->jobSalary;
        $AddNewJob->jobExperience =$request->jobExperience;

        if( $AddNewJob){
            $Deposit=depositOperatin::where('company_id', $findId)->first();
            $newDeposit=$Deposit->existingAmount ;
            if( $newDeposit >= 20){
                $AddNewJob->save();
                $Deposit->existingAmount=$Deposit->existingAmount -20;
                $Deposit->update();
               $profit=Profit::find(1);
               $profit->profits=$profit->profits +20;
               $profit->update();
               $newJob=numberOfJobPosted::find(1);
               $newJob->numberOfJobPosted=$newJob->numberOfJobPosted + 1;
               $newJob->update();
               //categoryCount
               $getCate=category::where('category',$AddNewJob->category)->first();
               $getCateId= $getCate->id;
               $incCount=categoryCount::where('categories_id',$getCateId)->first();
               $incCount->count=$incCount->count + 1 ;
               $incCount->save();

               if( $AddNewJob->save()){
               $getEmployee = employe::where('employeeSpecialization', $AddNewJob->jobSpecialization)
               ->pluck('user_id');
               $token=User_Token1::whereIn('user_id',$getEmployee)->pluck('user_token');

               $SERVER_API_KEY = 'API SERVER KEY';


               $data = [

                   "registration_ids" => [
                    $token
                   ],

                   "notification" => [

                       "title" => 'TeskTrove',

                       "body" => 'New job added ',

                       "sound"=> "default" // required for sound on ios

                   ],

               ];

               $dataString = json_encode($data);

               $headers = [

                   'Authorization: key=' . $SERVER_API_KEY,

                   'Content-Type: application/json',

               ];

               $ch = curl_init();

               curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

               curl_setopt($ch, CURLOPT_POST, true);

               curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

               curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

               curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

               $response = curl_exec($ch);

               }
                return response()->json(['message'=>'The job added successfully.'],201);
            }
            return response()->json(['message'=>'you do not have enough mony in your portfolio.'],200);

        }

    }


    public function ShowAllJobs(){

        $Jobs=job::all();
        return response( $Jobs,200);

    }

    public function ShowJob($id){

        $show=job::find($id);
        return response($show,200);

    }

    public function LookForWork($search){

        $result=job::where('jobLocation','like','%'.$search.'%')
        ->orwhere('jobHours',$search)
        ->get();
        return response($result,200);

   }

   public function showCompanyJobs(){
    $id = Auth::id();
    $getcompany =company::where('user_id', $id)->first();
    $myId=$getcompany->id;
    $getJob=job::where('company_id', $myId)->get();
    return response($getJob,200);

   }


   public function filttering(){
    $id = Auth::id();
    $getEmployee =employe::where('user_id', $id)->first();
    $employeeSpecialization=$getEmployee->employeeSpecialization;
    $filterJobs=job::where('jobSpecialization',$employeeSpecialization)->get();
    return response( $filterJobs,200);

}

}
