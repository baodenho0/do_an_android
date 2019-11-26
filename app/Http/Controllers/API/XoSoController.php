<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helper\CrawlHelper;


class XoSoController extends Controller
{
	private $crawlHelper;

	public function __construct(){
		$this->crawlHelper = new CrawlHelper;
	}

	public function index(){
		return $this->crawlHelper->crawlXoSo();



		// return response()->json(['status'=>1,'data'=>$website],200);
	}
}