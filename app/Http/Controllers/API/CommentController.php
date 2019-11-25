<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use Auth;

class CommentController extends Controller
{
   private $comment;

   public function __construct(){
      $this->comment = new Comment;
   }

    public function getCommentByNewsId(Request $request){
   		
      	$comment = $this->comment->getCommentByNewsId($request->newsId);

      	return response()->json(['status'=>1,'data'=>$comment]);
    }

    public function saveComment(Request $request){
    	$arr = [
    		'user_id' => Auth::user()->id,
	        'news_id' => $request->newsId,
	        'content' => $request->content,
    	];

    	Comment::create($arr);

    	return response()->json(['status'=>1,'msg'=>"saved successlly"]); 
    }
}