<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use App\Models\comment;
use App\Models\employe;
use Auth;
use Illuminate\Support\Facades\Storage;

class postController extends Controller
{
 //POSTS
 public function AddPost(Request $request) {
    $AddNewPost = new Post;
    $id = Auth::id();
    $companyId = Employe::where('user_id', $id)->first();
    $employe_id = $companyId->id;

    $request->validate([
        'Post' => 'required',
        'image' => 'required|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $path = $image->storeAs('public/uploads', $imageName);
        $AddNewPost->image = Storage::url($path);
    }

    $AddNewPost->employe_id = $employe_id;
    $AddNewPost->Post = $request->Post;
    $AddNewPost->save();

    return response()->json(['message' => 'The post added successfully.'], 201);
}


public function showAllPost(){

    $posts=post::all();
    return response($posts,200);

}


public function showPost($id){

    $post=post::find($id);
    return response($post,200);

}

public function showMyposts(){
    $id =Auth::id();
    $check=employe::where('user_id',$id )->first();
    $finalId=$check->id;
    $check=post::where('employe_id',$finalId)->get();
    return response($check,200);

    }

    public function deleteMyPost($id1){
        $id =Auth::id();
        $check=employe::where('user_id',$id )->first();
        $finalId=$check->id;
        $postD=post::find($id1);
        if($finalId = $postD->employe_id){
            $postD->delete();
        }
        return response()->json(['message'=>'Your post deleted successfully.'],200);
    }



//COMMENTS

public function AddComment(Request $request,$id1 ){

    $id =Auth::id();
    $check=employe::where('user_id',$id )->first();
    $finalId=$check->id;
    $AddComment=new comment;
     $employe_id= $finalId;
     $post_id= $id1;
    $request->validate([
        'comment'=>'required'
    ]);

    $AddComment->employe_id=$employe_id;
    $AddComment->post_id=$post_id;
    $AddComment->comment=$request->comment;

    $AddComment->save();
    return response()->json(['message'=>'Your comment added successfully.'],201);

}

public function deleteComment($id ){
    $id1 =Auth::id();
    $check=employe::where('user_id',$id1 )->first();
    $finalId=$check->id;
    $deleteComment=comment::find($id);
    $employeeId=$deleteComment->employe_id;
    if( $finalId == $employeeId){
        $deleteComment->delete();
        return response()->json(['message'=>'Your comment deleted successfully.'],200);
    }
    else{
        return response()->json(['message'=>'Sorry , you can not delete this comment .'],200);
    }



}


public function showComments($id){

    $comment=comment::where('post_id',$id)->get();
    return response($comment,200);

}


public function showThisEmployeePost($Id){

    $employee=employe::find($Id);
    $employee_id=$employee->id;
    $employeePost=post::where('employe_id',$employee_id)->get();
    return response($employeePost);
}



}
