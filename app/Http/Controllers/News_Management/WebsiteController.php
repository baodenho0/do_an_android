<?php

namespace App\Http\Controllers\News_Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{
    public function index(){
    	return view('news_management.news');
    }
}
