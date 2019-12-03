<?php
namespace App\Http\Controllers\Admin;
use File;
use Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Mail;
use Auth;
use Crypt;
use URL;
use Storage;

class ProductsController extends Controller
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
	 
	public function fstaus($token,$f_status)
	{
	   $setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		$featured_days = $setts[0]->featured_days;
		$featured_price = $setts[0]->featured_price;
		
		$start_date = date("Y-m-d");
	$end_date = date('Y-m-d', strtotime(' + '.$featured_days.' days'));
	
	$orderupdate = DB::table('products')
						->where('item_token', '=', $token)
						
						->update(['item_featured' => 1, 'featured_startdate' => $start_date, 'featured_enddate' => $end_date, 'featured_days' => $featured_days,      'featured_price' => $featured_price]);
		 
		 return back();
	
	} 
	 
	 
	 
	 public function status($token,$sid,$id,$user_id) 
	{
   
     DB::update('update products set item_status="'.$sid.'" where item_token = ?',[$token]);
	  
	  
	  if($sid==1)
	   {
	   $user = DB::table('users')
						->where('id', '=', $user_id)
						->get();
						
						
		$item = 	DB::table('products')
						->where('item_token', '=', $token)
						->get();
						
		$item_name = $item[0]->item_title;
		$slug = $item[0]->item_slug;						
						
						
	   $user_email = $user[0]->email;
	   
	   
	   
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
		$admin_name = $admindetails->name;
		
		$datas = [
            'user_email' => $user_email, 'url' => $url, 'item_name' => $item_name, 'id' => $id, 'slug' => $slug, 'site_logo' => $site_logo, 'site_name' => $site_name, 'admin_name' => $admin_name
        ];
		
		
		
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
		
		
		
		
		
		
		Mail::send('admin.item_approval_mail', $datas , function ($message) use ($admin_email,$user_email,$sett_sender_name,$sett_sender_email)
        {
            $message->subject('Your item is approved');
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($user_email);

        }); 
		
		}
		 
		
	  
	  
	  
	   
      return back();
   
   
     }
	 
	 
	 
	 public function avigher_technologies_index()
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
		
		
	   
	   $items_count = DB::table('products')
		            ->where('delete_status','=','')
					->where('lang_code','=','en')
					->orderBy('item_id', 'desc')
					->count();
	   
			   
			   
		$setid=1;
		$setting = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		   
		$data = array('items_count' => $items_count, 'setting' => $setting, 'cany_check_value' => $cany_check_value);	   
	   return view('admin.products')->with($data);
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
    
	 
	 
	 
    public function avigher_technologies_single($token)
	{
	
	    $single_items = DB::table('products')
		                      ->where('item_token','=',$token)
							  ->get();
							  
	    $setid=1;
		$setting = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		   
		$data = array('single_items' => $single_items, 'setting' => $setting);	   
	   return view('admin.product_more')->with($data);
	
	}
	
	
	
	 public function deleted($token) 
	 {
	 /* amazon s3 */
	   
	   $check_s3_meta = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 95)
				->where('sett_meta_key', '=' , "site_file_upload_by")
		        
				->count();
		if(!empty($check_s3_meta))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 95)
				->where('sett_meta_key', '=' , "site_file_upload_by")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 95)
				->where('sett_meta_key', '=' , "site_file_upload_by")
		        
				->get();
			$site_file_upload_by = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$site_file_upload_by = "";
			}	
		}
		else
		{
		  $site_file_upload_by = "";
		}
		
		/* amazon s3 */
	 
	 $check_item = DB::table('products')
		        ->where('item_token', '=' , $token)
				->count();
		if(!empty($check_item))
		{
		$item = DB::select('select * from products where item_token = ?',[$token]);
		$item_again = DB::select('select * from product_metas where item_token = ?',[$token]);
		$item_last = DB::select('select * from product_images where item_token = ?',[$token]);
		
		if($site_file_upload_by == "s3_server")
		{
		     if(!empty($item[0]->main_file))
			{
				Storage::disk('s3')->delete($item[0]->main_file);
			}
			if(!empty($item_again[0]->item_meta_value))
			{
			   Storage::disk('s3')->delete($item_again[0]->item_meta_value);
			}
			foreach($item_last as $slast)
			{
			
			Storage::disk('s3')->delete($slast->image);
			}
			
			if(!empty($item[0]->preview_image))
			{
			$delpath_two = base_path('images/media/preview/'.$item[0]->preview_image);
			File::delete($delpath_two);
			}
			
			if(!empty($item[0]->item_thumbnail))
			{
			$delpath_three = base_path('images/media/thumbnail/'.$item[0]->item_thumbnail);
			File::delete($delpath_three);
			}
				
		
		}
		else
		{
		
			if(!empty($item[0]->main_file))
			{
			$delpath_one = base_path('images/media/itemfile/'.$item[0]->main_file);
			File::delete($delpath_one);
			}
			
			if(!empty($item[0]->preview_image))
			{
			$delpath_two = base_path('images/media/preview/'.$item[0]->preview_image);
			File::delete($delpath_two);
			}
			
			if(!empty($item[0]->item_thumbnail))
			{
			$delpath_three = base_path('images/media/thumbnail/'.$item[0]->item_thumbnail);
			File::delete($delpath_three);
			}
			
			if(!empty($item_again[0]->item_meta_value))
			{
			$delpath_four = base_path('images/media/video/'.$item_again[0]->item_meta_value);
			File::delete($delpath_four);
			}
		
			foreach($item_last as $slast)
			{
			$delpath_five = base_path('images/media/screenshots/'.$slast->image);
			File::delete($delpath_five);
			}
			
		}	
			
			
			
		}
	
        
	  DB::update('update products set delete_status="deleted" where item_token = ?', [$token]);
	   
      return back();
      
   }
   
   
   
   protected function delete_all(Request $request)
    {
		
		
		/* amazon s3 */
	   
	   $check_s3_meta = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 95)
				->where('sett_meta_key', '=' , "site_file_upload_by")
		        
				->count();
		if(!empty($check_s3_meta))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 95)
				->where('sett_meta_key', '=' , "site_file_upload_by")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 95)
				->where('sett_meta_key', '=' , "site_file_upload_by")
		        
				->get();
			$site_file_upload_by = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$site_file_upload_by = "";
			}	
		}
		else
		{
		  $site_file_upload_by = "";
		}
		
		/* amazon s3 */
	 
		
	   $data = $request->all();
	   $token = $data['token'];
	   
	   foreach($token as $key)
	   {
	   
	   
	   
	   $check_item = DB::table('products')
		        ->where('item_token', '=' , $key)
				->count();
		if(!empty($check_item))
		{
		$item = DB::select('select * from products where item_token = ?',[$key]);
		$item_again = DB::select('select * from product_metas where item_token = ?',[$key]);
		$item_last = DB::select('select * from product_images where item_token = ?',[$key]);
		
		if($site_file_upload_by == "s3_server")
		{
		     if(!empty($item[0]->main_file))
			{
				Storage::disk('s3')->delete($item[0]->main_file);
			}
			if(!empty($item_again[0]->item_meta_value))
			{
			   Storage::disk('s3')->delete($item_again[0]->item_meta_value);
			}
			foreach($item_last as $slast)
			{
			
			Storage::disk('s3')->delete($slast->image);
			}
			
			if(!empty($item[0]->preview_image))
			{
			$delpath_two = base_path('images/media/preview/'.$item[0]->preview_image);
			File::delete($delpath_two);
			}
			
			if(!empty($item[0]->item_thumbnail))
			{
			$delpath_three = base_path('images/media/thumbnail/'.$item[0]->item_thumbnail);
			File::delete($delpath_three);
			}
				
		
		}
		else
		{
		
		
			if(!empty($item[0]->main_file))
			{
			$delpath_one = base_path('images/media/itemfile/'.$item[0]->main_file);
			File::delete($delpath_one);
			}
			
			if(!empty($item[0]->preview_image))
			{
			$delpath_two = base_path('images/media/preview/'.$item[0]->preview_image);
			File::delete($delpath_two);
			}
			
			if(!empty($item[0]->item_thumbnail))
			{
			$delpath_three = base_path('images/media/thumbnail/'.$item[0]->item_thumbnail);
			File::delete($delpath_three);
			}
			
			if(!empty($item_again[0]->item_meta_value))
			{
			$delpath_four = base_path('images/media/video/'.$item_again[0]->item_meta_value);
			File::delete($delpath_four);
			}
			
			
			foreach($item_last as $slast)
			{
			$delpath_five = base_path('images/media/screenshots/'.$slast->image);
			File::delete($delpath_five);
			}
			
			
		}	
			
			
			
		}
	   
   
   
		 DB::update('update products set delete_status="deleted" where item_token = ?', [$key]); 
		  
		  
		   
		  
      
        }
   return back();
   }
   
   
   
	
	
	
	
	
	
}
