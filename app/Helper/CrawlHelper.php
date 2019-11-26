<?php
namespace App\Http\Helper;

require "simple_html_dom.php";

// use Illuminate\Http\Request;

class CrawlHelper
{
	private function run($link){
		$ch = curl_init($link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $content = curl_exec($ch);
        curl_close($ch);
        $dom = str_get_html($content);

        return $dom;     
	}

	private function generalCrawlVietNamNet($url){
		$arr = [];

		$dom = $this->run($url);	

        $content = $dom->find("div.clearfix.item");      
         
        foreach ($content as $value) {
            $arr[] = [
                'title' => $value->find("a img",0)->alt,
                'url' => "https://vietnamnet.vn".$value->find("a",0)->href,
                'image' => $value->find("a img",0)->src,
                'short_content' => $value->find("div.lead",0)->innertext
            ];            
        }
        return $arr;
	}

	public function crawlTheThaoVietNamNet(){
		$arr = [];
		
		$dom = $this->run("https://vietnamnet.vn/vn/the-thao/");	

        $content = $dom->find(".box-subcate-style4");      
         
        foreach ($content as $value) {
            $url = "https://vietnamnet.vn".$value->find("a",0)->href;

            $body = $this->run($url);
            $content = $body->find("#ArticleContent",0);

            $arr[] = [
                'title' => $value->find("a img",0)->alt,
                'url' => $url,
                'image' => $value->find("a img",0)->src,
                'short_content' => $value->find(".box-subcate-style4-caption .box-subcate-style4-lead",0)->innertext,
                'content' => $content
            ];            
        }
        return $arr;
	}

	public function crawlChinhTriVietNamNet(){
		return $this->generalCrawlVietNamNet("https://vietnamnet.vn/vn/thoi-su/chinh-tri/");
	}

	public function crawlKinhDoanhVietNamNet(){
		return $this->generalCrawlVietNamNet("https://vietnamnet.vn/vn/kinh-doanh/");
	}

	public function crawlThoiSuVietNamNet(){
		return $this->generalCrawlVietNamNet("https://vietnamnet.vn/vn/thoi-su/");
	}

    public function crawlXoSo(){
        $dom = $this->run("https://ketqua.net/xo-so-mien-nam");    
        // echo ($dom); die; 

        $content = $dom->find(".table-kq-bold-border",0);      
        $header = "<style>table tr td{border: 1px solid #000;} table{width:100%}</style><meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        return $header.$content;
    }

	

}