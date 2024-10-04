<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\job;
use App\Models\categoryCount;

class categoryController extends Controller
{

    public function AddCategory(Request $request){

    $AddCtegory=new category;
   $request->validate([
       'category'=>'required',

   ]);

   $AddCtegory->category=$request->category;

   if( $AddCtegory){
    $AddCtegory->save();
    $numOfCategory=new categoryCount;
    $numOfCategory->count=0;
    $numOfCategory->categories_id=$AddCtegory->id;
    $numOfCategory->save();
    return response()->json(['message'=>'The category added successfully.'],201);
   }


    }

    public function ShowCategorys(){

     $categorys=category::all();
     return response($categorys);

    }


    public function ViewJobByCategory($id){

        $findC=category::find($id);
        $category=$findC->category;
        $jobs=job::where('category',$category)->get();
        return response($jobs);

       }

       public function categoryContent($id){
           $showCount=categoryCount::where('categories_id',$id)->first();
           return response($showCount);
       }



}
