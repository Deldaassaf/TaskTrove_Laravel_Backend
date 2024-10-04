<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicants;
use App\Models\job;
use App\Models\employe;
use Illuminate\Support\Facades\Storage;
use Auth;


class ApplicantsController extends Controller
{
    public function UploadCV(Request $request, $id1) {
        $id = Auth::id();
        $file = new Applicants;
        $check = employe::where('user_id', $id)->first();
        $finalId = $check->id;

        $request->validate([
            'file' => ['required', 'file']
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
            $file->file = $path; 
        }

        $job_id = $id1;
        $employe_id = $finalId;

        $file->job_id = $job_id;
        $file->employe_id = $employe_id;

        $file->save();

        return response()->json(['message' => 'Success, Your CV uploaded successfully.'], 200);
    }





   public function showApplicantsTest($id){
     $findJob=job::find($id);
     $jobId= $findJob->id;
     $showApp=Applicants::where('job_id', $jobId)->get();
     return response($showApp,200);

   }

   public function showMyApplicants(){
    $id =Auth::id();
    $check=employe::where('user_id',$id )->first();
    $finalId=$check->id;
   $check=Applicants::where('employe_id',$finalId)->get();
   return response($check,200);

   }


   public function showApplicants($id) {
    $findJob = job::find($id);
    if (!$findJob) {
        return response(['message' => 'Job not found'], 404);
    }

    $jobSalary = $findJob->jobSalary;
    $jobExperience = $findJob->jobRequirements;

    $applicants = Applicants::where('job_id', $id)->with('employe')->get();

    $filteredApplicants = $applicants->filter(function ($applicant) use ($jobSalary, $jobExperience) {
        $employe = $applicant->employe;
        return $employe->expectedSalary < $jobSalary && $employe->yearsOfExperience >= $jobExperience;
    });

    return response($filteredApplicants, 200);
}


public function showQualifiedApplicants($id)
{
    $findJob = Job::find($id);
    if (!$findJob) {
        return response(['message' => 'Job not found'], 404);
    }

    $jobSalary = $findJob->jobSalary;
    $jobExperience = $findJob->jobExperience;

    $applicants = Applicants::where('job_id', $id)->with('employe')->get();

    $filteredApplicants = $applicants->filter(function ($applicant) use ($jobSalary, $jobExperience) {
        $employe = $applicant->employe;
        return $employe->expectedSalary <= $jobSalary && $employe->yearsOfExperience >= $jobExperience;
    });

    return response($filteredApplicants->values()->all(), 200);
}





}
