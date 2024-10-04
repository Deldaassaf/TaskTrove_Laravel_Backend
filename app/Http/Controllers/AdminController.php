<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\numberOfCompany;
use App\Models\admin;
use App\Models\numberOfJobPosted;
use App\Models\Profit;
use App\Models\numberOfEmployee;
use Auth;
use App\Models\Password;


class AdminController extends Controller
{
    public function validatePassword(Request $request)
    {

   $request->validate([
    'password' => 'required|string'
]);

$password = Password::first();

if (password_verify($request->password, $password->password)) {
    return response()->json([
        'success' => true,
        'message' => 'Password is correct!'
    ], 200);
} else {
    return response()->json([
        'success' => false,
        'message' => 'Incorrect password. Please try again.'
    ], 401);
}
    }
    public function showProfitReports(){
        $Profit=Profit::first();
        return response( $Profit);

    }

    public function showJobReports(){
        $numberOfJobPosted=numberOfJobPosted::first();
        return response( $numberOfJobPosted);
    }

    public function showCoReports(){
        $numberOfCompany=numberOfCompany::first();
        return response( $numberOfCompany);
    }

    public function showEmReports(){
        $numberOfEmployee=numberOfEmployee::first();
        return response( $numberOfEmployee);
    }




}
