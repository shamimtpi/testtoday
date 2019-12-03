<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use File;
use Image;
use URL;
use Mail;
use Illuminate\Validation\Rule;
use Cookie;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
	
	
        $userid = Auth::user()->id;
		$editprofile = DB::select('select * from users where id = ?',[$userid]);
		
		
		/* user meta */
		$check_user_meta = DB::table('user_metas')
		        ->where('user_id', '=' , $userid)
				->where('user_meta_key', '=' , "profile_details_status")
		        
				->count();
		if(!empty($check_user_meta))
		{
		   
		    $user_meta_well = DB::table('user_metas')
		        ->where('user_id', '=' , $userid)
				->where('user_meta_key', '=' , "profile_details_status")
		        
				->count();
				
			if(!empty($user_meta_well))
			{	
		   $user_meta = DB::table('user_metas')
		        ->where('user_id', '=' , $userid)
				->where('user_meta_key', '=' , "profile_details_status")
		        
				->get();
			$profile_status = $user_meta[0]->user_meta_value;
			}
			else
			{
			$profile_status = "";
			}	
		}
		else
		{
		  $profile_status = "";
		}
		
		
		
		
		
		$check_user_meta_new = DB::table('user_metas')
		        ->where('user_id', '=' , $userid)
				->where('user_meta_key', '=' , "buyers_update_approval")
		        
				->count();
		if(!empty($check_user_meta_new))
		{
		   
		    $user_meta_we = DB::table('user_metas')
		        ->where('user_id', '=' , $userid)
				->where('user_meta_key', '=' , "buyers_update_approval")
		        
				->count();
				
			if(!empty($user_meta_we))
			{	
		   $user_meta_approval = DB::table('user_metas')
		        ->where('user_id', '=' , $userid)
				->where('user_meta_key', '=' , "buyers_update_approval")
		        
				->get();
			$buyers_update_approval = $user_meta_approval[0]->user_meta_value;
			}
			else
			{
			$buyers_update_approval = "";
			}	
		}
		else
		{
		  $buyers_update_approval = "";
		}
		
		
		
		
		
		$check_user_well = DB::table('user_metas')
		        ->where('user_id', '=' , $userid)
				->where('user_meta_key', '=' , "profile_badges_status")
		        
				->count();
		if(!empty($check_user_well))
		{
		   
		    $user_meta_well = DB::table('user_metas')
		        ->where('user_id', '=' , $userid)
				->where('user_meta_key', '=' , "profile_badges_status")
		        
				->count();
				
			if(!empty($user_meta_well))
			{	
		   $user_meta = DB::table('user_metas')
		        ->where('user_id', '=' , $userid)
				->where('user_meta_key', '=' , "profile_badges_status")
		        
				->get();
			$profile_badges = $user_meta[0]->user_meta_value;
			}
			else
			{
			$profile_badges = "";
			}	
		}
		else
		{
		  $profile_badges = "";
		}
		
		/* user meta */
		
		
		$viewpost = DB::table('posts')
		        ->where('post_type', '=' , 'comment')
				->where('post_user_id', '=' , $userid)
		        
				->count();
				
				
		$countries_count = DB::table('countries')
		->orderBy('country_name', 'asc')
		->count();		
		
		$data = array('editprofile' => $editprofile, 'viewpost' => $viewpost, 'profile_status' => $profile_status, 'buyers_update_approval' => $buyers_update_approval, 'countries_count' => $countries_count, 'profile_badges' => $profile_badges, 'cany_check_value' => $cany_check_value);
		return view('dashboard')->with($data);
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
    	
	
	
	
	
	public function avigher_contact_vendor(Request $request)
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
		
		$phone = $data['phone'];
		$msg = $data['msg'];
		
		$vendor_id = $data['vendor_id'];
		
		
		
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
	
	   
	   $url = URL::to("/");
		
		$site_logo=$url.'/local/images/media/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		
		$seller_details = DB::table('users')
		 ->where('id', '=', $vendor_id)
		 ->get();
		
		
		$slug = $seller_details[0]->user_slug;
		
		$seller_email = $seller_details[0]->email;
		
		$user_email = $data['email'];
		
		$data = [
            'slug' => $slug, 'url' => $url, 'site_logo' => $site_logo, 'site_name' => $site_name, 'name' => $name, 'user_email' => $user_email, 'phone' => $phone, 'msg' => $msg, 'seller_email' => $seller_email
        ];
		
		
		 Mail::send('seller_contactmail', $data , function ($message) use ($user_email,$seller_email,$name,$lang)
        {
            $message->subject($this->call_translate( 862, $lang));
			
            $message->from($user_email, $name);

            $message->to($seller_email);

        });  
		
		
		
		return back()->with('success', $this->call_translate( 964, $lang));
		
		
		
		
		
	
	}
	
	
	
	
	
	
	
	public function mycomments()
    {
	$userid = Auth::user()->id;
	
	$viewpost = DB::table('posts')
		        ->where('post_type', '=' , 'comment')
				->where('post_user_id', '=' , $userid)
		        
				->get();
				
	$postcount = DB::table('posts')
		        ->where('post_type', '=' , 'comment')
				->where('post_user_id', '=' , $userid)
		        
				->count();			
				
	$data = array('viewpost' => $viewpost, 'postcount' => $postcount);
	return view('my-comments')->with($data);
	}
	
	
	public function mycomments_destroy($id) {
		
		
	   
	   DB::delete('delete from posts where post_type="comment" and post_id = ?',[$id]);
     
	   
      return back();
      
   }
	
	
	
	
	
	
	
	public function avigher_logout()
	{
		Auth::logout();
       return back();
	}
	
	
	public function avigher_deleteaccount()
	{
		$userid = Auth::user()->id;
		
		
		
		
		
		
	  DB::delete('delete from posts where post_type="comment" and post_user_id = ?',[$userid]);
	  
		
		
		DB::delete('delete from users where id!=1 and id = ?',[$userid]);
		return back();
	}
	
	
	public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	} 
	
	 protected function avigher_edituserdata(Request $request)
    {
       



		$default = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		
		 $this->validate($request, [

        		'name' => 'required',

        		'email' => 'required|email'

        		
				
				

        	]);
         
		 $data = $request->all();
			
         $id=$data['id'];
        			
		$input['email'] = ('email');
       
		$input['name'] = $request->input('name');
		
		
		$rules = array(
        
       
		
        
		
		
		'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id, 'id')->where(function($query)  {
                  $query->where('delete_status', '=', '');
               })
               ],
			   
			   
		'name' => [
                'required',
                'regex:/^[\w-]*$/',
                'max:255',
                Rule::unique('users')->ignore($id, 'id')->where(function($query) {
                  $query->where('delete_status', '=', '');
               })
               ],	   
		
		
		'photo' => 'max:1024|mimes:jpg,jpeg,png',
		'phone' => 'required|max:255|unique:users,phone,'.$id
		
		
        );
		
		
		$messages = array(
            
            'email' => 'The :attribute field is already exists',
            'name' => 'The :attribute field must only be letters and numbers (no spaces)'
			
        );
		
		
		
		
		
		 $validator = Validator::make($request->all(), $rules, $messages);

		

		if ($validator->fails())
		{
			 $failedRules = $validator->failed();
			 
			return back()->withErrors($validator);
		}
		else
		{ 
		  

		$name=$data['name'];
		$email=$data['email'];
		$password=bcrypt($data['password']);
		
		
		
		$phone=$data['phone'];
		
		
		$currentphoto=$data['currentphoto'];
		
		$image = $request->file('photo');

        if($image!="")
		{	
            $userphoto="/media/userphoto/";
			$delpath = base_path('images'.$userphoto.$currentphoto);
			File::delete($delpath);	
			$filename  = time() . '210.' . $image->getClientOriginalExtension();
            
            $path = base_path('images'.$userphoto.$filename);
      
                Image::make($image->getRealPath())->resize(200, 200)->encode('jpg', 75)->save($path);

				$savefname=$filename;
		}
        else
		{  
		    if($currentphoto=="")
			{
			$savefname = "";
			}
			else
			{
			$savefname=$currentphoto;
			}
		}
		
		
		
		
		
		
		$currentbanner=$data['currentbanner'];
		
		
		$profile_banner = $request->file('profile_banner');
        if($profile_banner!="")
		{	
            $userphoto="/media/userphoto/";
			$delpath = base_path('images'.$userphoto.$currentbanner);
			File::delete($delpath);	
			$filenamey  = time() . '65.' . $profile_banner->getClientOriginalExtension();
            
            $pathy = base_path('images'.$userphoto.$filenamey);
      
                Image::make($profile_banner->getRealPath())->resize(1140, 370)->encode('jpg', 50)->save($pathy);
				$savey=$filenamey;
		}
        else
		{
		    if($currentphoto=="")
			{
			$savey = "";
			}
			else
			{
		 
			$savey=$currentbanner;
			}
		}
		
		
		
		
		
		
		
					
		
		
		if($data['password']!="")
		{
			$passtxt=$password;
		}
		else
		{
			$passtxt=$data['savepassword'];
		}
		
		$admin=$data['usertype'];
		
		if($data['gender']!="")
		{
		    $gendor = $data['gender'];
		}
		else
		{
		   $gendor = $data['save_gender'];
		}
		
		
		if($data['country']!="")
		{
		   $country = $data['country'];
		}
		else
		{
		 $country = "";
		}
		
		if($data['address']!="")
		{
		  $address = $data['address'];
		}
		else
		{
		  $address = "";
		}
		
		if($data['about']!="")
		{
		   $about = $data['about'];
		}
		else
		{
		  $about = "";
		}
		
		
		if(!empty($data['profile_details_status']))
		{
		
		   $check_user_meta =  DB::table('user_metas')
		        				->where('user_id', '=' , $id)
				                ->where('user_meta_key', '=' , 'profile_details_status')
		                        ->count();
			if(!empty($check_user_meta))
			{
			   DB::update('update user_metas set user_meta_value="'.$data['profile_details_status'].'" where user_meta_key="profile_details_status" and user_id = ?', [$id]);
			}
			else
			{
			DB::insert('insert into user_metas (user_id,user_meta_key,user_meta_value) values (?, ?, ?)', [$id,"profile_details_status",$data['profile_details_status']]);
			
			}					
		
		  
		}
		
		
		if(!empty($data['profile_badges_status']))
		{
		
		   $check_user_meta =  DB::table('user_metas')
		        				->where('user_id', '=' , $id)
				                ->where('user_meta_key', '=' , 'profile_badges_status')
		                        ->count();
			if(!empty($check_user_meta))
			{
			   DB::update('update user_metas set user_meta_value="'.$data['profile_badges_status'].'" where user_meta_key="profile_badges_status" and user_id = ?', [$id]);
			}
			else
			{
			DB::insert('insert into user_metas (user_id,user_meta_key,user_meta_value) values (?, ?, ?)', [$id,"profile_badges_status",$data['profile_badges_status']]);
			
			}					
		
		  
		}
		
		
		
		
		
		
		if(!empty($data['buyers_update_approval']))
		{
		
		   $check_user_new =  DB::table('user_metas')
		        				->where('user_id', '=' , $id)
				                ->where('user_meta_key', '=' , 'buyers_update_approval')
		                        ->count();
			if(!empty($check_user_new))
			{
			   DB::update('update user_metas set user_meta_value="'.$data['buyers_update_approval'].'" where user_meta_key="buyers_update_approval" and user_id = ?', [$id]);
			}
			else
			{
			DB::insert('insert into user_metas (user_id,user_meta_key,user_meta_value) values (?, ?, ?)', [$id,"buyers_update_approval",$data['buyers_update_approval']]);
			
			}					
		
		  
		}
		
		
		
		
		DB::update('update posts set post_email="'.$email.'" where post_type="comment" and post_user_id = ?', [$id]);
		
		
		
		
		/* seo */
		
		$check_sett_seo = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 21)
				->where('sett_meta_key', '=' , "site_seo_slug")
		        
				->count();
		if(!empty($check_sett_seo))
		{
		   
		    $sett_meta_seo = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 21)
				->where('sett_meta_key', '=' , "site_seo_slug")
		        
				->count();
				
			if(!empty($sett_meta_seo))
			{	
		   $sett_meta_chat =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 21)
				->where('sett_meta_key', '=' , "site_seo_slug")
		        
				->get();
			$site_seo = $sett_meta_chat[0]->sett_meta_value;
			}
			else
			{
			$site_seo = "";
			}	
		}
		else
		{
		  $site_seo = "";
		}
	   
	   
	   
	   if($site_seo == "no")
	   {
	      $pther = str_replace(" ","-",$name);
	   }
	   else
	   {
	      $pther = $this->clean($name);
	   }
	   
	   
	   
	   /* seo */
		
		
		
		
		DB::update('update users set name="'.$name.'",user_slug="'.$pther.'",email="'.$email.'",password="'.$passtxt.'",phone="'.$phone.'",gender="'.$gendor.'",photo="'.$savefname.'",admin="'.$admin.'",country="'.$country.'",address="'.$address.'",about="'.$about.'",profile_banner="'.$savey.'" where id = ?', [$id]);
		
		
		
			return back()->with('success', $this->call_translate( 967, $lang));
        }
		
		
		
		
    }

    public function profile_title(Request $request){
       $profile_title= $request->input('profile_title');
       $user_id      = $request->input('user_id');
       DB::table('users')->where('id',$user_id)->update(['profile_title' => $profile_title]);
      return redirect()->back();

    }
	
	
}
