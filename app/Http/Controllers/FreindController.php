<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\employe;
use App\Models\freind;
use App\Models\suggested_freind;
use App\Models\User_Token1;

class FreindController extends Controller
{
    public function followFreind($freind_id){
     $makeFreinds=new freind;
     $user_id=Auth::id();
     $employee=employe::where('user_id',$user_id)->first();
     $employee_id=$employee->id;
     $makeFreinds->employe_id= $employee_id;
     $makeFreinds->suggested_freind_id=$freind_id;
     $makeFreinds->save();
     if($makeFreinds->save()){

            $getEmployee = employe::where('id', $freind_id)
            ->pluck('user_id');
            $token=User_Token1::where('user_id',$getEmployee)->pluck('user_token');
            if( $token){
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

            
     }
     return response()->json(['message'=>'you are followed succesfully.'],200);

    }




        public function myFreind(){
            $user_id = Auth::id();
            $employee = employe::where('user_id', $user_id)->first();
            $employee_id = $employee->id;

            $myFollowedFriends = freind::where('employe_id', $employee_id)->pluck('suggested_freind_id')->all();

            $friendsWhoFollowYou = freind::whereIn('suggested_freind_id', [$employee_id])->pluck('employe_id')->all();

            $mutualFriends = array_unique(array_merge($myFollowedFriends, $friendsWhoFollowYou));

            $mutualFriendsData = employe::whereIn('id', $mutualFriends)->get();

            return response($mutualFriendsData, 200);
        }

        public function followBack(){
            $user_id = Auth::id();
            $employee = employe::where('user_id', $user_id)->first();
            $employee_id = $employee->id;

            $iFollow = freind::where('employe_id', $employee_id)->pluck('suggested_freind_id');

            $backFollow = freind::whereIn('employe_id', $iFollow)
                                ->where('suggested_freind_id', $employee_id)
                                ->pluck('employe_id');

            $mutualFriends = employe::whereIn('id', $backFollow)->get();
            return response()->json($mutualFriends, 200);
        }

        public function followMe(){

            $user_id = Auth::id();
            $employee = employe::where('user_id', $user_id)->first();
            $employee_id = $employee->id;

            $backFollow = freind::where('suggested_freind_id', $employee_id)
                                ->pluck('employe_id');

            $mutualFriends = employe::whereIn('id', $backFollow)->get();

            return response()->json($mutualFriends, 200);
        }







    }


