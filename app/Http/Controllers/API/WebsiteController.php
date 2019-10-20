<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Website;

class WebsiteController extends Controller
{
	public function getWebsite(Request $request){
		$website = Website::get();

		return response()->json(['status'=>1,'data'=>$website],200);
	}
}