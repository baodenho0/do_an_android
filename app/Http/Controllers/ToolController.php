<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Website;
use App\Category;

class ToolController extends Controller
{
    public function index(Website $website){
    	$data['website'] = $website->getAll();

    	return view('tool.index',$data);
    }

    public function getCategoryByWebsiteId(Request $request,Category $category){
    	if($request->id){
    		$category = $category->getByWebsiteId($request->id);

    		return response()->json(['status'=>1,'data'=>$category],200);
    	}
    }

    public function crawl(Request $request){
        dd($request->all());
    }


}
