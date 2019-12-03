<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Mail;
use Auth;
use URL;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cookie;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            
			'name' => [
                'required',
                'regex:/^[\w-]*$/',
                'max:255',
                Rule::unique('users')->where(function($query) {
                  $query->where('delete_status', '=', '');
               })
               ],	   
        
			'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->where(function($query) {
                  $query->where('delete_status', '=', '');
               })
               ],
			
			'phone' => 'required|string|unique:users|max:255',
            'password' => 'required|string|min:6|confirmed',
			'gender' => 'required|string|max:255',
			 'g-recaptcha-response' => 'required|captcha',
			
			
        ]);
    }
	
	
	public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	} 

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    
	protected function register(Request $request)
    {



    	
	    if(!empty(Cookie::get('referral')))
		{
	    $referred_by = Cookie::get('referral');
        }
		else
		{
		$referred_by = "";
		}
        $this->validate($request, [

        		'name' => 'required',

        		'email' => 'required|email',

        		'password' => 'required'
				
				

        	]);
        $data = $request->all();
		
		$rules = array(
        
       
		'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->where(function($query) {
                  $query->where('delete_status', '=', '');
               })
               ],
			   
			   
		'name' => [
                'required',
                'regex:/^[\w-]*$/',
                'max:255',
                Rule::unique('users')->where(function($query) {
                  $query->where('delete_status', '=', '');
               })
               ],	   
        
		
		'password' => 'required|min:6|confirmed',
			'gender' => 'required|string|max:255',
			'usertype' => 'required|string|max:255',
		     'g-recaptcha-response' => 'required|captcha',
		
        );
		
		
		$messages = array(
            
            'email' => 'The :attribute field is already exists',
            'name' => 'The :attribute field must only be letters and numbers (no spaces)'
			
        );

		
		$validator = Validator::make($request->all(), $rules, $messages);
		
		
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
	      $pther = str_replace(" ","-",$data['name']);
	   }
	   else
	   {
	      $pther = $this->clean($data['name']);
	   }
	   
	   
	   
	   /* seo */
		
		
		
		 

        if ($validator->fails())
		{
			$failedRules = $validator->failed();
			return back()->withErrors($validator);
		}
		else
		{ 

            $data = $request->all();
			
			$name = $data['name'];
			$user_slug = $pther;
			$email = $data['email'];
			
			$pass = bcrypt($data['password']);
			$keyval = uniqid();
			$phoneno = $data['phone'];
			$gender = $data['gender'];
			$usertype = $data['usertype'];
			$created_at = date('Y-m-d H:i:s');
			
			
			
			$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		
			
			$confirmation = 0;
			
			DB::insert('insert into users (name,user_slug,email, password,confirmation,confirm_key,gender, phone,admin, referred_by, created_at) values (?, ?, ?, ?, ?, ?,?, ?,?, ?, ?)', [$name,$pther,$email,$pass,$confirmation,$keyval,$gender,$phoneno,$usertype,$referred_by,$created_at]);
			
			
			/* referral commission */
			
			$sett_meta_weldone = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 5)
				->where('sett_meta_key', '=' , "referral_amount")
		        
				->count();
				
			if(!empty($sett_meta_weldone))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 5)
				->where('sett_meta_key', '=' , "referral_amount")
		        
				->get();
			$referral_amount = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$referral_amount = 0;
			}
			
			
			$referred_user =  DB::table('users')->where('id', '=', $referred_by)->count();
			if(!empty($referred_user))
			{
			   $referred =  DB::table('users')->where('id', '=', $referred_by)->get();
			   $old_amount = $referred[0]->wallet;
			   
			   if(!empty($referred[0]->referral_amount))
			   {
			   $ref_amount = $referred[0]->referral_amount;
			   }
			   else
			   {
			     $ref_amount = 0;
			   }
			   
			}
			else
			{
			   $old_amount = 0;
			   $ref_amount = 0;
			}
			
			$total_referral = $old_amount + $referral_amount;
			$total_earn = $ref_amount + $referral_amount;
			
			
			DB::update('update users set wallet="'.$total_referral.'",referral_amount="'.$total_earn.'" where id = ?', [$referred_by]);
			
			
			/* referral commission */
			
			
			
				
			$admin_idd=1;
		
		$admin_email = DB::table('users')
                ->where('id', '=', $admin_idd)
                ->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/media/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		$adminemail = $admin_email[0]->email;
		
		$adminname = $admin_email[0]->name;
		
		$datas = [
            'name' => $name, 'email' => $email, 'keyval' => $keyval, 'site_logo' => $site_logo,
			'site_name' => $site_name, 'url' => $url
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
		
		
		
		
		Mail::send('confirm_mail', $datas , function ($message) use ($adminemail,$adminname,$email,$sett_sender_name,$sett_sender_email)
        {
		
		
		
		
            $message->subject('Email Confirmation for Registration');
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($email);

        }); 
		
		
			
			return redirect('login')->with('success', 'We sent you an activation code. Check your email and click on the link to verify.');
			

        }
		
	
	
	}
	
   
   
   
	
	
	
	
	protected function create(array $data)
    {
		


		if(!empty(Cookie::get('referral')))
		{
	    $referred_by = Cookie::get('referral');
        }
		else
		{
		$referred_by = "";
		}
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		
		
		$name = $data['name'];
		$email = $data['email'];
		$pass = bcrypt($data['password']);
			$phoneno = $data['phone'];
			$gender = $data['gender'];
			$usertype = $data['usertype'];
			$created_at = date('Y-m-d H:i:s');
		
		
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
	      $pther = str_replace(" ","-",$data['name']);
	   }
	   else
	   {
	      $pther = $this->clean($data['name']);
	   }
	   
	   
	   
	   /* seo */
		
		
		
		
		
		$keyval = uniqid();
		
        return User::create([
            'name' => $data['name'],
			'user_slug' => $pther,
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
			'gender' => $data['gender'],
			'phone' => $data['phone'],
			'confirmation' => 0,
			'confirm_key' => $keyval,	
			'photo' => '',
			'admin' => $data['usertype'],
			'referred_by'   => $referred_by,
			'created_at' => $created_at,
		
        ]);
		
		
		
		/* referral commission */
			
			$sett_meta_weldone = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 5)
				->where('sett_meta_key', '=' , "referral_amount")
		        
				->count();
				
			if(!empty($sett_meta_weldone))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 5)
				->where('sett_meta_key', '=' , "referral_amount")
		        
				->get();
			$referral_amount = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$referral_amount = 0;
			}
			
			
			$referred_user =  DB::table('users')->where('id', '=', $referred_by)->count();
			if(!empty($referred_user))
			{
			   $referred =  DB::table('users')->where('id', '=', $referred_by)->get();
			   $old_amount = $referred[0]->wallet;
			   
			   if(!empty($referred[0]->referral_amount))
			   {
			   $ref_amount = $referred[0]->referral_amount;
			   }
			   else
			   {
			     $ref_amount = 0;
			   }
			   
			}
			else
			{
			   $old_amount = 0;
			   $ref_amount = 0;
			}
			
			$total_referral = $old_amount + $referral_amount;
			$total_earn = $ref_amount + $referral_amount;
			
			
			DB::update('update users set wallet="'.$total_referral.'",referral_amount="'.$total_earn.'" where id = ?', [$referred_by]);
			
			
			/* referral commission */
			
		
		
		
		
		
		
		
		
		
		$admin_idd=1;
		
		$admin_email = DB::table('users')
                ->where('id', '=', $admin_idd)
                ->get();
		
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/media/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		$adminemail = $admin_email[0]->email;
		
		$adminname = $admin_email[0]->name;
		
		
		
		$datas = [
            'name' => $name, 'email' => $email, 'keyval' => $keyval, 'site_logo' => $site_logo,
			'site_name' => $site_name, 'url' => $url
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
		
		
		
		
		
		Mail::send('confirm_mail', $datas , function ($message) use ($adminemail,$adminname,$email,$sett_sender_name,$sett_sender_email)
        {
		
		
		
		
            $message->subject('Email Confirmation for Registration');
			
            $message->from($sett_sender_email,$sett_sender_name);

            $message->to($email);

        }); 
		
		return redirect('login')->with('success', 'We sent you an activation code. Check your email and click on the link to verify.');
		
		
		
		
    }
	
	
	
	
}
