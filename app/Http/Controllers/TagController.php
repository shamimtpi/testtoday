<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use File;
use Image;
use URL;
use Mail;
use Carbon\Carbon;
use Cookie;

class TagController extends Controller
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
    
	
	
	
	public function avigher_tag($type,$id)
    {
	   
	   $default = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
	   
	    
		$tag_txt = str_replace("-"," ",$id);
	
	    
		if($type=="blog")
	   {		  
				
			 $query_count = DB::table('posts')
					
					 ->whereRaw("find_in_set('".$tag_txt."',post_tags)")
					 ->where("post_status", "=", "1")
					 ->where('lang_code','=',$lang)
					 ->where("post_type","=","blog")
					 ->count();	 
				 	  
	
	   }
	   
	  
		if($type=="item")
	   {
		  $query_count = DB::table('products')
		            ->whereRaw("find_in_set('".$tag_txt."',item_tags)")
					->where('delete_status', '=', '')
					->where('item_status', '=', 1)
					->where('lang_code','=',$lang)
					->orderBy('item_id', 'desc')
					->count();
				
		
	   }
		
	$siteid=1;
    $site_setting=DB::select('select * from settings where id = ?',[$siteid]);			  		  
				  
	$data = array('query_count' => $query_count, 'type' => $type, 'tag_txt' => $tag_txt, 'site_setting' => $site_setting);
	 return view('tag')->with($data);
	
	
	}
	
	 
	
	
}
