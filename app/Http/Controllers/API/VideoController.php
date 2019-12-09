<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\CallApIHelper;
use App\Http\Helper\CrawlHelper;


class VideoController extends Controller
{
	private $apiHelper;
	private $crawlHelper;

	public function __construct(){
		$this->apiHelper = new CallApIHelper;
		$this->crawlHelper = new CrawlHelper;
	}

	public function index(){
		$url = "https://dantri.com.vn/";
		$urlVideo = "https://vcdn.dantri.com.vn/mp4/";
		$urlImage = "https://icdn.dantri.com.vn/";
		
		$arrJson = $this->crawlHelper->crawlVideoDanTri();
		// dd($a);
		$arr = json_decode($arrJson,true);
		// dd($arr);
		$arrResult = [];
		foreach ($arr as $key => $value) {
			$arrResult[] = [
				'FileName' => $urlVideo.$value['FileName'],
				'Name' => $value['Name'],
				'Url' => $url.$value['Url'],
				'Avatar' => $urlImage.$value['Avatar'],
			];
		}

		// dd($arrResult);
		return response()->json(['status'=>1,'data'=>$arrResult]);
	}
}