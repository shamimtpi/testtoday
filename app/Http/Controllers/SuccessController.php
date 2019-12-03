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


class SuccessController extends Controller
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
	 
	 
	 /* payu */
	 
	 
	 
	 
	 	 
	 
	 public function avigher_payu_success($cid,$txtid)
	{
	
	
	
	$default = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		
				
		
		
		 $orderupdate = DB::table('product_orders')
						->where('purchase_token', '=', $cid)
						->where('status', '=', 'pending')
						->update(['status' => 'completed', 'payment_token' => $txtid]);
		 $checkoutupdate = DB::table('product_checkouts')
						->where('purchase_token', '=', $cid)
						->where('payment_status', '=', 'pending')
						->update(['payment_status' => 'completed', 'payment_token' => $txtid]);
		
		
		$get_viewr = DB::table('product_orders')
		->where('purchase_token', '=', $cid)
		->where('status', '=', 'completed')
		->count();
		
		
		
		$view_orders = DB::table('product_orders')
						->where('purchase_token', '=', $cid)
						->where('status', '=', 'completed')
						->get();
		
		foreach($view_orders as $views)
		{
		
		$ord_id = $views->ord_id;
		
		$start_date = date("Y-m-d");
		if($views->licence_type=="regular_price_six_month")
		{
		   $end_date = date('Y-m-d', strtotime('+6 month'));
		}
		else if($views->licence_type=="regular_price_one_year")
		{
		   $end_date = date('Y-m-d', strtotime('+12 month'));
		}
		else if($views->licence_type=="extended_price_six_month")
		{
		   $end_date = date('Y-m-d', strtotime('+6 month'));
		}
		else if($views->licence_type=="extended_price_one_year")
		{
		   $end_date = date('Y-m-d', strtotime('+12 month'));
		}
		
		
		DB::update('update product_orders set payment_type="payu",license_start_date="'.$start_date.'",license_end_date="'.$end_date.'" where status="completed" and ord_id = ?', [$ord_id]);
		
		
		
		
		
		/* payment approval */
		
		$check_payment_website = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 20)
				->where('sett_meta_key', '=' , "payment_approval")
		        
				->count();
		if(!empty($check_payment_website))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 20)
				->where('sett_meta_key', '=' , "payment_approval")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 20)
				->where('sett_meta_key', '=' , "payment_approval")
		        
				->get();
			$payment_website = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$payment_website = "";
			}	
		}
		else
		{
		  $payment_website = "";
		}
	  
		
		
		if($payment_website == "no")
		{
		
		
		$view_orders = DB::table('product_orders')->where('ord_id','=',$ord_id)->get();
	  
		  if(empty($view_orders[0]->approval_status))
		  {
		  
		  $buyer_id = $view_orders[0]->user_id;
						  $buyer_details = DB::table('users')->where('id','=',$buyer_id)->get();
						  
						  $vendor_id = $view_orders[0]->item_user_id;
						  $vendor_details = DB::table('users')->where('id','=',$vendor_id)->get();
						  
						  $vendor_balance = $vendor_details[0]->wallet;
						  $vendor_amount = $view_orders[0]->vendor_amount;
						  
						  $total_vendor = $vendor_balance + $vendor_amount;
						  
						DB::update('update users set wallet="'.$total_vendor.'" where id = ?', [$vendor_id]); 
						
						$aid=1;
			$admindetails = DB::table('users')
			 ->where('id', '=', $aid)
			 ->first();
						
						$admin_balance =  $admindetails->wallet;
						$admin_amount = $view_orders[0]->admin_amount;
						
						$total_admin = $admin_balance + $admin_amount;
						
						DB::update('update users set wallet="'.$total_admin.'" where id = ?', [1]);
						
						
						DB::update('update product_orders set approval_status="payment released to vendor" where ord_id = ?', [$ord_id]);  
						
					$purchase_id = $view_orders[0]->purchase_token;	
						
						
			$setid=1;
			$setts = DB::table('settings')
			->where('id', '=', $setid)
			->get();
			
			$url = URL::to("/");
			
			$site_logo=$url.'/local/images/media/settings/'.$setts[0]->site_logo;
			
			$site_name = $setts[0]->site_name;
			
			
			
			
			$admin_email = $admindetails->email;
			$admin_name = $admindetails->name;
			
			$vendor_email = $vendor_details[0]->email;
			
			
			$datas = [
				'vendor_email' => $vendor_email, 'url' => $url,  'site_logo' => $site_logo, 'site_name' => $site_name, 'admin_name' => $admin_name, 'purchase_id' => $purchase_id, 'ord_id' => $ord_id
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
		
		
			
			
			
			Mail::send('admin.item_payment_approval', $datas , function ($message) use ($admin_email,$admin_name,$vendor_email,$sett_sender_name,$sett_sender_email,$lang)
			{
				$message->subject($this->call_translate( 1060, $lang));
				
				$message->from($sett_sender_email, $sett_sender_name);
	
				$message->to($vendor_email);
	
			}); 
						
						  
						  
		
		
		}
		else
		{
		   
		
		}
			
	}	
		
		
		/* payment approval */
		
		
		
		
		
		
		
		
		
		
		}				
		
							
						
		$get_details = DB::table('product_checkouts')
              
			       ->where('purchase_token', '=', $cid)
			   
                   ->get();
				   
			$user_details = DB::table('users')
              
			       ->where('id', '=', $get_details[0]->user_id)
			   
                   ->get();	   
				   
				   				
						
				$order_id = $cid;
				$name = $user_details[0]->name;
				$email = $user_details[0]->email;
				$phone = $user_details[0]->phone;			
				$amount = $get_details[0]->total;
				
				
						
		
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
            'site_logo' => $site_logo, 'site_name' => $site_name, 'name' => $name,  'email' => $email, 'phone' => $phone, 'amount' => $amount, 'url' => $url, 'order_id' => $order_id
        ];
		
		Mail::send('shop_email', $datas , function ($message) use ($admin_email,$email,$sett_sender_name,$sett_sender_email,$lang)
        {
            $message->subject($this->call_translate( 1063, $lang));
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($sett_sender_email);

        }); 
		
		
		
		
		Mail::send('shop_email', $datas , function ($message) use ($admin_email,$email,$sett_sender_name,$sett_sender_email,$lang)
        {
            $message->subject($this->call_translate( 1063, $lang));
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($email);

        }); 
		
		
		
		
		
		
	 
	  $data = array('cid' => $cid, 'txtid' => $txtid);
      return view('payu_success')->with($data);
	
	
	
	
	
	
	
	
	}
	 
	 
	 
	 
	 
	 
	 
	 /* payu */
	 
	 
	 
	 
	 
	 
	 
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
	 public function avigher_wallet_balance(Request $request)
	{
	
	
	   $default = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		
     
	    $data = $request->all();
		
		$cid = $data['cid'];
		
		$reduce_amount = $data['amount'];
		
		$get_userrol = DB::table('users')
						->where('id', '=', Auth::user()->id)
		                ->get();
		$old_amont = $get_userrol[0]->wallet - $reduce_amount;
		
		DB::update('update users set wallet="'.$old_amont.'" where id = ?', [Auth::user()->id]);				
		
		
		$orderupdate = DB::table('product_orders')
						->where('purchase_token', '=', $cid)
						->where('status', '=', 'pending')
						->update(['status' => 'completed']);
		 $checkoutupdate = DB::table('product_checkouts')
						->where('purchase_token', '=', $cid)
						->where('payment_status', '=', 'pending')
						->update(['payment_status' => 'completed']);
		
		
		$get_viewr = DB::table('product_orders')
		->where('purchase_token', '=', $cid)
		->where('status', '=', 'completed')
		->count();
		
		
		
		$view_orders = DB::table('product_orders')
						->where('purchase_token', '=', $cid)
						->where('status', '=', 'completed')
						->get();
		
		foreach($view_orders as $views)
		{
		
		$ord_id = $views->ord_id;
		
		$start_date = date("Y-m-d");
		if($views->licence_type=="regular_price_six_month")
		{
		   $end_date = date('Y-m-d', strtotime('+6 month'));
		}
		else if($views->licence_type=="regular_price_one_year")
		{
		   $end_date = date('Y-m-d', strtotime('+12 month'));
		}
		else if($views->licence_type=="extended_price_six_month")
		{
		   $end_date = date('Y-m-d', strtotime('+6 month'));
		}
		else if($views->licence_type=="extended_price_one_year")
		{
		   $end_date = date('Y-m-d', strtotime('+12 month'));
		}
		
		
		DB::update('update product_orders set payment_type="wallet",license_start_date="'.$start_date.'",license_end_date="'.$end_date.'" where status="completed" and ord_id = ?', [$ord_id]);
		
		
		
		
		/* payment approval */
		
		$check_payment_website = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 20)
				->where('sett_meta_key', '=' , "payment_approval")
		        
				->count();
		if(!empty($check_payment_website))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 20)
				->where('sett_meta_key', '=' , "payment_approval")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 20)
				->where('sett_meta_key', '=' , "payment_approval")
		        
				->get();
			$payment_website = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$payment_website = "";
			}	
		}
		else
		{
		  $payment_website = "";
		}
	  
		
		
		if($payment_website == "no")
		{
		
		
		$view_orders = DB::table('product_orders')->where('ord_id','=',$ord_id)->get();
	  
		  if(empty($view_orders[0]->approval_status))
		  {
		  
		  $buyer_id = $view_orders[0]->user_id;
						  $buyer_details = DB::table('users')->where('id','=',$buyer_id)->get();
						  
						  $vendor_id = $view_orders[0]->item_user_id;
						  $vendor_details = DB::table('users')->where('id','=',$vendor_id)->get();
						  
						  $vendor_balance = $vendor_details[0]->wallet;
						  $vendor_amount = $view_orders[0]->vendor_amount;
						  
						  $total_vendor = $vendor_balance + $vendor_amount;
						  
						DB::update('update users set wallet="'.$total_vendor.'" where id = ?', [$vendor_id]); 
						
						$aid=1;
			$admindetails = DB::table('users')
			 ->where('id', '=', $aid)
			 ->first();
						
						$admin_balance =  $admindetails->wallet;
						$admin_amount = $view_orders[0]->admin_amount;
						
						$total_admin = $admin_balance + $admin_amount;
						
						DB::update('update users set wallet="'.$total_admin.'" where id = ?', [1]);
						
						
						DB::update('update product_orders set approval_status="payment released to vendor" where ord_id = ?', [$ord_id]);  
						
					$purchase_id = $view_orders[0]->purchase_token;	
						
						
			$setid=1;
			$setts = DB::table('settings')
			->where('id', '=', $setid)
			->get();
			
			$url = URL::to("/");
			
			$site_logo=$url.'/local/images/media/settings/'.$setts[0]->site_logo;
			
			$site_name = $setts[0]->site_name;
			
			
			
			
			$admin_email = $admindetails->email;
			$admin_name = $admindetails->name;
			
			$vendor_email = $vendor_details[0]->email;
			
			
			$datas = [
				'vendor_email' => $vendor_email, 'url' => $url,  'site_logo' => $site_logo, 'site_name' => $site_name, 'admin_name' => $admin_name, 'purchase_id' => $purchase_id, 'ord_id' => $ord_id
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
		
		
			
			
			
			Mail::send('admin.item_payment_approval', $datas , function ($message) use ($admin_email,$admin_name,$vendor_email,$sett_sender_name,$sett_sender_email,$lang)
			{
				$message->subject($this->call_translate( 1060, $lang));
				
				$message->from($sett_sender_email, $sett_sender_name);
	
				$message->to($vendor_email);
	
			}); 
						
						  
						  
		
		
		}
		else
		{
		   
		
		}
			
	}	
		
		
		/* payment approval */
		
		
		
		
		
		
		
		
		
		
		}				
		
							
						
		$get_details = DB::table('product_checkouts')
              
			       ->where('purchase_token', '=', $cid)
			   
                   ->get();
				   
			$user_details = DB::table('users')
              
			       ->where('id', '=', $get_details[0]->user_id)
			   
                   ->get();	   
				   
				   				
						
				$order_id = $cid;
				$name = $user_details[0]->name;
				$email = $user_details[0]->email;
				$phone = $user_details[0]->phone;			
				$amount = $get_details[0]->total;
				
				
						
		
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
		
		
		
		
		$datas = [
            'site_logo' => $site_logo, 'site_name' => $site_name, 'name' => $name,  'email' => $email, 'phone' => $phone, 'amount' => $amount, 'url' => $url, 'order_id' => $order_id
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
		
		
			
		
		Mail::send('shop_email', $datas , function ($message) use ($admin_email,$email,$sett_sender_name,$sett_sender_email,$lang)
        {
            $message->subject($this->call_translate( 1063, $lang));
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($sett_sender_email);

        }); 
		
		
		
		
		Mail::send('shop_email', $datas , function ($message) use ($admin_email,$email,$sett_sender_name,$sett_sender_email,$lang)
        {
            $message->subject($this->call_translate( 1063, $lang));
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($email);

        }); 
		
		
		
		
		
		
	 
	  $data = array('cid' => $cid);
      /*return view('shop_success')->with($data);*/
	  
	  return redirect('/wallet-balance/'.$cid);
	
		
	 
	} 
	
	
	public function avigher_wallet_view($cid)
	{
	
	  return view('wallet-balance');
	
	}
	
	
	
	 	 
	 
	 public function avigher_shop_success($cid)
	{
	
	
	
	$default = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		
				
		
		
		 $orderupdate = DB::table('product_orders')
						->where('purchase_token', '=', $cid)
						->where('status', '=', 'pending')
						->update(['status' => 'completed']);
		 $checkoutupdate = DB::table('product_checkouts')
						->where('purchase_token', '=', $cid)
						->where('payment_status', '=', 'pending')
						->update(['payment_status' => 'completed']);
		
		
		$get_viewr = DB::table('product_orders')
		->where('purchase_token', '=', $cid)
		->where('status', '=', 'completed')
		->count();
		
		
		
		$view_orders = DB::table('product_orders')
						->where('purchase_token', '=', $cid)
						->where('status', '=', 'completed')
						->get();
		
		foreach($view_orders as $views)
		{
		
		$ord_id = $views->ord_id;
		
		$start_date = date("Y-m-d");
		if($views->licence_type=="regular_price_six_month")
		{
		   $end_date = date('Y-m-d', strtotime('+6 month'));
		}
		else if($views->licence_type=="regular_price_one_year")
		{
		   $end_date = date('Y-m-d', strtotime('+12 month'));
		}
		else if($views->licence_type=="extended_price_six_month")
		{
		   $end_date = date('Y-m-d', strtotime('+6 month'));
		}
		else if($views->licence_type=="extended_price_one_year")
		{
		   $end_date = date('Y-m-d', strtotime('+12 month'));
		}
		
		
		DB::update('update product_orders set payment_type="paypal",license_start_date="'.$start_date.'",license_end_date="'.$end_date.'" where status="completed" and ord_id = ?', [$ord_id]);
		
		
		
		
		
		/* payment approval */
		
		$check_payment_website = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 20)
				->where('sett_meta_key', '=' , "payment_approval")
		        
				->count();
		if(!empty($check_payment_website))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 20)
				->where('sett_meta_key', '=' , "payment_approval")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 20)
				->where('sett_meta_key', '=' , "payment_approval")
		        
				->get();
			$payment_website = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$payment_website = "";
			}	
		}
		else
		{
		  $payment_website = "";
		}
	  
		
		
		if($payment_website == "no")
		{
		
		
		$view_orders = DB::table('product_orders')->where('ord_id','=',$ord_id)->get();
	  
		  if(empty($view_orders[0]->approval_status))
		  {
		  
		  $buyer_id = $view_orders[0]->user_id;
						  $buyer_details = DB::table('users')->where('id','=',$buyer_id)->get();
						  
						  $vendor_id = $view_orders[0]->item_user_id;
						  $vendor_details = DB::table('users')->where('id','=',$vendor_id)->get();
						  
						  $vendor_balance = $vendor_details[0]->wallet;
						  $vendor_amount = $view_orders[0]->vendor_amount;
						  
						  $total_vendor = $vendor_balance + $vendor_amount;
						  
						DB::update('update users set wallet="'.$total_vendor.'" where id = ?', [$vendor_id]); 
						
						$aid=1;
			$admindetails = DB::table('users')
			 ->where('id', '=', $aid)
			 ->first();
						
						$admin_balance =  $admindetails->wallet;
						$admin_amount = $view_orders[0]->admin_amount;
						
						$total_admin = $admin_balance + $admin_amount;
						
						DB::update('update users set wallet="'.$total_admin.'" where id = ?', [1]);
						
						
						DB::update('update product_orders set approval_status="payment released to vendor" where ord_id = ?', [$ord_id]);  
						
					$purchase_id = $view_orders[0]->purchase_token;	
						
						
			$setid=1;
			$setts = DB::table('settings')
			->where('id', '=', $setid)
			->get();
			
			$url = URL::to("/");
			
			$site_logo=$url.'/local/images/media/settings/'.$setts[0]->site_logo;
			
			$site_name = $setts[0]->site_name;
			
			
			
			
			$admin_email = $admindetails->email;
			$admin_name = $admindetails->name;
			
			$vendor_email = $vendor_details[0]->email;
			
			
			$datas = [
				'vendor_email' => $vendor_email, 'url' => $url,  'site_logo' => $site_logo, 'site_name' => $site_name, 'admin_name' => $admin_name, 'purchase_id' => $purchase_id, 'ord_id' => $ord_id
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
		
		
			
			
			
			Mail::send('admin.item_payment_approval', $datas , function ($message) use ($admin_email,$admin_name,$vendor_email,$sett_sender_name,$sett_sender_email,$lang)
			{
				$message->subject($this->call_translate( 1060, $lang));
				
				$message->from($sett_sender_email, $sett_sender_name);
	
				$message->to($vendor_email);
	
			}); 
						
						  
						  
		
		
		}
		else
		{
		   
		
		}
			
	}	
		
		
		/* payment approval */
		
		
		
		
		
		
		
		
		
		
		}				
		
							
						
		$get_details = DB::table('product_checkouts')
              
			       ->where('purchase_token', '=', $cid)
			   
                   ->get();
				   
			$user_details = DB::table('users')
              
			       ->where('id', '=', $get_details[0]->user_id)
			   
                   ->get();	   
				   
				   				
						
				$order_id = $cid;
				$name = $user_details[0]->name;
				$email = $user_details[0]->email;
				$phone = $user_details[0]->phone;			
				$amount = $get_details[0]->total;
				
				
						
		
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
            'site_logo' => $site_logo, 'site_name' => $site_name, 'name' => $name,  'email' => $email, 'phone' => $phone, 'amount' => $amount, 'url' => $url, 'order_id' => $order_id
        ];
		
		Mail::send('shop_email', $datas , function ($message) use ($admin_email,$email,$sett_sender_name,$sett_sender_email,$lang)
        {
            $message->subject($this->call_translate( 1063, $lang));
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($sett_sender_email);

        }); 
		
		
		
		
		Mail::send('shop_email', $datas , function ($message) use ($admin_email,$email,$sett_sender_name,$sett_sender_email,$lang)
        {
            $message->subject($this->call_translate( 1063, $lang));
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($email);

        }); 
		
		
		
		
		
		
	 
	  $data = array('cid' => $cid);
      return view('shop_success')->with($data);
	
	
	
	
	
	
	
	
	}
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
    
	
	
	public function paypal_success($cid) {
		
		
		 $booking = DB::table('booking')
              
			   ->where('book_id', '=', $cid)
			   
                ->get();
				
				
			
			$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();	
				
				
				
				
		
		 $bookingupdate = DB::table('booking')
						->where('book_id', '=', $cid)
						->update(['payment_status' => 'paid']);
						
		 
		 
				
				
		$ser_id=$booking[0]->services_id;
			$sel=explode("," , $ser_id);
			$lev=count($sel);
			$ser_name="";
			$sum="";
			$price="";		
		for($i=0;$i<$lev;$i++)
			{
				$id=$sel[$i];	
                
				
				
				$fet1 = DB::table('subservices')
								 ->where('subid', '=', $id)
								 ->get();
				$ser_name.=$fet1[0]->subname.'<br>';
				$ser_name.=",";				 
				
				
				
				$ser_name=trim($ser_name,",");
				
			}
			
		$booking_time=$booking[0]->book_time;
		if($booking_time>12)
		{
			$final_time=$booking_time-12;
			$final_time=$final_time."PM";
		}
		else
		{
			$final_time=$booking_time."AM";
		}		
			
         		
		$booking_id=$booking[0]->book_id;		
		$booking_date=$booking[0]->book_date;
		$total_amt=$booking[0]->total_amount;
		$currency = $setts[0]->site_currency;
		
		
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/media/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		$aid=1;
		$admindetails = DB::table('users')
		 ->where('id', '=', $aid)
		 ->first();
		
		$admin_email = $admindetails->email;
		$user_email = $booking[0]->book_email;
		
		$viewuser = DB::table('users')
		 ->where('email', '=', $user_email)
		 ->get();
		
		$shopid=$booking[0]->shop_id;
		
		$shopdetails = DB::table('shop')
		 ->where('shop_id', '=', $shopid)
		 ->get();
		 
		 $seller_email = $shopdetails[0]->email;
		
		$usernamer = $viewuser[0]->name;
		$userphone = $viewuser[0]->phone;
		
		
		$data = [
            'booking_id' => $booking_id, 'ser_name' => $ser_name, 'booking_date' => $booking_date, 'final_time' => $final_time, 'total_amt' => $total_amt,
			 'currency' => $currency, 'site_logo' => $site_logo, 'site_name' => $site_name, 'user_email' => $user_email, 'usernamer' => $usernamer, 'userphone' => $userphone
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
		
		
		
		
		
		Mail::send('payment_usermail', $data , function ($message) use ($admin_email,$user_email,$sett_sender_name,$sett_sender_email)
        {
            $message->subject('Payment Details');
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($user_email);

        }); 
		
		
		
		
		
		Mail::send('payment_adminmail', $data , function ($message) use ($admin_email,$sett_sender_name,$sett_sender_email)
        {
            $message->subject('New Payment Received');
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($sett_sender_email);

        }); 
		
		
		
		
		Mail::send('payment_sellermail', $data , function ($message) use ($admin_email,$seller_email,$sett_sender_name,$sett_sender_email)
        {
            $message->subject('New Payment Received');
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($seller_email);

        }); 
		
		
		
		
		
		
	 
	  $data = array('cid' => $cid);
     return view('success')->with($data);
	  
   }
   
   
   
  
	
	
	
	
	
    public function avigher_localbank(Request $request)
	{
	
	
	   $default = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		
     
	    $data = $request->all();
		
		$cid = $data['cid'];
		
						
		
		
		$orderupdate = DB::table('product_orders')
						->where('purchase_token', '=', $cid)
						->where('status', '=', 'pending')
						->update(['status' => 'completed']);
		 $checkoutupdate = DB::table('product_checkouts')
						->where('purchase_token', '=', $cid)
						->where('payment_status', '=', 'pending')
						->update(['payment_status' => 'completed']);
		
		
		$get_viewr = DB::table('product_orders')
		->where('purchase_token', '=', $cid)
		->where('status', '=', 'completed')
		->count();
		
		
		
		$view_orders = DB::table('product_orders')
						->where('purchase_token', '=', $cid)
						->where('status', '=', 'completed')
						->get();
		
		foreach($view_orders as $views)
		{
		
		$ord_id = $views->ord_id;
		
		$start_date = date("Y-m-d");
		if($views->licence_type=="regular_price_six_month")
		{
		   $end_date = date('Y-m-d', strtotime('+6 month'));
		}
		else if($views->licence_type=="regular_price_one_year")
		{
		   $end_date = date('Y-m-d', strtotime('+12 month'));
		}
		else if($views->licence_type=="extended_price_six_month")
		{
		   $end_date = date('Y-m-d', strtotime('+6 month'));
		}
		else if($views->licence_type=="extended_price_one_year")
		{
		   $end_date = date('Y-m-d', strtotime('+12 month'));
		}
		
		
		DB::update('update product_orders set payment_type="localbank",license_start_date="'.$start_date.'",license_end_date="'.$end_date.'" where status="completed" and ord_id = ?', [$ord_id]);
		
		
		
		}				
		
							
						
		$get_details = DB::table('product_checkouts')
              
			       ->where('purchase_token', '=', $cid)
			   
                   ->get();
				   
			$user_details = DB::table('users')
              
			       ->where('id', '=', $get_details[0]->user_id)
			   
                   ->get();	   
				   
				   				
						
				$order_id = $cid;
				$name = $user_details[0]->name;
				$email = $user_details[0]->email;
				$phone = $user_details[0]->phone;			
				$amount = $get_details[0]->total;
				
				
						
		
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
		
		
		
		
		$datas = [
            'site_logo' => $site_logo, 'site_name' => $site_name, 'name' => $name,  'email' => $email, 'phone' => $phone, 'amount' => $amount, 'url' => $url, 'order_id' => $order_id
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
		
		
			
		
		Mail::send('shop_email', $datas , function ($message) use ($admin_email,$email,$sett_sender_name,$sett_sender_email,$lang)
        {
            $message->subject($this->call_translate( 1063, $lang));
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($sett_sender_email);

        }); 
		
		
		
		
		Mail::send('shop_email', $datas , function ($message) use ($admin_email,$email,$sett_sender_name,$sett_sender_email,$lang)
        {
            $message->subject($this->call_translate( 1063, $lang));
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($email);

        }); 
		
		
		
		
		
		
	 
	  $data = array('cid' => $cid);
      /*return view('shop_success')->with($data);*/
	  
	  return redirect('/localbank/'.$cid);
	
		
	 
	} 
		
	
	public function avigher_localbank_view($cid)
	{
	   $data = array('cid' => $cid);
	  return view('localbank')->with($data);
	
	}
	
	
	
}
