<?php
namespace App\Http\Helper;

require "simple_html_dom.php";

// use Illuminate\Http\Request;

class CrawlHelper
{
	public function run($link){
		$ch = curl_init($link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $content = curl_exec($ch);
        curl_close($ch);
        $dom = str_get_html($content);

        return $dom;
     
	}

}