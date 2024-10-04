<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResetCodePassword;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCodeResetPassword;
use App\Models\User;
use Illuminate\Http\JsonResponse;


class ForgotPasswordController extends Controller
{

    public function ForgetPassword(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        // حذف كل الأكواد القديمة التي أرسلها المستخدم من قبل
        ResetCodePassword::where('email', $request->email)->delete();

        // إنشاء كود عشوائي جديد
        $data['code'] = mt_rand(10000, 99999);

        // حفظ الكود الجديد
        $codeData = ResetCodePassword::create($data);

        // إرسال البريد الإلكتروني للمستخدم
        Mail::to($request->email)->send(new SendCodeResetPassword($codeData->code));

        // إعادة استجابة JSON تحتوي على رسالة النجاح
        return response()->json(['message' => trans('passwords.sent')], 200);
    }



    public function userCheckCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:reset_code_passwords',
        ]);

        // find the code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);


        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response(['message' => trans('passwords.code_is_expire')], 422);
        }

        return response([
            'code' => $passwordReset->code,
            'message' => trans('passwords.code_is_valid')
        ], 200);
    }

    public function userResetPassword(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:reset_code_passwords',
            'password' => 'required|string|min:6',
        ]);

        // find the code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response(['message' => trans('passwords.code_is_expire')], 422);
        }

        // find user's email
        $user = User::firstWhere('email', $passwordReset->email);

        // update user password
        $user->update($request->only('password'));

        // delete current code
        $passwordReset->delete();

        return response(['message' =>'password has been successfully reset'], 200);
    }
}
