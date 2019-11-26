<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helper\CrawlHelper;


class BongDaController extends Controller
{
	private $crawlHelper;

	public function __construct(){
		$this->crawlHelper = new CrawlHelper;
	}

	public function index(){
		return $this->crawlHelper->crawlBongDa();

	}
}