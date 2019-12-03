<?php
namespace App\Http\Controllers\Admin;
use File;
use Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class PromoController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
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
		
		
	
        $translate_1 = DB::table('codepopular_translates')
		         ->where('id','=',1)
				 ->get();
        $translate_2 = DB::table('codepopular_translates')
		         ->where('id','=',4)
				 ->get();
				 
		$translate_3 = DB::table('codepopular_translates')
		         ->where('id','=',7)
				 ->get();
		$translate_4 = DB::table('codepopular_translates')
		         ->where('id','=',10)
				 ->get();		 
		$translate_5 = DB::table('codepopular_translates')
		         ->where('id','=',13)
				 ->get();
		$translate_6 = DB::table('codepopular_translates')
		         ->where('id','=',16)
				 ->get();	
				 
		$translate_7 = DB::table('codepopular_translates')
		         ->where('id','=',19)
				 ->get();	
		$translate_8 = DB::table('codepopular_translates')
		         ->where('id','=',22)
				 ->get();	
				 
		$edit_setting = DB::table('settings')
		         ->where('id','=',1)
				 ->get();		 
				 
				 	 	 	 		 		 
        return view('admin.promo', ['translate_1' => $translate_1, 'translate_2' => $translate_2, 'translate_3' => $translate_3, 'translate_4' => $translate_4, 'translate_5' => $translate_5, 'translate_6' => $translate_6, 'translate_7' => $translate_7, 'translate_8' => $translate_8, 'edit_setting' => $edit_setting,  'cany_check_value' => $cany_check_value]);
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
    	
	
	
	
	
	
	
	
	
	protected function promodata(Request $request)
    {
       
		
		
		$data = $request->all();
		
		if(!empty($data['promo_icon_1'])){ $promo_icon_1 = $data['promo_icon_1']; } else { $promo_icon_1 = ""; }
		if(!empty($data['promo_title_1'])){ $promo_title_1 = $data['promo_title_1']; } else { $promo_title_1 = ""; }
		if(!empty($data['promo_desc_1'])){ $promo_desc_1 = $data['promo_desc_1']; } else { $promo_desc_1 = ""; }
		
		
		if(!empty($data['promo_icon_2'])){ $promo_icon_2 = $data['promo_icon_2']; } else { $promo_icon_2 = ""; }
		if(!empty($data['promo_title_2'])){ $promo_title_2 = $data['promo_title_2']; } else { $promo_title_2 = ""; }
		if(!empty($data['promo_desc_2'])){ $promo_desc_2 = $data['promo_desc_2']; } else { $promo_desc_2 = ""; }
		
		
		if(!empty($data['promo_icon_3'])){ $promo_icon_3 = $data['promo_icon_3']; } else { $promo_icon_3 = ""; }
		if(!empty($data['promo_title_3'])){ $promo_title_3 = $data['promo_title_3']; } else { $promo_title_3 = ""; }
		if(!empty($data['promo_desc_3'])){ $promo_desc_3 = $data['promo_desc_3']; } else { $promo_desc_3 = ""; }
		
		
		if(!empty($data['promo_icon_4'])){ $promo_icon_4 = $data['promo_icon_4']; } else { $promo_icon_4 = ""; }
		if(!empty($data['promo_title_4'])){ $promo_title_4 = $data['promo_title_4']; } else { $promo_title_4 = ""; }
		if(!empty($data['promo_desc_4'])){ $promo_desc_4 = $data['promo_desc_4']; } else { $promo_desc_4 = ""; }
		
		
		
		DB::update('update settings set promo_icon_1="'.$promo_icon_1.'",promo_icon_2="'.$promo_icon_2.'",promo_icon_3="'.$promo_icon_3.'",promo_icon_4="'.$promo_icon_4.'",promo_title_1="'.$promo_title_1.'",promo_title_2="'.$promo_title_2.'",promo_title_3="'.$promo_title_3.'",promo_title_4="'.$promo_title_4.'",promo_desc_1="'.$promo_desc_1.'",promo_desc_2="'.$promo_desc_2.'",promo_desc_3="'.$promo_desc_3.'",promo_desc_4="'.$promo_desc_4.'" where id = ?', [1]);
		
		
		
		
			return back()->with('success', 'Promo content has been updated');
        
		
		
		
		
         
		 
		 
		 
	}
	
	
	
   
   
   
	
}