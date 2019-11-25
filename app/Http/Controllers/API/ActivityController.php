<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Activity;
use Auth;

class ActivityController extends Controller
{
   private $activity;

   public function __construct(){
      $this->activity = new Activity;
   }

    public function getByUserId(Request $request){
   		$authUserId = Auth::user()->id;
   		
      	return $this->activity->getByUserId($authUserId);
    }
}