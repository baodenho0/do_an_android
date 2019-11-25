<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;
use App\Activity;
use App\Rating;
use Auth;

class NewsController extends Controller
{
	private $activity;

   	public function __construct(){
         $this->activity = new Activity;
         $this->rating = new Rating;
   	}

   	public function getNewsByWebsiteIdAndCategoryId(Request $request){
   		$news = News::getByWebsiteIdAndCategoryId($request->websiteId,$request->categoryId);

   		return response()->json(['status'=>1,'data'=>$news],200);
   	}

   	public function getById(Request $request){
   		$authUserId = Auth::user()->id;
   		
   		$data['news'] = News::select('id','content')->findOrFail($request->id);

         $data["token"] = $request->token;

         $data["newsId"] = $request->id;

         $data["rating"] = $this->rating->getByUserIdAndNewsId($authUserId, $request->id)->rate ?? "";

   		$this->activity->saveActivity($authUserId, $data['news']->id);

   		return view("news.detail",$data);
   	}
}