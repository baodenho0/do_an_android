<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rating;
use Auth;

class RatingController extends Controller
{
   private $rating;

   public function __construct(){
      $this->rating = new Rating;
   }

    public function getRatingByNewsId(Request $request){
   		
      	$result = $this->rating->getByNewId($request->newsId);

      	return response()->json(['status'=>1,'data'=>$result]);
    }

    public function updateRating(Request $request){
    	$authUserId = Auth::user()->id;
    	// dd($request->all());
    	$this->rating->updateRating($request->rating,$request->newsId,$authUserId);

    	return response()->json(['status'=>1,'msg'=>"updated successfully"]);
    }
}