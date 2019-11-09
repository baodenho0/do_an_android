<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function crawl(Request $request, CrawlHelper $crawlHelper){
        $dom = $crawlHelper->run("https://vietnamnet.vn/vn/the-thao/");

        $content = $dom->find('.box-horizontal-style-2');


        $highlight = $dom->find('.top-cate-new-head',0);

// echo ($highlight->find(".top-cate-new-head-title p",0)); die;
        $arr = [];

        $arr[] = [
            'title' => $highlight->find("a img",0)->alt,
            'url' => $highlight->find("a",0)->href,
            'image' => $highlight->find("a img",0)->src,
            'short_content' => $highlight->find(".top-cate-new-head-title p",0)->plaintext
        ];

        // dd($arr);

        

        foreach ($content as $link) {
            $arr[] = [
                'title' => $link->find("a img",0)->alt,
                'url' => $link->find("a",0)->href,
                'image' => $link->find("a img",0)->src
            ];            
        }
        dd($arr);
    }


}
