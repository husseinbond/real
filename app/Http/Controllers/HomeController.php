<?php

namespace App\Http\Controllers;
use App\Events\StatusLiked;
use App\Events\chat;
use Illuminate\Http\Request;
use auth;
use App\posts;
use App\comment;
use App\notificationcomments;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

public function fff($id){
    
    event(new chat('hi',$id));
}
public function comments(request $request){
  
  
    

  
    
    $save = new comment;
    $save->content = $request->post_content;
    $save->user_id = Auth::id();
    $save->post_id = $request->post_id;

    $save->save();

  $find = posts::where('id',$request->post_id)->get()->first();
    
$searchin = notificationcomments::where('sender_id',Auth::id())->where('to_user_id',$find->user_id)->get()->first();
      
if($searchin !== null){




    $searchin->comment_id = $save->id;

    $searchin->read = false;
  
    $searchin->save();




}else{

if($find->user_id !== auth::id()){
    $ntf = new  notificationcomments;
    $ntf->sender_id = Auth::id();
    $ntf->post_id = $request->post_id;
    $ntf->to_user_id = $find->user_id;
    $ntf->comment_id = $save->id;
    $ntf->read = false;
    $ntf->save();

}
}
   
    $user_id = $find->user_id;
    
event(new StatusLiked($user_id));     
            
    
    
    
    
    
    
    
    }


public function getcomment(){
    return view('comment');
}

public function getData(){
$data = posts::with('comment')->get();

    return response()->json($data);
}




}
