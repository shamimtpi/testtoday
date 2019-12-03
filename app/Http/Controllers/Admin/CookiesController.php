<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use File;
use Image;


class CookiesController extends Controller
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
    
	
	public function showform() {
	
	
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
		
	 $msettings = DB::select('select * from settings where id = ?',[1]);
	 
	 
	 /* cookie */
	 
	 $check_sett_cookie = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 75)
				->where('sett_meta_key', '=' , "site_cookie")
		        
				->count();
		if(!empty($check_sett_cookie))
		{
		   
		    $sett_meta_well_four = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 75)
				->where('sett_meta_key', '=' , "site_cookie")
		        
				->count();
				
			if(!empty($sett_meta_well_four))
			{	
		   $sett_meta_four =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 75)
				->where('sett_meta_key', '=' , "site_cookie")
		        
				->get();
			$site_cookie = $sett_meta_four[0]->sett_meta_value;
			}
			else
			{
			$site_cookie = "";
			}	
		}
		else
		{
		  $site_cookie = "";
		}
		
		
		
		
		
		
		$check_sett_cookie_position = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 76)
				->where('sett_meta_key', '=' , "site_cookie_position")
		        
				->count();
		if(!empty($check_sett_cookie_position))
		{
		   
		    $sett_meta_well_four = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 76)
				->where('sett_meta_key', '=' , "site_cookie_position")
		        
				->count();
				
			if(!empty($sett_meta_well_four))
			{	
		   $sett_meta_four =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 76)
				->where('sett_meta_key', '=' , "site_cookie_position")
		        
				->get();
			$site_cookie_position = $sett_meta_four[0]->sett_meta_value;
			}
			else
			{
			$site_cookie_position = "";
			}	
		}
		else
		{
		  $site_cookie_position = "";
		}
		
		
	 /* cookie */	
	 
	 $translate_01 = DB::table('codepopular_translates')
		         ->where('id','=',1212)
				 ->get();
      $translate_02 = DB::table('codepopular_translates')
		         ->where('id','=',1215)
				 ->get();
		
	  $data=array('cany_check_value' => $cany_check_value, 'msettings'=>$msettings, 'site_cookie' => $site_cookie, 'site_cookie_position' => $site_cookie_position, 'translate_01' => $translate_01, 'translate_02' => $translate_02);
      return view('admin.cookies-settings')->with($data);
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
    
	
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
	 
	  protected $fillable = ['name', 'email','password','phone'];
	 
    protected function editsettings(Request $request)
    {
       
		
		
		
		
         
		 $data = $request->all();
			
         
		
		
		
		 $rules = array(
               
		
		
		
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
		
		
		
		if($data['site_cookie']!="")
		{
		
		   $check_user_meta =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 75)
				                ->where('sett_meta_key', '=' , 'site_cookie')
		                        ->count();
			if(!empty($check_user_meta))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['site_cookie'].'" where sett_meta_key="site_cookie" and sett_meta_id = ?', [75]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [75,"site_cookie",htmlentities($data['site_cookie'])]);
			
			}					
		
		  
		}
		
		
		if($data['site_cookie_position']!="")
		{
		
		   $check_user_meta =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 76)
				                ->where('sett_meta_key', '=' , 'site_cookie_position')
		                        ->count();
			if(!empty($check_user_meta))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['site_cookie_position'].'" where sett_meta_key="site_cookie_position" and sett_meta_id = ?', [76]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [76,"site_cookie_position",htmlentities($data['site_cookie_position'])]);
			
			}					
		
		  
		}
		
		
			return back()->with('success', 'Cookies Settings has been updated');
        
		
		}
		
		
    }
}
