<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

use App\Models\lang\codepopular_lang;
use App\Models\settings\setting;

use Mail;
use Auth;
use Crypt;
use URL;
use Cookie;
use Redirect;
use Image;


class PageController extends Controller
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
	 
	 public function php_editor()
	 {
	    return view('phpeditor.index');
	 }
	 
	 
	 public function avigher_test_form(Request $request)
	{
	$url = URL::to("/");
	   $data = $request->all();
	   
	   
	   $videofile = $request->file('profile_banner'); 
		 if(isset($videofile))
		 { 
		 $filenamme = 'zzz_'.time() . '.' . $videofile->getClientOriginalName();
		
		 $videoformat = base_path('images/media/userphoto/'); 
		 $videofile->move($videoformat,$filenamme); 
		 $videoname = $filenamme; 
		 $img = Image::make($url.'/local/images/media/userphoto/'.$filenamme);
		 $img->insert($url.'/local/images/digi_watermark.png','center');
		
	
		 $img->save(base_path('images/media/userphoto/'.$filenamme));
		 }
		 else
		 {
		    
			$videoname = "";
			
		 }
	   
	   
	   
		
		
		return back();
	 
	 }
	 
	 
	 
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
	 public function sampleview()
	{
		return view('lang');
	}
	
	
	public function sample($id)
    { 
	    
		
		
		Cookie::queue('lang', $id, 1115);

        return back()->withCookie('lang');
		
		/*return Redirect::route('index')->withCookie('lang');*/
	}
	 
	 
	 
	 public function avigher_viewpage($id)
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
		
		
	   $page = DB::table('pages')
		       ->where('post_slug', '=', $id)
			   ->where('lang_code','=',$lang)
			   ->get();
		$page_cnt = DB::table('pages')
		       ->where('post_slug', '=', $id)
			   ->where('lang_code','=',$lang)
			   ->count();	   
			   
			   
		$setid=1;
		$setting = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		$users = DB::select('select * from users where id = ?',[$setid]);	   
		$data = array('page' => $page, 'setting' => $setting, 'users' => $users, 'page_cnt' => $page_cnt, 'cany_check_value' => $cany_check_value);	   
	   return view('page')->with($data);
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
    	
	
	 
	 
	 
    public function avigher_about_us()
    {
       
		$about_id = 1;
		$about_us = DB::table('pages')
		       ->where('page_id', '=', $about_id)
			   ->get();
	
		$data = array('about_us' => $about_us);
            return view('about-us')->with($data);
    }
	
	public function avigher_404()
    {
		return view('404');
	}
	
	public function avigher_terms()
    {
       
		$term_id = 8;
		$terms = DB::table('pages')
		       ->where('page_id', '=', $term_id)
			   ->get();
		
		$data = array('terms' => $terms);
            return view('terms-of-use')->with($data);
    }
	
	
	
	public function avigher_privacy()
    {
       
		$privacy_id = 9;
		$privacy = DB::table('pages')
		       ->where('page_id', '=', $privacy_id)
			   ->get();
	
		$data = array('privacy' => $privacy);
            return view('privacy-policy')->with($data);
    }
	
	
	public function avigher_support()
    {
       
		$support_id = 6;
		$support = DB::table('pages')
		       ->where('page_id', '=', $support_id)
			   ->get();
	
		$data = array('support' => $support);
            return view('support')->with($data);
    }
	
	
	public function avigher_faq()
    {
       
		$faq_id = 7;
		$faq = DB::table('pages')
		       ->where('page_id', '=', $faq_id)
			   ->get();
	
		$data = array('faq' => $faq);
            return view('faq')->with($data);
    }
	
	
	
	
	
	public function avigher_contact()
    {
       
		$contact_id = 4;
		$contact = DB::table('pages')
		       ->where('page_id', '=', $contact_id)
			   ->get();
		$setid=1;
		$setting = setting::where('id',$setid)->get();
		$users = DB::select('select * from users where id = ?',[$setid]);	   
	
		$data = array('contact' => $contact, 'setting' => $setting, 'users' => $users);
            return view('contact-us')->with($data);
    }
	
	public function avigher_donate_now()
    {
	   $did = 5;
	   $donate = DB::table('pages')
		       ->where('page_id', '=', $did)
			   ->get();
		$setid=1;
		$setting = DB::table('settings')
		->where('id', '=', $setid)
		->get();	   
	    $data = array('donate' => $donate, 'setting' => $setting);
	   return view('donate')->with($data);
	}
	
	
	
	// public function avigher_howit()
 //    {
       
	// 	$how_id = 5;
	// 	$how = DB::table('pages')
	// 	       ->where('page_id', '=', $how_id)
	// 		   ->get();
	
	// 	$data = array('how' => $how);
 //            return view('how-it-works')->with($data);
 //    }
	
	
	
	
	public function avigher_safety()
    {
       
		$safety_id = 6;
		$safety = DB::table('pages')
		       ->where('page_id', '=', $safety_id)
			   ->get();
	
		$data = array('safety' => $safety);
            return view('safety')->with($data);
    }
	
	
	
	public function avigher_guide()
    {
       
		$guide_id = 7;
		$guide = DB::table('pages')
		       ->where('page_id', '=', $guide_id)
			   ->get();
	
		$data = array('guide' => $guide);
            return view('service-guide')->with($data);
    }
	
	
	
	public function avigher_topages()
    {
       
		$topages_id = 8;
		$topages = DB::table('pages')
		       ->where('page_id', '=', $topages_id)
			   ->get();
	
		$data = array('topages' => $topages);
            return view('how-to-pages')->with($data);
    }
	
	
	
	public function avigher_stories()
    {
       
		$stories_id = 9;
		$stories = DB::table('pages')
		       ->where('page_id', '=', $stories_id)
			   ->get();
	
		$data = array('stories' => $stories);
            return view('success-stories')->with($data);
    }
	
	
	
	public function avigher_donate_payment(Request $request)
	{
	
	   $data = $request->all();
		
		$name = $data['name'];
		$email = $data['email'];
		$phone_no = $data['phone_no'];
		$msg = $data['msg'];
		$amount = $data['amount'];
		$status = "Pending";
		$currency = $data['currency'];
		$paypal_url = $data['paypal_url'];
		$paypal_id = $data['paypal_id'];
		$order_no = $data['order_no'];
		$token = $data['token'];
		$donate_date = date("Y-m-d H:i:s");
		
		$count = DB::table('donatenow')
		         ->where('token', '=', $token)
				 ->where('orderno', '=', $order_no)
				 ->where('payment_status', '=', $status)
				 ->count();
		
		if($count==0)
		{
		DB::insert('insert into donatenow (	orderno,donate_date,name,email,phone,amount,message,token,payment_status) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$order_no,$donate_date,$name,$email,$phone_no,$amount,$msg,$token,$status]);
		}
		else
		{
				DB::update('update donatenow set donate_date="'.$donate_date.'",name="'.$name.'",email="'.$email.'",phone="'.$phone_no.'",amount="'.$amount.'",message="'.$msg.'" where payment_status="'.$status.'" and token="'.$token.'"');
		}
		
		
		
		$ddata = array('name' => $name, 'email' => $email, 'phone_no' => $phone_no, 'amount' => $amount, 'currency' => $currency, 'paypal_url' => $paypal_url, 'paypal_id' => $paypal_id, 'order_no' => $order_no);
            return view('payment')->with($ddata);
		
	
	}
	
	
	public function avigher_mailsend(Request $request)
	{
		
		
		$default = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		
		$data = $request->all();
		
		
		$rules = array(
        
       
		  'g-recaptcha-response' => 'required|captcha',
		
        );
		
		
		$messages = array(
            
            
			
        );

		
		$validator = Validator::make($request->all(), $rules, $messages);
		
		
		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			return back()->withErrors($validator);
		}
		else
		{ 
		
		
		$name = $data['name'];
		$email = $data['email'];
		$phone_no = $data['phone_no'];
		$msg = $data['msg'];
		
		
		
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
		
		$chk_count = DB::table('contact_uses')
		         ->where('cont_email', '=', $email)
				 ->count();
				 
		$cont_date = date("m-d-Y h:i:s a");		 
		
		$success = DB::insert('insert into contact_uses (cont_name,cont_email,cont_phone,cont_date,cont_message) values (?, ?,?, ?,?)', [$name,$email,$phone_no,$cont_date,$msg]);
		
		
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
            'name' => $name, 'email' => $email, 'phone_no' => $phone_no, 'msg' => $msg, 'site_logo' => $site_logo, 'site_name' => $site_name, 'admin_name' => $admin_name, 'cont_date' => $cont_date
        ];
		
		Mail::send('contactemail', $datas , function ($message) use ($admin_email,$name,$email,$admin_name,$sett_sender_name,$sett_sender_email,$lang)
        {
            $message->subject($this->call_translate( 1054, $lang));
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($sett_sender_email);

        }); 
		
		
		
		if($success){
		return redirect()->back()->with('csuccess', $this->call_translate( 1021, $lang));
		
		}
		else
		{
		return redirect()->back()->with('cerror', $this->call_translate( 1057, $lang));
		
		}
		
		}
		
		
		
	}
	
	
	
	
}
