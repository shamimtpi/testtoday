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


class BadgesettingsController extends Controller
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
      $msettings = DB::select('select * from settings where id = ?',[1]);
	  
		
		
		$check_sett_sells = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 40)
				->where('sett_meta_key', '=' , "minimum_sells")
		        
				->count();
		if(!empty($check_sett_sells))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 40)
				->where('sett_meta_key', '=' , "minimum_sells")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 40)
				->where('sett_meta_key', '=' , "minimum_sells")
		        
				->get();
			$minimum_sells = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$minimum_sells = "";
			}	
		}
		else
		{
		  $minimum_sells = "";
		}
		
		
		
		
		/* author level */
		
		$check_sett_one = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 41)
				->where('sett_meta_key', '=' , "author_level_one")
		        
				->count();
		if(!empty($check_sett_one))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 41)
				->where('sett_meta_key', '=' , "author_level_one")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 41)
				->where('sett_meta_key', '=' , "author_level_one")
		        
				->get();
			$author_level_one = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$author_level_one = "";
			}	
		}
		else
		{
		  $author_level_one = "";
		}
		
		 
		
		$check_sett_two = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 42)
				->where('sett_meta_key', '=' , "author_level_two")
		        
				->count();
		if(!empty($check_sett_two))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 42)
				->where('sett_meta_key', '=' , "author_level_two")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 42)
				->where('sett_meta_key', '=' , "author_level_two")
		        
				->get();
			$author_level_two = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$author_level_two = "";
			}	
		}
		else
		{
		  $author_level_two = "";
		}
		
		
		
		
		$check_sett_three = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 43)
				->where('sett_meta_key', '=' , "author_level_three")
		        
				->count();
		if(!empty($check_sett_three))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 43)
				->where('sett_meta_key', '=' , "author_level_three")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 43)
				->where('sett_meta_key', '=' , "author_level_three")
		        
				->get();
			$author_level_three = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$author_level_three = "";
			}	
		}
		else
		{
		  $author_level_three = "";
		}
		
		 
		
		$check_sett_four = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 44)
				->where('sett_meta_key', '=' , "author_level_four")
		        
				->count();
		if(!empty($check_sett_four))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 44)
				->where('sett_meta_key', '=' , "author_level_four")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 44)
				->where('sett_meta_key', '=' , "author_level_four")
		        
				->get();
			$author_level_four = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$author_level_four = "";
			}	
		}
		else
		{
		  $author_level_four = "";
		}
		
		
		
		
		$check_sett_five = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 45)
				->where('sett_meta_key', '=' , "author_level_five")
		        
				->count();
		if(!empty($check_sett_five))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 45)
				->where('sett_meta_key', '=' , "author_level_five")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 45)
				->where('sett_meta_key', '=' , "author_level_five")
		        
				->get();
			$author_level_five = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$author_level_five = "";
			}	
		}
		else
		{
		  $author_level_five = "";
		}
		
		
		
		
		$check_sett_six = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 46)
				->where('sett_meta_key', '=' , "author_level_six")
		        
				->count();
		if(!empty($check_sett_six))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 46)
				->where('sett_meta_key', '=' , "author_level_six")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 46)
				->where('sett_meta_key', '=' , "author_level_six")
		        
				->get();
			$author_level_six = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$author_level_six = "";
			}	
		}
		else
		{
		  $author_level_six = "";
		}
		
		
		
		
		
		
		
		
		
		
		$check_sett_level_one = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 47)
				->where('sett_meta_key', '=' , "collector_level_one")
		        
				->count();
		if(!empty($check_sett_level_one))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 47)
				->where('sett_meta_key', '=' , "collector_level_one")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 47)
				->where('sett_meta_key', '=' , "collector_level_one")
		        
				->get();
			$collector_level_one = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$collector_level_one = "";
			}	
		}
		else
		{
		  $collector_level_one = "";
		}
		
		 
		
		$check_sett_level_two = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 48)
				->where('sett_meta_key', '=' , "collector_level_two")
		        
				->count();
		if(!empty($check_sett_level_two))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 48)
				->where('sett_meta_key', '=' , "collector_level_two")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 48)
				->where('sett_meta_key', '=' , "collector_level_two")
		        
				->get();
			$collector_level_two = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$collector_level_two = "";
			}	
		}
		else
		{
		  $collector_level_two = "";
		}
		
		
		
		
		$check_sett_level_three = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 49)
				->where('sett_meta_key', '=' , "collector_level_three")
		        
				->count();
		if(!empty($check_sett_level_three))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 49)
				->where('sett_meta_key', '=' , "collector_level_three")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 49)
				->where('sett_meta_key', '=' , "collector_level_three")
		        
				->get();
			$collector_level_three = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$collector_level_three = "";
			}	
		}
		else
		{
		  $collector_level_three = "";
		}
		
		 
		
		$check_sett_level_four = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 50)
				->where('sett_meta_key', '=' , "collector_level_four")
		        
				->count();
		if(!empty($check_sett_level_four))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 50)
				->where('sett_meta_key', '=' , "collector_level_four")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 50)
				->where('sett_meta_key', '=' , "collector_level_four")
		        
				->get();
			$collector_level_four = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$collector_level_four = "";
			}	
		}
		else
		{
		  $collector_level_four = "";
		}
		
		
		
		
		$check_sett_level_five = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 51)
				->where('sett_meta_key', '=' , "collector_level_five")
		        
				->count();
		if(!empty($check_sett_level_five))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 51)
				->where('sett_meta_key', '=' , "collector_level_five")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 51)
				->where('sett_meta_key', '=' , "collector_level_five")
		        
				->get();
			$collector_level_five = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$collector_level_five = "";
			}	
		}
		else
		{
		  $collector_level_five = "";
		}
		
		
		
		
		$check_sett_level_six = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 52)
				->where('sett_meta_key', '=' , "collector_level_six")
		        
				->count();
		if(!empty($check_sett_level_six))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 52)
				->where('sett_meta_key', '=' , "collector_level_six")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 52)
				->where('sett_meta_key', '=' , "collector_level_six")
		        
				->get();
			$collector_level_six = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$collector_level_six = "";
			}	
		}
		else
		{
		  $collector_level_six = "";
		}
		
		/* author level */
		
		
		
		
		
		/* referred level */
		
		
		$check_sett_ref_one = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 53)
				->where('sett_meta_key', '=' , "referred_level_one")
		        
				->count();
		if(!empty($check_sett_ref_one))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 53)
				->where('sett_meta_key', '=' , "referred_level_one")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 53)
				->where('sett_meta_key', '=' , "referred_level_one")
		        
				->get();
			$referred_level_one = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$referred_level_one = "";
			}	
		}
		else
		{
		  $referred_level_one = "";
		}
		
		 
		
		$check_sett_ref_two = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 54)
				->where('sett_meta_key', '=' , "referred_level_two")
		        
				->count();
		if(!empty($check_sett_ref_two))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 54)
				->where('sett_meta_key', '=' , "referred_level_two")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 54)
				->where('sett_meta_key', '=' , "referred_level_two")
		        
				->get();
			$referred_level_two = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$referred_level_two = "";
			}	
		}
		else
		{
		  $referred_level_two = "";
		}
		
		
		
		
		$check_sett_ref_three = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 55)
				->where('sett_meta_key', '=' , "referred_level_three")
		        
				->count();
		if(!empty($check_sett_ref_three))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 55)
				->where('sett_meta_key', '=' , "referred_level_three")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 55)
				->where('sett_meta_key', '=' , "referred_level_three")
		        
				->get();
			$referred_level_three = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$referred_level_three = "";
			}	
		}
		else
		{
		  $referred_level_three = "";
		}
		
		 
		
		$check_sett_ref_four = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 56)
				->where('sett_meta_key', '=' , "referred_level_four")
		        
				->count();
		if(!empty($check_sett_ref_four))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 56)
				->where('sett_meta_key', '=' , "referred_level_four")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 56)
				->where('sett_meta_key', '=' , "referred_level_four")
		        
				->get();
			$referred_level_four = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$referred_level_four = "";
			}	
		}
		else
		{
		  $referred_level_four = "";
		}
		
		
		
		
		$check_sett_ref_five = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 57)
				->where('sett_meta_key', '=' , "referred_level_five")
		        
				->count();
		if(!empty($check_sett_ref_five))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 57)
				->where('sett_meta_key', '=' , "referred_level_five")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 57)
				->where('sett_meta_key', '=' , "referred_level_five")
		        
				->get();
			$referred_level_five = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$referred_level_five = "";
			}	
		}
		else
		{
		  $referred_level_five = "";
		}
		
		
		
		
		$check_sett_ref_six = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 58)
				->where('sett_meta_key', '=' , "referred_level_six")
		        
				->count();
		if(!empty($check_sett_ref_six))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 58)
				->where('sett_meta_key', '=' , "referred_level_six")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 58)
				->where('sett_meta_key', '=' , "referred_level_six")
		        
				->get();
			$referred_level_six = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$referred_level_six = "";
			}	
		}
		else
		{
		  $referred_level_six = "";
		}
		
		
		/* referred level */
		
		
		
		
		$translate_count = DB::table('codepopular_translates')
		         ->where('id','=',1152)
				 ->count();
		
		if(!empty($translate_count))
		{
		$translate = DB::table('codepopular_translates')
		         ->where('id','=',1152)
				 ->get();
				 
		$trans_view = $translate[0]->name;		 
		}
		else
		{
		  $trans_view = "";
		}
		
		
		
		
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
		
	  
		
		
	  $data=array('msettings'=>$msettings, 'minimum_sells' => $minimum_sells, 'translate_count' => $translate_count, 'trans_view' => $trans_view, 'author_level_one' => $author_level_one, 'author_level_two' => $author_level_two, 'author_level_three' => $author_level_three, 'author_level_four' => $author_level_four, 'author_level_five' => $author_level_five, 'author_level_six' => $author_level_six, 'collector_level_one' => $collector_level_one, 'collector_level_two' => $collector_level_two, 'collector_level_three' => $collector_level_three, 'collector_level_four' => $collector_level_four, 'collector_level_five' => $collector_level_five, 'collector_level_six' => $collector_level_six, 'referred_level_one' => $referred_level_one, 'referred_level_two' => $referred_level_two, 'referred_level_three' => $referred_level_three, 'referred_level_four' => $referred_level_four, 'referred_level_five' => $referred_level_five, 'referred_level_six' => $referred_level_six, 'cany_check_value' => $cany_check_value);
      return view('admin.badges-settings')->with($data);
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
		
		
		
		
		
		if($data['minimum_sells']!="")
		{
		
		   $check_user_sells =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 40)
				                ->where('sett_meta_key', '=' , 'minimum_sells')
		                        ->count();
			if(!empty($check_user_sells))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['minimum_sells'].'" where sett_meta_key="minimum_sells" and sett_meta_id = ?', [40]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [40,"minimum_sells",$data['minimum_sells']]);
			
			}					
		
		  
		}
		
		
		
		
		/* author level */
		
		if($data['author_level_one']!="")
		{
		
		   $check_user_sells =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 41)
				                ->where('sett_meta_key', '=' , 'author_level_one')
		                        ->count();
			if(!empty($check_user_sells))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['author_level_one'].'" where sett_meta_key="author_level_one" and sett_meta_id = ?', [41]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [41,"author_level_one",$data['author_level_one']]);
			
			}					
		
		  
		}
		
		
		
		if($data['author_level_two']!="")
		{
		
		   $check_user_sells =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 42)
				                ->where('sett_meta_key', '=' , 'author_level_two')
		                        ->count();
			if(!empty($check_user_sells))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['author_level_two'].'" where sett_meta_key="author_level_two" and sett_meta_id = ?', [42]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [42,"author_level_two",$data['author_level_two']]);
			
			}					
		
		  
		}
		
		
		if($data['author_level_three']!="")
		{
		
		   $check_user_sells =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 43)
				                ->where('sett_meta_key', '=' , 'author_level_three')
		                        ->count();
			if(!empty($check_user_sells))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['author_level_three'].'" where sett_meta_key="author_level_three" and sett_meta_id = ?', [43]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [43,"author_level_three",$data['author_level_three']]);
			
			}					
		
		  
		}
		
		
		
		if($data['author_level_four']!="")
		{
		
		   $check_user_sells =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 44)
				                ->where('sett_meta_key', '=' , 'author_level_four')
		                        ->count();
			if(!empty($check_user_sells))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['author_level_four'].'" where sett_meta_key="author_level_four" and sett_meta_id = ?', [44]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [44,"author_level_four",$data['author_level_four']]);
			
			}					
		
		  
		}
		
		
		if($data['author_level_five']!="")
		{
		
		   $check_user_sells =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 45)
				                ->where('sett_meta_key', '=' , 'author_level_five')
		                        ->count();
			if(!empty($check_user_sells))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['author_level_five'].'" where sett_meta_key="author_level_five" and sett_meta_id = ?', [45]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [45,"author_level_five",$data['author_level_five']]);
			
			}					
		
		  
		}
		
		
		
		if($data['author_level_six']!="")
		{
		
		   $check_user_sells =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 46)
				                ->where('sett_meta_key', '=' , 'author_level_six')
		                        ->count();
			if(!empty($check_user_sells))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['author_level_six'].'" where sett_meta_key="author_level_six" and sett_meta_id = ?', [46]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [46,"author_level_six",$data['author_level_six']]);
			
			}					
		
		  
		}
		
		
		
		
		
		
		if($data['collector_level_one']!="")
		{
		
		   $check_user_sells =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 47)
				                ->where('sett_meta_key', '=' , 'collector_level_one')
		                        ->count();
			if(!empty($check_user_sells))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['collector_level_one'].'" where sett_meta_key="collector_level_one" and sett_meta_id = ?', [47]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [47,"collector_level_one",$data['collector_level_one']]);
			
			}					
		
		  
		}
		
		
		
		
		
		if($data['collector_level_two']!="")
		{
		
		   $check_user_sells =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 48)
				                ->where('sett_meta_key', '=' , 'collector_level_two')
		                        ->count();
			if(!empty($check_user_sells))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['collector_level_two'].'" where sett_meta_key="collector_level_two" and sett_meta_id = ?', [48]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [48,"collector_level_two",$data['collector_level_two']]);
			
			}					
		
		  
		}
		
		
		
		
		if($data['collector_level_three']!="")
		{
		
		   $check_user_sells =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 49)
				                ->where('sett_meta_key', '=' , 'collector_level_three')
		                        ->count();
			if(!empty($check_user_sells))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['collector_level_three'].'" where sett_meta_key="collector_level_three" and sett_meta_id = ?', [49]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [49,"collector_level_three",$data['collector_level_three']]);
			
			}					
		
		  
		}
		
		
		
		if($data['collector_level_four']!="")
		{
		
		   $check_user_sells =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 50)
				                ->where('sett_meta_key', '=' , 'collector_level_four')
		                        ->count();
			if(!empty($check_user_sells))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['collector_level_four'].'" where sett_meta_key="collector_level_four" and sett_meta_id = ?', [50]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [50,"collector_level_four",$data['collector_level_four']]);
			
			}					
		
		  
		}
		
		
		if($data['collector_level_five']!="")
		{
		
		   $check_user_sells =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 51)
				                ->where('sett_meta_key', '=' , 'collector_level_five')
		                        ->count();
			if(!empty($check_user_sells))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['collector_level_five'].'" where sett_meta_key="collector_level_five" and sett_meta_id = ?', [51]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [51,"collector_level_five",$data['collector_level_five']]);
			
			}					
		
		  
		}
		
		
		
		if($data['collector_level_six']!="")
		{
		
		   $check_user_sells =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 52)
				                ->where('sett_meta_key', '=' , 'collector_level_six')
		                        ->count();
			if(!empty($check_user_sells))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['collector_level_six'].'" where sett_meta_key="collector_level_six" and sett_meta_id = ?', [52]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [52,"collector_level_six",$data['collector_level_six']]);
			
			}					
		
		  
		}
		
		/* author level */
		
		
		
		/* referred level */
		
		
		if($data['referred_level_one']!="")
		{
		
		   $check_user_sells =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 53)
				                ->where('sett_meta_key', '=' , 'referred_level_one')
		                        ->count();
			if(!empty($check_user_sells))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['referred_level_one'].'" where sett_meta_key="referred_level_one" and sett_meta_id = ?', [53]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [53,"referred_level_one",$data['referred_level_one']]);
			
			}					
		
		  
		}
		
		
		
		
		if($data['referred_level_two']!="")
		{
		
		   $check_user_sells =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 54)
				                ->where('sett_meta_key', '=' , 'referred_level_two')
		                        ->count();
			if(!empty($check_user_sells))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['referred_level_two'].'" where sett_meta_key="referred_level_two" and sett_meta_id = ?', [54]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [54,"referred_level_two",$data['referred_level_two']]);
			
			}					
		
		  
		}
		
		
		
		
		if($data['referred_level_three']!="")
		{
		
		   $check_user_sells =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 55)
				                ->where('sett_meta_key', '=' , 'referred_level_three')
		                        ->count();
			if(!empty($check_user_sells))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['referred_level_three'].'" where sett_meta_key="referred_level_three" and sett_meta_id = ?', [55]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [55,"referred_level_three",$data['referred_level_three']]);
			
			}					
		
		  
		}
		
		
		
		
		if($data['referred_level_four']!="")
		{
		
		   $check_user_sells =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 56)
				                ->where('sett_meta_key', '=' , 'referred_level_four')
		                        ->count();
			if(!empty($check_user_sells))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['referred_level_four'].'" where sett_meta_key="referred_level_four" and sett_meta_id = ?', [56]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [56,"referred_level_four",$data['referred_level_four']]);
			
			}					
		
		  
		}
		
		
		
		if($data['referred_level_five']!="")
		{
		
		   $check_user_sells =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 57)
				                ->where('sett_meta_key', '=' , 'referred_level_five')
		                        ->count();
			if(!empty($check_user_sells))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['referred_level_five'].'" where sett_meta_key="referred_level_five" and sett_meta_id = ?', [57]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [57,"referred_level_five",$data['referred_level_five']]);
			
			}					
		
		  
		}
		
		
		
		if($data['referred_level_six']!="")
		{
		
		   $check_user_sells =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 58)
				                ->where('sett_meta_key', '=' , 'referred_level_six')
		                        ->count();
			if(!empty($check_user_sells))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['referred_level_six'].'" where sett_meta_key="referred_level_six" and sett_meta_id = ?', [58]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [58,"referred_level_six",$data['referred_level_six']]);
			
			}					
		
		  
		}
		
		/* referred level */
		
		
		
		
		
		
		
		
		
			return back()->with('success', 'Badges Settings has been updated');
        
		
		}
		
		
    }
}
