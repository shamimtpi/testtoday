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
use Session;

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use Cookie;
use Twocheckout;
use Twocheckout_Charge;
use Twocheckout_Error;


class twocheckoutController extends Controller
{
    
	
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
	
	
	
	
	public function payment_details(Request $request) 
	{
	
	$default = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		
	
	    $data = $request->all();
		
		include(app_path() . '/2Checkout/Twocheckout.php');
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$check_2checkout = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 30)
				->where('sett_meta_key', '=' , "two_checkout_mode")
		        
				->count();
		if(!empty($check_2checkout))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 30)
				->where('sett_meta_key', '=' , "two_checkout_mode")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 30)
				->where('sett_meta_key', '=' , "two_checkout_mode")
		        
				->get();
			$two_checkout_mode = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$two_checkout_mode = "";
			}	
		}
		else
		{
		  $two_checkout_mode = "";
		}
		
		
		
		$check_2checkout_acc = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 31)
				->where('sett_meta_key', '=' , "two_checkout_account")
		        
				->count();
		if(!empty($check_2checkout_acc))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 31)
				->where('sett_meta_key', '=' , "two_checkout_account")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 31)
				->where('sett_meta_key', '=' , "two_checkout_account")
		        
				->get();
			$two_checkout_account = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$two_checkout_account = "";
			}	
		}
		else
		{
		  $two_checkout_account = "";
		}
		
		
		
		$check_2checkout_private = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 33)
				->where('sett_meta_key', '=' , "two_checkout_private")
		        
				->count();
		if(!empty($check_2checkout_private))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 33)
				->where('sett_meta_key', '=' , "two_checkout_private")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 33)
				->where('sett_meta_key', '=' , "two_checkout_private")
		        
				->get();
			$two_checkout_private = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$two_checkout_private = "";
			}	
		}
		else
		{
		  $two_checkout_private = "";
		}
		
		
		$user_details = DB::table('users')
		->where('id', '=', Auth::user()->id)
		->get();
		
		Twocheckout::privateKey($two_checkout_private); 
		Twocheckout::sellerId($two_checkout_account); 
		Twocheckout::sandbox($two_checkout_mode); 
		
		try {
			$charge = Twocheckout_Charge::auth(array(
				"merchantOrderId" => $data['order_id'],
				"token"      => $data['token'],
				"currency"   => $setts[0]->site_currency,
				"total"      => $data['amount'],
				"billingAddr" => array(
					"name" => $user_details[0]->name,
					"addrLine1" => $data['address'],
					"city" => $data['city'],
					"state" => $data['state'],
					"zipCode" => $data['postcode'],
					"country" => $data['country'],
					"email" => $user_details[0]->email,
					"phoneNumber" => $user_details[0]->phone
				)
			));
		
			
			
			
			if ($charge['response']['responseCode'] == 'APPROVED')
			{
		    $transaction_id = $charge['response']['transactionId'];
			$cid = $data['order_id'];
			
			
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
				
				
				DB::update('update product_orders set payment_type="2checkout",license_start_date="'.$start_date.'",license_end_date="'.$end_date.'",payment_token="'.$transaction_id.'" where status="completed" and ord_id = ?', [$ord_id]);
				
				
				
		
		
		
		
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
				'vendor_email' => $vendor_email, 'url' => $url,  'site_logo' => $site_logo, 'site_name' => $site_name, 'admin_name' => $admin_name, 'purchase_id' => $purchase_id, 'ord_id' => $ord_id
			];
			
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
		
			
		
			
			 return redirect('/twocheckout-success/'.$transaction_id);
			
		}
		else
		{
			return redirect('/cancel');
		}
			
			
			
			
			
			
			
			
			
		
			
			
		
		
			
		} catch (Exception $e) {
		
		return redirect('/cancel');
			
		}

		
	}
	
	
	
	
	
   
	
	public function avigher_view_twocheckout($transaction_id)
	{
	
	   
	   $data = array('transaction_id' => $transaction_id);
     return view('twocheckout-success')->with($data);
	   
	}
	
	
	
	 
	 
	 
	
	
	
}
