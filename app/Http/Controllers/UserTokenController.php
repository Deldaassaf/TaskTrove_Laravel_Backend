<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User_Token1;

class UserTokenController extends Controller
{
   public function storeToken(Request $request){
    $addToken=new User_Token1;
   $user_id=Auth::id();
   $request->validate([
    'user_token'=>'required'
    ]);
    $addToken->user_id=$user_id;
    $addToken->user_token=$request->user_token;
    $addToken->save();
    return response()->json(['message'=>'your token added succesfully.'],200);
   }
}
