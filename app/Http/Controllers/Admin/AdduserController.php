<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use File;
use Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdduserController extends Controller
{
    
   

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function formview()

    {

        return view('admin.adduser');

    }
	
	
	public function admin_formview()

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
		
	
        $menu_option=array("Dashboard" => 1 ,"Settings" => 2, "Users" => 3, "Currency" => 4, "Country" => 5,  "Category" => 6, "Framework Category" => 7, "Items" => 8, "Withdraw" => 9, 'Promo Box' => 10, 'Blog' => 11, 'Pages' => 12, 'Newsletter' => 13, 'Contact Us' => 14, 'Translate' => 15, 'Language' => 16);
		
		$data=array('menu_option' =>$menu_option, 'cany_check_value' => $cany_check_value);
        return view('admin.add_administrator')->with($data);

    }
	
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
	 
	 
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
    	
	 
	 
	 
	 
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
	 
	  protected $fillable = ['name', 'email','password','phone'];
	  
	  
	 
	  
	  public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	} 
	
	
	 
    protected function adduserdata(Request $request)
    {
        /*return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);*/
		
		
		
		 $this->validate($request, [

        		'name' => 'required',

        		'email' => 'required|email',

        		'password' => 'required'
				
				

        	]);
         
		 
				
		$input['email'] = $request->input('email');
		
		$input['name'] = $request->input('name');
       $settings = DB::select('select * from settings where id = ?',[1]);
	   
	   $imgsize = $settings[0]->image_size;
	   $imgtype = $settings[0]->image_type;
		
		/* $rules = array('email' => 'unique:users,email');*/
		
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
		
		
		'photo' => 'max:'.$imgsize.'|mimes:'.$imgtype
		
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
		
		
		$image = $request->file('photo');
		if($image!="")
		 {
		 
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $userphoto="/media/userphoto/";
            $path = base_path('images'.$userphoto.$filename);
 
        
                Image::make($image->getRealPath())->resize(200, 200)->save($path);
               /* $user->image = $filename;
                $user->save();*/
			$namef=$filename;	
			}
		 else
		 {
			 $namef="";
		 }	
		

		
		 

			/*User::create([
            'name' => $data['name'],
            'email' => $data['email'],
			'admin' => '0',
            'password' => bcrypt($data['password']),
			'phone' => $data['phone']
			
        ]);*/
		$name=$data['name'];
		$email=$data['email'];
		$password=bcrypt($data['password']);
		$phone=$data['phone'];
		$confirmation = 1;
		$admin=$data['usertype'];
		$confirm_key =  uniqid();
		$gender='';
		
		if(!empty($data['menu_option'])){
		$menuvalue = "";
		foreach($data['menu_option'] as $menu_option)
		{
			 $menuvalue .=$menu_option.',';
		}			
		
		$menu_value = rtrim($menuvalue,",");
		}
		else
		{
			
			$menu_value = "";
		}
		
		DB::insert('insert into users (name,user_slug,email,password,phone,photo,admin,gender,confirmation,confirm_key,show_menu) values (?, ?,?, ?,?,?,?, ?,?,?,?)', [$name,$this->clean($name),$email,$password,$phone,$namef,$admin,$gender,$confirmation,$confirm_key,$menu_value]);
		
		
			return back()->with('success', 'Account has been created');
        }
		
		
		
		
    }
}
