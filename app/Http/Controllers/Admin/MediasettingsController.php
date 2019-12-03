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


class MediasettingsController extends Controller
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
			 
		
	
      $msettings = DB::select('select * from settings where id = ?',[1]);
	  $currency=array("USD","CZK","DKK","HKD","HUF","ILS","JPY","MXN","NZD","NOK","PHP","PLN","SGD","SEK","CHF","THB","AUD","CAD","EUR","GBP","AFN","DZD",
							"AOA","XCD","ARS","AMD","AWG","SHP","AZN","BSD","BHD","BDT","INR");
		
		$withdraw=array("paypal","instamojo");
		
	  $data=array('msettings'=>$msettings, 'currency' => $currency, 'withdraw' => $withdraw, 'cany_check_value' => $cany_check_value, 'site_file_upload_by' => $site_file_upload_by);
      return view('admin.media-settings')->with($data);
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
               
		'site_logo' => 'max:1024|mimes:jpg,jpeg,png',
		'site_favicon' => 'max:1024|mimes:jpg,jpeg,png',
		'site_banner' => 'max:1024|mimes:jpg,jpeg,png'
		
		
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
		
		
		
		
		
		
		
		/*if($data['image_type']!="")
		{
			$imagetype=$data['image_type'];
		}
		else
		{
			$imagetype=$data['save_image_type'];
		}*/
		
		
		if($data['image_size']!="")
		{
			$imagesize=$data['image_size'];
		}
		else
		{
			$imagesize=$data['save_image'];
		}
		
		
		
		if($data['video_size']!="")
		{
			$videosize = $data['video_size'];
		}
		else
		{
			 $videosize = $data['save_video_size'];
		}
		
		
		
		if($data['mp3_size']!="")
		{
			$mp3size = $data['mp3_size'];
		}
		else
		{
			 $mp3size = $data['save_mp3'];
		}
		
		
		
		if(!empty($data['zip_size']))
		{
			$zip_size = $data['zip_size'];
		}
		else
		{
			 $zip_size = 0;
		}
		
		
		$imgtype = "jpg,jpeg,png,gif";
		
		
		
		if($data['site_file_upload_by']!="")
		{
		
		   $check_user_meta =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 95)
				                ->where('sett_meta_key', '=' , 'site_file_upload_by')
		                        ->count();
			if(!empty($check_user_meta))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['site_file_upload_by'].'" where sett_meta_key="site_file_upload_by" and sett_meta_id = ?', [95]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [95,"site_file_upload_by",$data['site_file_upload_by']]);
			
			}					
		
		  
		}
		
		
		
		DB::update('update settings set video_size="'.$videosize.'",image_size="'.$imagesize.'",image_type="'.$imgtype.'",mp3_size="'.$mp3size.'",zip_size="'.$zip_size.'" where id = ?', [1]);
		
			return back()->with('success', 'Media Settings has been updated');
        
		
		}
		
		
    }
}
