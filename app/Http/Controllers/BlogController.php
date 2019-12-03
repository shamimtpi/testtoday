<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use URL;
use Mail;
use Cookie;

class BlogController extends Controller
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
	 
	public function call_translate($id,$lang) 
   {
   
    $default = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
     
   					
	if($lang == "en")
	{
	$translate = DB::table('codepopular_translates')
		            
					->where('lang_code', '=', $lang)
					->where('id', '=', $id)
					->get();
					
		$translate_cnt = DB::table('codepopular_translates')
		            
					->where('lang_code', '=', $lang)
					->where('id', '=', $id)
					->count();			
	}
	else
	{
	$translate = DB::table('codepopular_translates')
		            
					->where('lang_code', '=', $lang)
					->where('parent', '=', $id)
					->get();
					
		$translate_cnt = DB::table('codepopular_translates')
		            
					->where('lang_code', '=', $lang)
					->where('parent', '=', $id)
					->count();			
	}				
	if(!empty($translate_cnt))
	{
					return $translate[0]->name;
	}
	else
	{
	  return "";
	}
}
  
	 
	 /* new */
	
	public function getPurchaseData( $code ) {
	
	$bearer = "M0yOfwFBnujwQt4KgVNuHiLDn7si9ExH";
      
      
      $bearer   = 'bearer ' . $bearer;
      $header   = array();
      $header[] = 'Content-length: 0';
      $header[] = 'Content-type: application/json; charset=utf-8';
      $header[] = 'Authorization: ' . $bearer;
      
      $verify_url = 'https://api.envato.com/v1/market/private/user/verify-purchase:'.$code.'.json';
      $ch_verify = curl_init( $verify_url . '?code=' . $code );
      
      curl_setopt( $ch_verify, CURLOPT_HTTPHEADER, $header );
      curl_setopt( $ch_verify, CURLOPT_SSL_VERIFYPEER, false );
      curl_setopt( $ch_verify, CURLOPT_RETURNTRANSFER, 1 );
      curl_setopt( $ch_verify, CURLOPT_CONNECTTIMEOUT, 5 );
      curl_setopt( $ch_verify, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
      
      $cinit_verify_data = curl_exec( $ch_verify );
      curl_close( $ch_verify );
      
      if ($cinit_verify_data != "")    
        return json_decode($cinit_verify_data);  
      else
        return false;
        
    }
    
    public function verifyPurchase( $code ) {
      $verify_obj = self::getPurchaseData($code); 
      
      
      if ( 
          (false === $verify_obj) || 
          !is_object($verify_obj) ||
          !isset($verify_obj->{"verify-purchase"}) ||
          !isset($verify_obj->{"verify-purchase"}->item_name)
      )
        return -1;

      
      if (
        $verify_obj->{"verify-purchase"}->supported_until == "" ||
        $verify_obj->{"verify-purchase"}->supported_until != null
      )
        return $verify_obj->{"verify-purchase"};  
      
      
      return 0;
      
    }
	
	/* new */
    	
	
    public function avigher_index()
    {
       
		
      /* new */		 
				 
		$check_sett_code = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 73)
				->where('sett_meta_key', '=' , "cc_token")
		        
				->count();
		if(!empty($check_sett_code))
		{
		   
		    $sett_meta_well_four = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 73)
				->where('sett_meta_key', '=' , "cc_token")
		        
				->count();
				
			if(!empty($sett_meta_well_four))
			{	
		   $sett_meta_four =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 73)
				->where('sett_meta_key', '=' , "cc_token")
		        
				->get();
			$code_feedback = $sett_meta_four[0]->sett_meta_value;
			}
			else
			{
			$code_feedback = "";
			}	
		}
		else
		{
		  $code_feedback = "";
		}
		
		
		
		$check_sett_byname = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 74)
				->where('sett_meta_key', '=' , "cc_byname")
		        
				->count();
		if(!empty($check_sett_byname))
		{
		   
		    $sett_meta_well_four = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 74)
				->where('sett_meta_key', '=' , "cc_byname")
		        
				->count();
				
			if(!empty($sett_meta_well_four))
			{	
		   $sett_meta_four =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 74)
				->where('sett_meta_key', '=' , "cc_byname")
		        
				->get();
			$cc_byname = $sett_meta_four[0]->sett_meta_value;
			}
			else
			{
			$cc_byname = "";
			}	
		}
		else
		{
		  $cc_byname = "";
		}
		
		
		
		$purchase_code = base64_decode($code_feedback);
    	$o = $this->verifyPurchase( $purchase_code );
		if ( is_object($o) ) 
		{
		   if($o->buyer== base64_decode($cc_byname) && $o->item_name=="CodePopular Marketplace")
		   {
		      $cany_check_value = 1;
		   }
		   else
		   {
		     $cany_check_value = 0;
		   }
		}
		else
		{
		   $cany_check_value = 0;
		} 
		/* new */		 
		

		
		$default = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		
		
        
		$blogs = DB::table('posts')
		         ->where('post_status', '=', '1')
				 ->where('post_type', '=', 'blog')
				 ->where('lang_code','=',$lang)
				 ->orderBy('post_id', 'desc')->get();
		
		$blog_count = DB::table('posts')
		         	  ->where('post_status', '=', '1')
					  ->where('lang_code','=',$lang)
				 	  ->where('post_type', '=', 'blog')
					  ->count();
		
		$popular_blog = DB::table('posts')
		         ->where('post_status', '=', '1')
				 ->where('post_type', '=', 'blog')
				 ->where('lang_code','=',$lang)
				 ->orderBy('post_id', 'desc')
				 ->take(5)
				 ->get();
      
		
		$data = array('blogs' => $blogs, 'blog_count' => $blog_count, 'popular_blog' => $popular_blog, 'cany_check_value' => $cany_check_value);
            return view('blog')->with($data);
    }
	
	
	
	
	public function avigher_blog_comment(Request $request)
	{
	
	$default = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		
	
	
	   $data = $request->all();
		
		$name = $data['name'];
		$email = $data['email'];
		
		$msg = $data['msg'];
		$post_comment_type = $data['post_comment_type'];
		
		
		$post_parent = $data['post_parent'];
		
		$post_type = $data['post_type'];
		
		$post_user_id = $data['post_user_id'];
		
		
		$comment_date = date("Y-m-d H:i:s");
		
		$status = 0;
		
		
		/*$count = DB::table('posts')
		         ->where('post_title', '=', $name)
				 ->where('post_comment_type', '=', $post_comment_type)
				 ->where('post_type', '=', $post_type)
				 ->where('post_status', '=', $status)
				 ->count();
		if($count==0)
		{*/
		
		
		/* slug */
		$str_one = strtolower($name);
		$str_two = preg_replace("/[^a-z0-9_\s-]/", "", $str_one);
		$str_three = preg_replace("/[\s-]+/", " ", $str_two);
		$post_slug = preg_replace("/[\s_]/", "-", $str_three);
		/* end slug */
		
		
		DB::insert('insert into posts (	post_title,post_slug,post_desc,post_comment_type,post_type,post_parent,post_email,post_user_id,post_date,post_status) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$name,$post_slug,$msg,$post_comment_type,$post_type,$post_parent,$email,$post_user_id,$comment_date,$status]);
		/*}*/
		
		
		
		
		$getevents = DB::table('posts')
						   ->where('post_id', '=', $post_parent)
						   ->where('post_type', '=', 'blog')
						   ->where('post_status', '=', '1')
						   ->get();
		
		$blog_title = $getevents[0]->post_title;
		$blog_slug = $getevents[0]->post_slug;
			
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/media/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		
		$aid=1;
		$admindetails = DB::table('users')
		 ->where('id', '=', $aid)
		 ->first();
		
		$admin_email = $admindetails->email;
		
		
		
		
		$check_sett_sname = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->count();
		if(!empty($check_sett_sname))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->get();
			$sett_sender_name = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_sender_name = "";
			}	
		}
		else
		{
		  $sett_sender_name = "";
		}
		
		
		
		
		
		$check_sett_semail = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->count();
		if(!empty($check_sett_semail))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->get();
			$sett_sender_email = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_sender_email = "";
			}	
		}
		else
		{
		  $sett_sender_email = "";
		}
		
		
		
		
		
		$datas = [
            'site_logo' => $site_logo, 'site_name' => $site_name, 'name' => $name,  'email' => $email, 'msg' => $msg, 'blog_title' => $blog_title, 'blog_slug' => $blog_slug, 'url' => $url
        ];
		
		Mail::send('commentemail', $datas , function ($message) use ($admin_email,$email,$sett_sender_name,$sett_sender_email,$lang)
        {
            $message->subject($this->call_translate( 1072, $lang));
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($sett_sender_email);

        }); 
		
		
		
		
		
		
		
		return redirect()->back()->with('success', $this->call_translate( 961, $lang));
		
		
		
	
	}
	
	
	
	
	
	
	
	public function avigher_singlepost($id)
    {
	
	
	/* new */		 
				 
		$check_sett_code = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 73)
				->where('sett_meta_key', '=' , "cc_token")
		        
				->count();
		if(!empty($check_sett_code))
		{
		   
		    $sett_meta_well_four = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 73)
				->where('sett_meta_key', '=' , "cc_token")
		        
				->count();
				
			if(!empty($sett_meta_well_four))
			{	
		   $sett_meta_four =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 73)
				->where('sett_meta_key', '=' , "cc_token")
		        
				->get();
			$code_feedback = $sett_meta_four[0]->sett_meta_value;
			}
			else
			{
			$code_feedback = "";
			}	
		}
		else
		{
		  $code_feedback = "";
		}
		
		
		
		$check_sett_byname = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 74)
				->where('sett_meta_key', '=' , "cc_byname")
		        
				->count();
		if(!empty($check_sett_byname))
		{
		   
		    $sett_meta_well_four = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 74)
				->where('sett_meta_key', '=' , "cc_byname")
		        
				->count();
				
			if(!empty($sett_meta_well_four))
			{	
		   $sett_meta_four =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 74)
				->where('sett_meta_key', '=' , "cc_byname")
		        
				->get();
			$cc_byname = $sett_meta_four[0]->sett_meta_value;
			}
			else
			{
			$cc_byname = "";
			}	
		}
		else
		{
		  $cc_byname = "";
		}
		
		
		
		$purchase_code = base64_decode($code_feedback);
    	$o = $this->verifyPurchase( $purchase_code );
		if ( is_object($o) ) 
		{
		   if($o->buyer== base64_decode($cc_byname) && $o->item_name=="CodePopular Marketplace")
		   {
		      $cany_check_value = 1;
		   }
		   else
		   {
		     $cany_check_value = 0;
		   }
		}
		else
		{
		   $cany_check_value = 0;
		} 
		/* new */		 
		

	
	$default = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
	
	
	$post = DB::table('posts')
		         ->where('post_status', '=', '1')
				 ->where('post_type', '=', 'blog')
				 ->where('lang_code','=',$lang)
				  ->where('post_slug', '=', $id)
				  ->get();
				  
				  
	$post_count = DB::table('posts')
		         ->where('post_status', '=', '1')
				 ->where('post_type', '=', 'blog')
				 ->where('lang_code','=',$lang)
				  ->where('post_slug', '=', $id)
				  ->count();
				  
	$previous =  DB::table('posts')
		         ->where('post_status', '=', '1')
				 ->where('post_type', '=', 'blog')
				 ->where('post_title', '<', $post[0]->post_title)
	             ->max('post_title');
				 
				 
	$previous_link = DB::table('posts')
		         ->where('post_status', '=', '1')
				 ->where('post_type', '=', 'blog')
				  ->where('post_title', '=', $previous)
				  ->get();
				  			 
				 
	$next =  DB::table('posts')
		         ->where('post_status', '=', '1')
				 ->where('post_type', '=', 'blog')
				 ->where('post_title', '>', $post[0]->post_title)
	             ->min('post_title');	
				 
				 
	$next_link = DB::table('posts')
		         ->where('post_status', '=', '1')
				 ->where('post_type', '=', 'blog')
				  ->where('post_title', '=', $next)
				  ->get();			 
				 		 

    $popular_blog = DB::table('posts')
		         ->where('post_status', '=', '1')
				 ->where('post_type', '=', 'blog')
				 ->where('lang_code','=',$lang)
				 ->orderBy('post_date', 'desc')
				 ->take(5)
				 ->get();
   		  
				  		  
				  
	$data = array('post' => $post, 'post_count' => $post_count, 'previous' => $previous, 'previous_link' => $previous_link, 'next_link' => $next_link, 'next' => $next, 'popular_blog' => $popular_blog, 'cany_check_value' => $cany_check_value);
	 return view('blog')->with($data);
	
	
	}
	
	
	
	
	
	
}
