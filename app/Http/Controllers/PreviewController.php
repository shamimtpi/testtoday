<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use File;
use Image;
use URL;
use Mail;
use Illuminate\Validation\Rule;
use Cookie;

class PreviewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
	
	public function avigher_slug($slug,$prod_slug)
	{
	   $data = array('slug' => $slug,'prod_slug' => $prod_slug);
	   return view('preview')->with($data);
	   
	}
	
	
	
	
	public function avigher_index() {
	
      return view('preview');
   }
   
   
   
  
	
	
	
	
	
	
	
	
	
	
}
