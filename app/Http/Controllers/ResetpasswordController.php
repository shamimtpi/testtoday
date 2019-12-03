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
use Cookie;

class ResetpasswordController extends Controller
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
	
	protected function avigher_reset_view($id)
    {
       
	   $data = array('id' => $id);
	   return view('reset-password')->with($data);
	   
	}
	
	
	
	 protected function avigher_reset_password(Request $request)
    {
       
		
		$default = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		
		
		 $this->validate($request, [

        		

        		'email' => 'required|email'
                
        		
				
				

        	]);
         
		 $data = $request->all();
			
         
        			
		$input['email'] = $request->input('email');
       
		$id = $data['email'];
		$password_token = $data['password_token'];
		$password = bcrypt($data['password']);
		$new_pass = $data['password'];
		
		$rules = array(
        
       
		
        'email'=>'required|email|unique:users,email,'.$id
		
		
		
        );
		
		
		$messages = array(
            
            'email' => $this->call_translate( 979, $lang)
            
			
        );
		
		
		
		
		
		 $validator = Validator::make($request->all(), $rules, $messages);

		

		if ($validator->fails())
		{
		
		    $email=$data['email'];
			
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
		
		
		$count = DB::table('users')
		 ->where('email', '=', $email)
		 ->where('remember_token', '=', $password_token)
		 ->count();
		 
		 if($count == 1)
		 {
		    DB::update('update users set password="'.$password.'" where email = "'.$email.'" and remember_token = ?', [$password_token]);
		
		    $getpassword = DB::table('users')
			->where('email', '=', $email)
			->get();
			
			$token = $getpassword[0]->remember_token;
			$pass = $getpassword[0]->password;
			
				$datas = [
				 'email' => $email, 'token' => $token, 'new_pass' => $new_pass, 'site_logo' => $site_logo, 'site_name' => $site_name, 'url' => $url
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
		
		
		
			
		
			Mail::send('resetemail', $datas , function ($message) use ($admin_email,$email,$sett_sender_name,$sett_sender_email,$lang)
			{
				$message->subject($this->call_translate( 811, $lang));
				
				$message->from($sett_sender_email, $sett_sender_name);
	
				$message->to($email);
	
			}); 
			
			return back()->with('success', $this->call_translate( 1066, $lang));
			
		
		 }
		 
		 else
		 {
		     return back()->with('error', $this->call_translate( 1069, $lang));
		 }
		
		
		
		
		
		
		
		
		
		
		
			
			
		
		
	   
	     
		
			 
		}
		else
		{ 
		  

		$failedRules = $validator->failed();
			 
			return back()->with('error', $this->call_translate( 979, $lang));
		
        }
		
		
		
		
    }
	
	
}
