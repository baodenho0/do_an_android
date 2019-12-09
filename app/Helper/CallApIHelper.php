<?php

namespace App\Helper;

class CallApIHelper
{

	public function Call($url,$method){

		try {
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			    'Content-Type: application/json',
			    // ':authority: dantri.com.vn',
			    // ':method: GET',
			    // ':path: /video/latest/0-1-16-01.htm',
			    // ':scheme: https'
			)
			);
			$result = curl_exec($curl);
			curl_close($curl);
			dd($result);
			return $result;

		} catch (\Exception $e) {
			\Log::info($e);
		}

		
	}

}