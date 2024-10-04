<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\companyController;
use App\Http\Controllers\employeeController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\createCVController;
use App\Http\Controllers\postController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApplicantsController;
use App\Http\Controllers\portfolioController;
use App\Http\Controllers\defaultValueController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\FreindController;
use App\Http\Controllers\UserTokenController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
});





//DefaultValue
Route::get('defaultValue', [defaultValueController::class, 'defaultValue']);

Route::post('password/email',  [ForgotPasswordController::class,'ForgetPassword']);
Route::post('password/code/check',[ForgotPasswordController::class,'userCheckCode']);
Route::post('password/reset', [ForgotPasswordController::class,'userResetPassword']);

Route::middleware(['jwt.verify'])->group(function () {
//COMPANY
Route::post('CreatCProfile', [companyController::class, 'createCompanyProfile']);
Route::get('ShowMyPageC', [companyController::class, 'ShowMyPage']);
Route::get('ShowCompanyProfile/{id}', [companyController::class, 'ShowCompanyProfile']);
Route::get('showCompanyJobs', [JobsController::class, 'showCompanyJobs']);
Route::put('updateCProfile', [companyController::class, 'updateProfile']);
Route::get('check-profile', [companyController::class, 'checkProfile']);
Route::get('AllCompany', [companyController::class, 'AllCompany']);

//EMPLOYEE
Route::post('CreatEProfile', [employeeController::class, 'createEmployeeProfile']);
Route::get('ShowMyPageE', [employeeController::class, 'ShowMyPage']);
Route::get('ShowEmployeeProfile/{id}', [employeeController::class, 'ShowEmployeeProfile']);
Route::put('updateEProfile', [employeeController::class, 'updateEmployeeProfile']);


//FREINDS
Route::post('followFreind/{id}', [FreindController::class, 'followFreind']);
Route::get('myFreind', [FreindController::class, 'myFreind']);
Route::get('followBack', [FreindController::class, 'followBack']);
Route::get('followMe', [FreindController::class, 'followMe']);

//CATEGORY
Route::post('AddCategory', [categoryController::class, 'AddCategory']);
Route::get('ShowCategorys', [categoryController::class, 'ShowCategorys']);
Route::get('ViewJobByCategory/{id}', [categoryController::class, 'ViewJobByCategory']);
Route::get('categoryContent/{id}', [categoryController::class, 'categoryContent']);

//JOBS

Route::post('AddJob', [JobsController::class, 'AddJob']);
Route::get('ShowAllJobs', [JobsController::class, 'ShowAllJobs']);
Route::get('ShowJob/{id}', [JobsController::class, 'ShowJob']);
Route::get('SearchForJob/{search}', [JobsController::class, 'LookForWork']);
Route::get('filttering', [JobsController::class, 'filttering']);


//CV
Route::post('createCV', [createCVController::class, 'createCV']);
Route::get('ShowThisCV/{id}', [createCVController::class, 'ShowThisCV']);
Route::get('ShowAllCV', [createCVController::class, 'ShowAllCV']);


//POSTS
Route::post('AddPost', [postController::class, 'AddPost']);
Route::get('showPost/{id}', [postController::class, 'showPost']);
Route::get('showAllPost', [postController::class, 'showAllPost']);
Route::get('showMyposts', [postController::class, 'showMyposts']);
Route::get('deleteMyPost/{id1}', [postController::class, 'deleteMyPost']);
Route::get('showThisEmployeePost/{id}', [postController::class, 'showThisEmployeePost']);

//COMMENTS
Route::post('AddComment/{id1}', [postController::class, 'AddComment']);
Route::delete('deleteComment/{id1}', [postController::class, 'deleteComment']);
Route::get('showComments/{id}', [postController::class, 'showComments']);

//Applicants
Route::post('UploadCV/{id1}', [ApplicantsController::class, 'UploadCV']);
Route::get('showApplicants/{id}', [ApplicantsController::class, 'showQualifiedApplicants']);
Route::get('showMyApplicants', [ApplicantsController::class, 'showMyApplicants']);

//PORTFOLIO
Route::post('Addoperation', [portfolioController::class, 'Addoperation']);
Route::get('showMyPortfolio', [portfolioController::class, 'showMyPortfolio']);
Route::get('showMyOperation', [portfolioController::class, 'showMyOperation']);




//Admin
Route::post('validatePassword', [AdminController::class, 'validatePassword']);
Route::get('showProfitReports', [AdminController::class, 'showProfitReports']);
Route::get('showJobReports', [AdminController::class, 'showJobReports']);
Route::get('showCoReports', [AdminController::class, 'showCoReports']);
Route::get('showEmReports', [AdminController::class, 'showEmReports']);

//TOKEN
Route::post('storeToken', [UserTokenController::class, 'storeToken']);



});




