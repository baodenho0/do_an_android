<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Website;
use App\Category;
use App\Http\Helper\CrawlHelper;

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

    public function save(Request $request, CrawlHelper $crawlHelper, News $news){


        /**
         * crawl vietnamnet
         * url: https://vietnamnet.vn/     
         * categoris:  
         *     2 => chinh tri
         *     3 => thoi su
         *     4 => kinh doanh
         *     5 => the thao
         */
        if($request->website == 2){
            switch ($request->category) {       
                case '2':
                    $arr = $crawlHelper->crawlChinhTriVietNamNet();
                    break;  
                case '3':
                    $arr = $crawlHelper->crawlThoiSuVietNamNet();
                    break;  
                case '4':
                    $arr = $crawlHelper->crawlKinhDoanhVietNamNet();
                    break;  
                case '5':
                    $arr = $crawlHelper->crawlTheThaoVietNamNet();
                    break;                     
                
            }
        }

        // dd($arr);
        
        $i = $news->saveArrCheckUnique($request->website, $request->category, $arr);

        return back()->with("success",$i." rows saved successfully");
    }


}
