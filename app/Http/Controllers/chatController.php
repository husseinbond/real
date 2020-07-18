<?php

namespace App\Http\Controllers;
use Auth;
use App\Message;
use App\Events\chat;
use App\User;
use App\Messagenotification;
use Illuminate\Http\Request;
use DB;
class chatController extends Controller
{

 


    public function get()
    {
        // get all users except the authenticated one
        $contacts = User::where('id', '!=', auth()->id())->get();

        // get a collection of items where sender_id is the user who sent us a message
        // and messages_count is the number of unread messages we have from him
        $unreadIds = Message::select(\DB::raw('`from_user_id` as sender_id, count(`from_user_id`) as messages_count'))
            ->where('to_user_id', auth()->id())
            ->where('is_read', false)
            ->groupBy('from_user_id')
            ->get();

        // add an unread key to each contact with the count of unread messages
        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
           
            return $contact;
        });


        return response()->json($contacts);
    }



public function sender($id){
    return view('messagesbox')->with('id',$id);
}

    public function sendmessage(request $request){
       
        $this->validate($request,[
'message'=>'required',

        ]);

$auth =  user::find($request->to_user_id);
if($auth !== null){


   
    $message = Message::create([
        "message"    =>  $request->message,
        "to_user_id"  => $request->to_user_id,
    "from_user_id"  => $request->from_user_id,
    ]) ;



    $searchin = Messagenotification::where('to_user_id',$request->to_user_id)->where('sender_id',$request->from_user_id)->get()->first();
  
if($searchin !== null){


    $searchin->message_id = $message->id;

    $searchin->read = false;
  
    $searchin->save();



 





}else{
    $ntf = new  Messagenotification;
    $ntf->sender_id = Auth::id();
    $ntf->to_user_id = $request->to_user_id;
    $ntf->message_id = $message->id;
    $ntf->read = false;
    $ntf->save();
}

    event(new chat($message));
    return response()->json(['status'=>'success']);
    
    
        
        







}
    }

public function getmassages($id){
    $user_id = Auth::id();
    $data = message::where('to_user_id',$id)->where('from_user_id',$user_id)->orWhere('from_user_id',$id,'to_user_id',$user_id)->get();

}



public function getNtf(){
    $auth = Auth::id();
 $ntf =   Messagenotification::where('to_user_id',$auth)->with('msg')->with('sender')->get();

return response()->json($ntf);

}


public function isread($id){
  $massage=  massage::find($id);
if(empty($massage)){
    return response()->json(['status','error']);
}

$massage->is_read = 1;
$massage->save();
return response()->json(['status','success']);

}










   
}
