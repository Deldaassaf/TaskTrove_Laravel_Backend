<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\portfolio;
use App\Models\depositOperatin;
use App\Models\company;
use Auth;

class portfolioController extends Controller
{
    public function Addoperation(Request $request){

       $Deposit=new portfolio;
       $id=Auth::id();
       $companyId=company::where('user_id',$id )->first();
       $findId=$companyId->id;
       $portfolio=depositOperatin::where('company_id',$findId)->first();
       $portfolio_id=$portfolio->id;
       $request->validate([

        'amount'=>'required',
        'operationType'=>'required',
        'cardId'=>'',
        'expirationDate'=>'',
        'CVVcode'=>'',
        'cardUser'=>'',
        'bankName'=>'',
        'accountId'=>'',
        'transferDate'=>''

    ]);
    $allAmount=$request->amount;
    $Deposit->amount=$request->amount;
    $Deposit->depositOperation_id=$portfolio_id;
    $Deposit->operationType=$request->operationType;
    $Deposit->cardId=$request->cardId;
    $Deposit->expirationDate=$request->expirationDate;
    $Deposit->CVVcode=$request->CVVcode;
    $Deposit->cardUser=$request->cardUser;
    $Deposit->bankName=$request->bankName;
    $Deposit->accountId =$request->accountId;
    $Deposit->transferDate =$request->transferDate;
    if($Deposit){
        if($Deposit->operationType == "withdrawal"){
        if( $Deposit->amount > $portfolio->existingAmount){
            return response()->json(['message'=>'You can not withdrawal because
            you do not have this amount in your portfolio.'],200);
        }
        else{
            $portfolio->existingAmount=$portfolio->existingAmount - $allAmount;
            $portfolio->update();
            $Deposit->save();
            return response()->json(['message'=>'The withdrawal was successful.'],201);
        }

    }
    else{
        $portfolio->existingAmount=$portfolio->existingAmount + $allAmount;
        $portfolio->update();
        $Deposit->save();
        return response()->json(['message'=>'The deposit was successful.'],201);
    }
}


    }


     public function showMyPortfolio(){

        $id=Auth::id();
        $companyId=company::where('user_id',$id )->first();
        $findId=$companyId->id;
        $portfolio=depositOperatin::where('company_id', $findId)->first();
        return response($portfolio,200);
     }

     public function showMyOperation(){

        $id=Auth::id();
        $companyId=company::where('user_id',$id )->first();
        $findId=$companyId->id;
        $portfolio=depositOperatin::where('company_id', $findId)->first();
        $portfolio_id=$portfolio->id;
        $allperation=portfolio::where( 'depositOperation_id',$portfolio_id)->get();
        return response($allperation,200);

     }


}

