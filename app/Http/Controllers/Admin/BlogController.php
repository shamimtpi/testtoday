<?php

namespace App\Http\Controllers\Admin;



use File;
use Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use URL;
use Mail;

class BlogController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
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
		
	
        $blog = DB::table('posts')
		        ->where('post_type', '=' , 'blog')
				->where('post_status', '=' , '1')
				->where('lang_code','=','en')
		        ->orderBy('post_id','desc')
				->get();

        return view('admin.blog', ['blog' => $blog, 'cany_check_value' => $cany_check_value]);
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
    
	
	
	
	public function status_comment($pid,$sid) 
	{
	    DB::update('update posts set post_status="'.$sid.'" where post_id = ?',[$pid]);
		
		if($sid==1)
		{
		
		$getblog = DB::table('posts')
						   ->where('post_id', '=', $pid)
						   ->where('post_type', '=', 'comment')
						   ->where('post_status', '=', '1')
						   ->get();
		
		$blog_title = $getblog[0]->post_title;
		$blog_slug = $getblog[0]->post_slug;
		$email = $getblog[0]->post_email;
		$type = $getblog[0]->post_comment_type;
		
			
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		
		$aid=1;
		$admindetails = DB::table('users')
		 ->where('id', '=', $aid)
		 ->first();
		
		$admin_email = $admindetails->email;
		
		
		$datas = [
            'site_logo' => $site_logo, 'site_name' => $site_name, 'email' => $email,  'blog_title' => $blog_title, 'blog_slug' => $blog_slug, 'url' => $url, 'type' => $type
        ];
		
		Mail::send('admin.commentemail', $datas , function ($message) use ($admin_email,$email)
        {
            $message->subject('Your comment has been approved');
			
            $message->from($admin_email, 'Admin');

            $message->to($email);

        }); 
		
		
		}
		
		
		
	 return back();
	}
	
	
	
	public function view_comment($blog,$comment,$id) 
	{
	    			  
					  
		if($blog=='blog')
		{			  
		$view_title = DB::table('posts')
		              ->where('post_id', '=', $id)
					  ->where('post_status', '=', '1')
					  ->where('post_type', '=', 'blog')
					  ->where('post_comment_type', '=', '')
					  ->get();
					  $urlcomment = "blog";			  
		}
		if($blog=='sermons')
		{			  
		$view_title = DB::table('sermons')
		              ->where('id', '=', $id)
					  ->get();
					  $urlcomment = "sermons";			  
		}
		if($blog=='event')
		{			  
		$view_title = DB::table('posts')
		              ->where('post_id', '=', $id)
					  ->where('post_status', '=', '1')
					  ->where('post_type', '=', 'event')
					  ->where('post_comment_type', '=', '')
					  ->get();
					  $urlcomment = "event";			  
		}			  
					  
		
		$view_comment = DB::table('posts')
							 ->where('post_parent', '=', $id)
							 ->where('post_comment_type', '=', $blog)
							 ->where('post_type', '=', $comment)
							 ->get();
	     return view('admin.comment', ['view_comment' => $view_comment, 'view_title' => $view_title, 'urlcomment' => $urlcomment ]);
	}
	
	
	
	
	
	
	
	protected function delete_all(Request $request)
    {
		
		
	   $data = $request->all();
	   $blogg_id = $data['postid'];
	   
	   foreach($blogg_id as $postt)
	   {
		   
	  
	  $image = DB::table('posts')->where('post_id', $postt)->first();
		$orginalfile=$image->post_image;
		
		$audiofile=$image->post_audio;
		
		
		
       $path = base_path('images/media/blog/'.$orginalfile);
	   
	   $mp3path = base_path('images/media/blog/'.$audiofile);
	   
	  File::delete($path);
	  
	  File::delete($mp3path);

	   
	DB::delete('delete from posts where post_type="comment" and post_comment_type="blog" and post_parent = ?',[$postt]);
	DB::delete('delete from posts where parent = ?',[$postt]);
	DB::delete('delete from posts where post_id = ?',[$postt]);
		   
	   }
	
	return back();
	
	
	}
	
	
	
	
	
	
	
	public function destroy($id) {
		
		$image = DB::table('posts')->where('post_id', $id)->first();
		$orginalfile=$image->post_image;
		
		$audiofile=$image->post_audio;
		
		
		
       $path = base_path('images/media/blog/'.$orginalfile);
	   
	   $mp3path = base_path('images/media/blog/'.$audiofile);
	   
	  File::delete($path);
	  
	  File::delete($mp3path);
	  
	  DB::delete('delete from posts where post_type="comment" and post_comment_type="blog" and post_parent = ?',[$id]);
	  DB::delete('delete from posts where parent = ?',[$id]);
      DB::delete('delete from posts where post_id = ?',[$id]);
	   
      return back();
      
   }
   
   
   public function comment_destroy($id) {
		
		
      DB::delete('delete from posts where post_id = ?',[$id]);
	   
      return back();
      
   }
   
   
   
   
	
}