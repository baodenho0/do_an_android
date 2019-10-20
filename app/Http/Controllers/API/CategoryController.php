<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Auth;

class CategoryController extends Controller
{
	public function getCategoryByWebsiteId(Request $request){
		$category = Category::getByWebsiteId($request->websiteId);

		return response()->json(['status'=>1,'data'=>$category],200);
	}
}