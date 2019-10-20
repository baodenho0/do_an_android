<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;

class NewsController extends Controller
{
   public function getNewsByWebsiteIdAndCategoryId(Request $request){
   		$news = News::getByWebsiteIdAndCategoryId($request->websiteId,$request->categoryId);

   		return response()->json(['status'=>1,'data'=>$news],200);
   }

   public function getById(Request $request){
   		$news = News::select('id','website_id','category_id','title','url','short_content','image')
   				->findOrFail($request->id);

   		return response()->json(['status'=>1,'data'=>$news],200);
   }
}