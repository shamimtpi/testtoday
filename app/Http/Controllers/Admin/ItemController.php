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
use Mail;
use Auth;
use Crypt;
use URL;
use Cookie;
use Purifier;
use Storage;

class ItemController extends Controller
{
   
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
    
	public function avigher_delete_photo($delete,$id,$photo) 
	{
	
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
	    $orginalfile1 = base64_decode($photo);
	    if($site_file_upload_by == "s3_server")
		{
	       Storage::disk('s3')->delete($orginalfile1);
		   
		}
		else
		{   
		   
		   $userphoto1="/media/screenshots/";
		   $path1 = base_path('images'.$userphoto1.$orginalfile1);
		   File::delete($path1);
	    }
	   
	   DB::delete('delete from product_images where item_img_id = ?',[$id]);
	   return back();
	
	}
	
	
   public function view_edit_item($token)
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
	
	
			
	
	$settings = DB::select('select * from settings where id = ?',[1]);
	$viewcount = DB::table('products')
		            ->where('item_token','=',$token)
					->count();
	
	$edit = DB::table('products')
		            ->where('item_token','=',$token)
					->get();
					
	$browser = array("IE6","IE7","IE8","IE9","IE10","IE11","Firefox","Safari","Opera","Chrome","Edge");	
	$graphics = array("Photoshop PSD","Transparent PNG","Layered PNG","JPG Image","Vector EPS","InDesign INDD","Quark QXP","AI Illustrator","TIFF Image","Affinity Designer");	
	
	$adobe_cs = array("CS","CS2","CS3","CS4","CS5","CS5.5","CS6","CC","CC 2014","CC 2015","CC 2015.5","CC 2017","CC 2018","N/A");
	
	 $category_count = DB::table('product_categories')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->where('lang_code','=',"en")
					->where('cat_type','=','default')
					->orderBy('cat_name', 'asc')->count();	
					
	$framework_count = DB::table('product_categories')
		            ->where('delete_status','=','')
					->where('cat_type','=','framework')
					->where('lang_code','=',"en")
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->count();				
					
	   /* item meta */
		$check_item_meta = DB::table('product_metas')
		        ->where('item_token', '=' , $token)
				->where('item_meta_key', '=' , "item_video_preview")
		        
				->count();
		if(!empty($check_item_meta))
		{
		   
		    $item_meta_well = DB::table('product_metas')
		        ->where('item_token', '=' , $token)
				->where('item_meta_key', '=' , "item_video_preview")
		        
				->count();
				
			if(!empty($item_meta_well))
			{	
		   $item_meta = DB::table('product_metas')
		        ->where('item_token', '=' , $token)
				->where('item_meta_key', '=' , "item_video_preview")
		        
				->get();
			$video_status = $item_meta[0]->item_meta_value;
			}
			else
			{
			$video_status = "";
			}	
		}
		else
		{
		  $video_status = "";
		}
		
		
		
		
		
						
					
		$language = DB::table('codepopular_langs')
		            ->where('lang_status', '=', 1)
					->orderBy('id','asc')
					->get();			
					
					
							
					
	return view('admin.edit-item', ['edit' => $edit, 'settings' => $settings, 'viewcount' => $viewcount, 'browser' => $browser, 'category_count' => $category_count, 'video_status' => $video_status, 'framework_count' => $framework_count, 'language' => $language, 'graphics' => $graphics, 'adobe_cs' => $adobe_cs, 'cany_check_value' => $cany_check_value, 'site_file_upload_by' => $site_file_upload_by]);
	
	}
		
	
	
	
   
   public function view_add_item()
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
		
		
	
	
     
		$language = DB::table('codepopular_langs')
		            ->where('lang_status', '=', 1)
					->orderBy('id','asc')
					->get();			
	 $category_count = DB::table('product_categories')
		            ->where('delete_status','=','')
					->where('cat_type','=','default')
					->where('lang_code','=',"en")
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->count();
					
	$framework_count = DB::table('product_categories')
		            ->where('delete_status','=','')
					->where('cat_type','=','framework')
					->where('lang_code','=',"en")
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->count();				
		$browser = array("IE6","IE7","IE8","IE9","IE10","IE11","Firefox","Safari","Opera","Chrome","Edge");	
		
		$graphics = array("Photoshop PSD","Transparent PNG","Layered PNG","JPG Image","Vector EPS","InDesign INDD","Quark QXP","AI Illustrator","TIFF Image","Affinity Designer");	
		
		$adobe_cs = array("CS","CS2","CS3","CS4","CS5","CS5.5","CS6","CC","CC 2014","CC 2015","CC 2015.5","CC 2017","CC 2018","N/A");
				
	
	return view('admin.add-item', ['category_count' => $category_count, 'framework_count' => $framework_count, 'language' => $language, 'cany_check_value' => $cany_check_value, 'browser' => $browser, 'graphics' => $graphics, 'adobe_cs' => $adobe_cs]);
	}
	 
	 
	 
	 
	public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	}  
	
   
   public function avigher_add_items(Request $request)
	{

	$url = URL::to("/");
	$userid = Auth::user()->id;
	
	/*$category = DB::table('product_categories')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->get();
			*/
	
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
	
		
		
	
	
	   $data = $request->all();
	   


	   
	   $settings = DB::select('select * from settings where id = ?',[1]);
	      $imgsize = $settings[0]->image_size;
		  $imgtype = $settings[0]->image_type;
		 $zipsize = $settings[0]->zip_size;
		 $mp3size = $settings[0]->mp3_size;
		
		$rules = array(
		
		
		'item_desc' => 'required',
		'main_file' => 'max:'.$zipsize.'|mimes:zip',
		'video_file' => 'max:'.$mp3size.'|mimes:mp4',
		'preview_image' => 'max:'.$imgsize.'|mimes:'.$imgtype,
		'item_thumbnail' => 'max:'.$imgsize.'|mimes:'.$imgtype,
		'image.*' => 'image|mimes:'.$imgtype.'|max:'.$imgsize
		
		);
		
		
		$messages = array(
            
            'preview_image' => 'The :attribute field must only be image'
			
        );

		$validator = Validator::make($request->all(), $rules, $messages);
		
		
		 
		 
		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			return back()->withErrors($validator);
		}
		else
		{
	   
	   
	   if(!empty($data['item_title']))
	   {
	   $item_title = $data['item_title'];
	   }
	   else
	   {
	   $item_title = "";
	   }
	   
	   
	   if(!empty($data['item_short_desc']))
	   {
	     $item_short_desc = $data['item_short_desc'];
	   }
	   else
	   {
	      $item_short_desc = "";
	   }
	   
	   
	   
	   $item_slug = $data['item_slug'];
	   
	   
	   if(!empty($data['item_category']))
	   {
		   $cat_id = $data['item_category'];
		   $category_id = "";
		   foreach($cat_id as $category)
		   {
			  $category_id .= $category.',';
		   }
		   
		   $categoryid = rtrim($category_id, ",");
	   }
	   else
	   {
	      $categoryid = "";
	   }
	   
	   
	   if(!empty($data['item_framework']))
	   {
		   $cat_id = $data['item_framework'];
		   $framework_id = "";
		   foreach($cat_id as $category)
		   {
			  $framework_id .= $category.',';
		   }
		   
		   $frameworkid = rtrim($framework_id, ",");
	   }
	   else
	   {
	      $frameworkid = "";
	   }
	   
	   
	   /* graphic */
	   
	   
	   if(!empty($data['item_script_type']))
	   {
	      $item_script_type = $data['item_script_type'];
	   }
	   else
	   {
	      $item_script_type = "";
	   }
	   
	   
	   if(!empty($data['item_layered']))
	   {
	     $item_layered = $data['item_layered'];
	   }
	   else
	   {
	     $item_layered = "";
	   }
	   
	   if(!empty($data['graphics_files']))
	   {
		   $graphics = $data['graphics_files'];
		   $graphics_id = "";
		   foreach($graphics as $files)
		   {
			  $graphics_id .= $files.',';
		   }
		   
		   $graphicsid = rtrim($graphics_id, ",");
	   }
	   else
	   {
	      $graphicsid = "";
	   }
	   
	   
	   if(!empty($data['adobe_cs_version']))
	   {
	      $adobe_cs_version = $data['adobe_cs_version'];
	   }
	   else
	   {
	     $adobe_cs_version = "";
	   }
	   
	   
	   if(!empty($data['pixel_dimensions']))
	   {
	      $pixel_dimensions = $data['pixel_dimensions'];
	   }
	   else
	   {
	     $pixel_dimensions = "";
	   }
	   
	   if(!empty($data['print_dimensions']))
	   {
	      $print_dimensions = $data['print_dimensions'];
	   }
	   else
	   {
	      $print_dimensions = "";
	   }
	   
	   /* graphics */
	   
	   
	   
	   if(!empty($data['item_desc']))
	   {
	   $item_desc = $data['item_desc'];
	   }
	   else
	   {
	   $item_desc = "";
	   }
	   
	   
	   
	   $item_type = $data['item_type'];
	   
	   
	  
	   if(!empty($data['regular_price_six_month']))
	   { 
	   $regular_price_six_month = $data['regular_price_six_month'];
	   }
	   else
	   {
	     $regular_price_six_month = 0; 
	   }
	   
	   
	   if(!empty($data['regular_price_one_year']))
	   {
	   $regular_price_one_year = $data['regular_price_one_year'];
	   }
	   else
	   {
	   $regular_price_one_year = 0;
	   }
	   
	   if(!empty($data['extended_price_six_month']))
	   {
	   $extended_price_six_month = $data['extended_price_six_month'];
	   }
	   else
	   {
	   $extended_price_six_month = 0;
	   }
	   
	   if(!empty($data['extended_price_one_year']))
	   {
	   $extended_price_one_year = $data['extended_price_one_year'];
	   }
	   else
	   {
	     $extended_price_one_year = 0;
	   }
	   
	   $high_resolution = $data['high_resolution'];
	   
	   
	   if(!empty($data['compatible_browser']))
	   {
	   $compatible_browser = "";
	   foreach($data['compatible_browser'] as $compatible)
	   {
	   
	      $compatible_browser .= $compatible.',';
	   
	   }
	   $compatiblebrowser = rtrim($compatible_browser,',');
	   }
	   else
	   {
	   $compatiblebrowser = "";
	   }
	   
	   
	   if(!empty($data['file_included']))
	   {
	   $file_included = $data['file_included'];
	   }
	   else
	   {
	     $file_included = "";
	   }
	   
	   
	   $token = $data['item_token'];
	   
	   
	   if(!empty($data['demo_url']))
	   {
	   $demo_url = $data['demo_url'];
	   }
	   else
	   {
	   $demo_url = "";
	   }
	   
	   
	   
	   
	    
	   $support_item = $data['support_item'];
	   
	   
	   
	   $future_update = $data['future_update'];
	   
	   
	   
	   if(!empty($data['unlimited_download']))
	   {
	   
	   $unlimited_download = $data['unlimited_download'];
	   
	   }
	   else
	   {
	    $unlimited_download = "";
	   }
	   
	   
	   
	   /* watermark */
	   
	   
	   $check_sett_waterstatus = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 78)
				->where('sett_meta_key', '=' , "site_watermark_status")
		        
				->count();
		if(!empty($check_sett_waterstatus))
		{
		   
		    $sett_meta_seo = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 78)
				->where('sett_meta_key', '=' , "site_watermark_status")
		        
				->count();
				
			if(!empty($sett_meta_seo))
			{	
		   $sett_meta_chat =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 78)
				->where('sett_meta_key', '=' , "site_watermark_status")
		        
				->get();
			$site_watermark_status = $sett_meta_chat[0]->sett_meta_value;
			}
			else
			{
			$site_watermark_status = "";
			}	
		}
		else
		{
		  $site_watermark_status = "";
		}
	   
	   
	   
	   $check_sett_water = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 77)
				->where('sett_meta_key', '=' , "site_watermark")
		        
				->count();
		if(!empty($check_sett_water))
		{
		   
		    $sett_meta_seo = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 77)
				->where('sett_meta_key', '=' , "site_watermark")
		        
				->count();
				
			if(!empty($sett_meta_seo))
			{	
		   $sett_meta_chat =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 77)
				->where('sett_meta_key', '=' , "site_watermark")
		        
				->get();
			$site_watermark = $sett_meta_chat[0]->sett_meta_value;
			}
			else
			{
			$site_watermark = "";
			}	
		}
		else
		{
		  $site_watermark = "";
		}
	   
	   
	   /* watermark */
	   
	   
	     $zipfile = $request->file('main_file'); 
		 if(isset($zipfile))
		 {
		 $myname = preg_replace('/\s+/', '', $zipfile->getClientOriginalName()); 
		 $filename = time() . '12.' . $myname;
		 
		  if($site_file_upload_by == "s3_server")
		  {
		     Storage::disk('s3')->put($filename, file_get_contents($zipfile), 'public');
			 $zipname = $filename;
		  }
		  else
		  {
		
			 $zipformat = base_path('images/media/itemfile/'); 
			 $zipfile->move($zipformat,$filename); 
			 $zipname = $filename;
		  }	 
			 
			  
		 }
		 else
		 {
		    $zipname = "";
		 }
		 
		 
		 
		 
		  $videofile = $request->file('video_file'); 
		 if(isset($videofile))
		 {
		 $myname = preg_replace('/\s+/', '', $videofile->getClientOriginalName()); 
		 $filenamme = time() . '172.' . $myname;
		 
		 if($site_file_upload_by == "s3_server")
		 {
		 
		  Storage::disk('s3')->put($filenamme, file_get_contents($videofile), 'public');
		  $videoname = $filenamme;
		 }
		 else
		 {
		
			 $videoformat = base_path('images/media/video/'); 
			 $videofile->move($videoformat,$filenamme); 
			 $videoname = $filenamme; 
		 }	 
			 
			 
		 }
		 else
		 {
		    $videoname = "";
		 }
		
		 
		 
	   
	   
	   $image = $request->file('preview_image');
		if($image!="")
		{	
		$userphoto="/media/preview/";
		$myname = preg_replace('/\s+/', '', $image->getClientOriginalName()); 
		$filename  = time() . '24.' . $myname;
		
		$path = base_path('images'.$userphoto);
		$request->file('preview_image')->move($path, $filename);
		$savefname=$filename;
			if($site_watermark_status == "on")
			{
			$img = Image::make($url.'/local/images/media/preview/'.$filename)->resize(600, 450)->encode('jpg', 50);
			 $img->insert($url.'/local/images/media/settings/'.$site_watermark,'center');
			
		
			 $img->save(base_path('images/media/preview/'.$filename));
			 }
		}
		else
		{
		$savefname="";
		}
		
		
		
		
		
		$thumbnail = $request->file('item_thumbnail');
		if($thumbnail!="")
		{	
		$userphoto="/media/thumbnail/";
		$myname = preg_replace('/\s+/', '', $thumbnail->getClientOriginalName()); 
		$fileename  = time() . '78.' . $myname;
		
		$patth = base_path('images'.$userphoto);
		$request->file('item_thumbnail')->move($patth, $fileename);
		$save_thumb=$fileename;
			if($site_watermark_status == "on")
			{
			$img = Image::make(base_path('images/media/thumbnail/'.$fileename))->resize(80,80)->encode('jpg', 50);
			 $img->insert(base_path('images/media/settings/'.$site_watermark),'center');
			
		
			 $img->save(base_path('images/media/thumbnail/'.$fileename));
			 }
		
		}
		else
		{
		$save_thumb="";
		}
	   
	   
	   
	   
	   if(!empty($data['item_tags']))
	   {
	     $item_tags = $data['item_tags'];
	   }
	   else
	   {
	     $item_tags = "";
	   }
	   
	   
	   
	   
	   /*if($settings[0]->with_submit_product==1)
	   {
	     $status_approval = 0;
		 $submit_msg = "Item has been created. Once item has been approved. You will received the confirmation.";
		 
	   }
	   else
	   {*/
	     $status_approval = 1;
		 $submit_msg = "Item has been created.";
	   /*}*/
	   
	   $update_date = date("Y-m-d");
	   
	   
	   
	   
	   
	   
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
	      $pther = str_replace(" ","-",$item_slug);
	   }
	   else
	   {
	      $pther = $this->clean($item_slug);
	   }
	   
	   
	   
	   
	   
	   foreach($data['code'] as $index => $code)
		{
		
		   $pagename=$item_title[$index];
		   $pagedesc=$item_desc[$index];
		   $pageshortdesc = $item_short_desc[$index];
		   
		
			if($code=='en')
			   {
				   $parent=0;
			   }
			   else
			   {
			   
			       $product = DB::table('products')
		           	->where('token', '=', $token)
					->where('parent', '=', 0)
					->get();
					
					 $product_cnt = DB::table('products')
		           		->where('token', '=', $token)
					->where('parent', '=', 0)
					->count();
					if($product_cnt==0)
					{
					
                       	$parent = $idd;				
					  
					   
					}
					else
					{
					   $parent=$product[0]->item_id;
					}
					
					
			   }
		
		if(!empty($pagename))
		{
		   $pagenamo = $pagename;
		}
		else
		{
		   $pagenamo = "";
		}
		
		if(!empty($pagedesc))
		{
		   $pagedeo = $pagedesc;
		}
		else
		{
		   $pagedeo = "";
		}
		
		if(!empty($pageshortdesc))
		{
		   $pageshort = $pageshortdesc;
		}
		else
		{
		  $pageshort = "";
		}
		
		$idd = DB::table('products')-> insertGetId(array(
		
		'item_token' => $token,
		'user_id' => $userid,
		'item_title' => $pagenamo,
        'item_slug' => $pther,
		'item_desc' => htmlentities($pagedeo),
		'item_short_desc' => htmlentities($pageshort),
		'regular_price_six_month' => $regular_price_six_month,
		'regular_price_one_year' => $regular_price_one_year,
		'extended_price_six_month' => $extended_price_six_month,
		'extended_price_one_year' => $extended_price_one_year,
		'high_resolution' => $high_resolution,
		'compatible_browser' => $compatiblebrowser,
		'file_included' => $file_included,
		'demo_url' => $demo_url,
		'support_item' => $support_item,
		'future_update' => $future_update,
		'unlimited_download' => $unlimited_download,
		'category' => $categoryid,
		'framework_category' => $frameworkid,
		'first_update' => $update_date,
		'last_update' => $update_date,
		'preview_image' => $savefname,
		'item_thumbnail' => $save_thumb,
		'main_file' => $zipname,
		'item_tags' => $item_tags,
		'item_status' => $status_approval,
		'lang_code' => $code,
		'token' => $token,
		'parent' => $parent,
		'item_type' => $item_type,
		'item_script_type' => $item_script_type,
		'item_layered' => $item_layered,
		'graphics_files' => $graphicsid,
		'adobe_cs_version' => $adobe_cs_version,
		'pixel_dimensions' => $pixel_dimensions,
		'print_dimensions' => $print_dimensions,
		
			));
	   
	  } 
		
	   
	   
	 }  
	   
	  
	  $picture = '';
			if ($request->hasFile('image')) {
				$files = $request->file('image');
				foreach($files as $file){
					
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					$myname = preg_replace('/\s+/', '', $file->getClientOriginalName()); 
					$picture = time().'_12'.$myname;
					
					if($site_file_upload_by == "s3_server")
					{
					   Storage::disk('s3')->put($picture, file_get_contents($file), 'public');
					}
					else
					{
						$destinationPath = base_path('images/media/screenshots/');
						$file->move($destinationPath, $picture);
							if($site_watermark_status == "on")
							{
							$img = Image::make($url.'/local/images/media/screenshots/'.$picture)->encode('jpg', 50);
							$img->insert($url.'/local/images/media/settings/'.$site_watermark,'center');
							$img->save(base_path('images/media/screenshots/'.$picture));
							}
					}	
					
					DB::insert('insert into product_images (item_token,image) values (?, ?)', [$token,$picture]);
					
				}
			}
		
			
			
			
			
			if($videofile!="")
		{
		
		   $check_item_meta =  DB::table('product_metas')
		        				->where('item_token', '=' , $token)
				                ->where('user_id', '=' , $userid)
								->where('item_meta_key', '=' , 'item_video_preview')
		                        ->count();
			if(!empty($check_item_meta))
			{
			   DB::update('update product_metas set item_meta_value="'.$videoname.'" where item_meta_key="item_video_preview" and user_id="'.$userid.'" and item_token = ?', [$token]);
			}
			else
			{
			DB::insert('insert into product_metas (item_token,user_id,item_meta_key,item_meta_value) values (?, ?, ?, ?)', [$token,$userid,'item_video_preview',$videoname]);
			
			}					
		
		  
		}
		
		
		
	  
	   return back()->with('success', $submit_msg);
	   
	}   
	
	
	
	
	
	
	
	public function avigher_edit_items(Request $request)
	{
	
	
		
		
	
	
	
	
	
	   $data = $request->all();
	   
	   $userid = $data['user_id'];
	   
	   
	   
	   $settings = DB::select('select * from settings where id = ?',[1]);
	      $imgsize = $settings[0]->image_size;
		 $zipsize = $settings[0]->zip_size;
		 $imgtype = $settings[0]->image_type;
		
		$rules = array(
		
		
		'main_file' => 'max:'.$zipsize.'|mimes:zip',
		'preview_image' => 'max:'.$imgsize.'|mimes:'.$imgtype,
		'item_thumbnail' => 'max:'.$imgsize.'|mimes:'.$imgtype,
		'image.*' => 'image|mimes:'.$imgtype.'|max:'.$imgsize
		
		
		
		);
		
		
		$messages = array(
            
            'preview_image' => 'The :attribute field must only be image'
			
        );

		$validator = Validator::make($request->all(), $rules, $messages);
		
		
		 
		 
		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			return back()->withErrors($validator);
		}
		else
		{
	   
	   if(!empty($data['item_title']))
	   {
	   $item_title = $data['item_title'];
	   }
	   else
	   {
	   $item_title = "";
	   }
	   
	   
	   if(!empty($data['item_short_desc']))
	   {
	     $item_short_desc = $data['item_short_desc'];
	   }
	   else
	   {
	      $item_short_desc = "";
	   }
	   
	   $item_slug = $data['item_slug'];
	   
	   $item_type = $data['item_type'];
	   
	   
	   if(!empty($data['item_category']))
	   {
		   $cat_id = $data['item_category'];
		   $category_id = "";
		   foreach($cat_id as $category)
		   {
			  $category_id .= $category.',';
		   }
		   
		   $categoryid = rtrim($category_id, ",");
	   }
	   else
	   {
	      $categoryid = "";
	   }
	   
	   
	   if(!empty($data['item_framework']))
	   {
		   $cat_id = $data['item_framework'];
		   $framework_id = "";
		   foreach($cat_id as $category)
		   {
			  $framework_id .= $category.',';
		   }
		   
		   $frameworkid = rtrim($framework_id, ",");
	   }
	   else
	   {
	      $frameworkid = "";
	   }
	   
	   
	   
	   /* watermark */
	   
	   
	   $check_sett_waterstatus = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 78)
				->where('sett_meta_key', '=' , "site_watermark_status")
		        
				->count();
		if(!empty($check_sett_waterstatus))
		{
		   
		    $sett_meta_seo = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 78)
				->where('sett_meta_key', '=' , "site_watermark_status")
		        
				->count();
				
			if(!empty($sett_meta_seo))
			{	
		   $sett_meta_chat =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 78)
				->where('sett_meta_key', '=' , "site_watermark_status")
		        
				->get();
			$site_watermark_status = $sett_meta_chat[0]->sett_meta_value;
			}
			else
			{
			$site_watermark_status = "";
			}	
		}
		else
		{
		  $site_watermark_status = "";
		}
	   
	   
	   
	   $check_sett_water = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 77)
				->where('sett_meta_key', '=' , "site_watermark")
		        
				->count();
		if(!empty($check_sett_water))
		{
		   
		    $sett_meta_seo = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 77)
				->where('sett_meta_key', '=' , "site_watermark")
		        
				->count();
				
			if(!empty($sett_meta_seo))
			{	
		   $sett_meta_chat =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 77)
				->where('sett_meta_key', '=' , "site_watermark")
		        
				->get();
			$site_watermark = $sett_meta_chat[0]->sett_meta_value;
			}
			else
			{
			$site_watermark = "";
			}	
		}
		else
		{
		  $site_watermark = "";
		}
	   
	   
	   /* watermark */
	   
	   
	   
	   
	  /* graphic */
	   
	   
	   if(!empty($data['item_script_type']))
	   {
	      $item_script_type = $data['item_script_type'];
	   }
	   else
	   {
	      $item_script_type = "";
	   }
	   
	   
	   if(!empty($data['item_layered']))
	   {
	     $item_layered = $data['item_layered'];
	   }
	   else
	   {
	     $item_layered = "";
	   }
	   
	   if(!empty($data['graphics_files']))
	   {
		   $graphics = $data['graphics_files'];
		   $graphics_id = "";
		   foreach($graphics as $files)
		   {
			  $graphics_id .= $files.',';
		   }
		   
		   $graphicsid = rtrim($graphics_id, ",");
	   }
	   else
	   {
	      $graphicsid = "";
	   }
	   
	   
	   if(!empty($data['adobe_cs_version']))
	   {
	      $adobe_cs_version = $data['adobe_cs_version'];
	   }
	   else
	   {
	     $adobe_cs_version = "";
	   }
	   
	   
	   if(!empty($data['pixel_dimensions']))
	   {
	      $pixel_dimensions = $data['pixel_dimensions'];
	   }
	   else
	   {
	     $pixel_dimensions = "";
	   }
	   
	   if(!empty($data['print_dimensions']))
	   {
	      $print_dimensions = $data['print_dimensions'];
	   }
	   else
	   {
	      $print_dimensions = "";
	   }
	   
	   /* graphics */
	   
	    
	   
	   
	   if(!empty($data['item_desc']))
	   {
	   $item_desc = $data['item_desc'];
	   }
	   else
	   {
	   $item_desc = "";
	   }
	  
	   if(!empty($data['regular_price_six_month']))
	   {
	  
	   $regular_price_six_month = $data['regular_price_six_month'];
	   
	   }
	   else
	   {
	     $regular_price_six_month = 0;
	   }
	   
	   
	   
	   if(!empty($data['regular_price_one_year']))
	   {
	   $regular_price_one_year = $data['regular_price_one_year'];
	   }
	   else
	   {
	   $regular_price_one_year = 0;
	   }
	   
	   if(!empty($data['extended_price_six_month']))
	   {
	   $extended_price_six_month = $data['extended_price_six_month'];
	   }
	   else
	   {
	   $extended_price_six_month = 0;
	   }
	   
	   if(!empty($data['extended_price_one_year']))
	   {
	   $extended_price_one_year = $data['extended_price_one_year'];
	   }
	   else
	   {
	     $extended_price_one_year = 0;
	   }
	   
	   
	   
	   /*$regular_price_one_year = $data['regular_price_one_year'];
	   $extended_price_six_month = $data['extended_price_six_month'];
	   $extended_price_one_year = $data['extended_price_one_year'];*/
	   
	   $high_resolution = $data['high_resolution'];
	   
	   
	   if(!empty($data['compatible_browser']))
	   {
	   $compatible_browser = "";
	   foreach($data['compatible_browser'] as $compatible)
	   {
	   
	      $compatible_browser .= $compatible.',';
	   
	   }
	   $compatiblebrowser = rtrim($compatible_browser,',');
	   }
	   else
	   {
	   $compatiblebrowser = "";
	   }
	   
	   
	   if(!empty($data['file_included']))
	   {
	   $file_included = $data['file_included'];
	   }
	   else
	   {
	   $file_included = "";
	   }
	   
	   
	   
	   $token = $data['item_token'];
	   
	   
	   if(!empty($data['demo_url']))
	   {
	   $demo_url = $data['demo_url'];
	   }
	   else
	   {
	   $demo_url = "";
	   }
	   
	   
	   
	   $support_item = $data['support_item'];
	  
	   
	   
	   $future_update = $data['future_update'];
	   
	   
	   
	   if(!empty($data['unlimited_download']))
	   {
	   
	   $unlimited_download = $data['unlimited_download'];
	   
	   }
	   else
	   {
	    $unlimited_download = "";
	   }
	   
	   
	   
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
	   
	   
	   
	   
	   
	   
	    $zipfile = $request->file('main_file'); 
		 if(isset($zipfile))
		 {
		 $myname = preg_replace('/\s+/', '', $zipfile->getClientOriginalName()); 
		 $filename = time() . '12.' . $myname;
		 
		 if($site_file_upload_by == "s3_server")
		 {
		    Storage::disk('s3')->delete($data['current_file']);
		    Storage::disk('s3')->put($filename, file_get_contents($zipfile), 'public');
			$zipname = $filename;
		 }
		 else
		 {
		 
		
		 $zipformat = base_path('images/media/itemfile/'); 
		 
		 
		 
		  $check_item = DB::table('products')
		        ->where('item_token', '=' , $data['item_token'])
				->count();
		if(!empty($check_item))
		{
		$users = DB::select('select * from products where item_token = ?',[$data['item_token']]);
		
		$loadphotos="/media/itemfile/";
			$delpathee = base_path('images'.$loadphotos.$data['current_file']);
			File::delete($delpathee);
		}
		
		 $zipfile->move($zipformat,$filename); 
		 $zipname = $filename;
		 
		 }
		 
		 
		 
			 $check_user_meta = DB::table('user_metas')
					->where('user_id', '=' , $userid)
					->where('user_meta_key', '=' , "buyers_update_approval")
					
					->count();
			if(!empty($check_user_meta))
			{
			   
				$user_meta_well = DB::table('user_metas')
					->where('user_id', '=' , $userid)
					->where('user_meta_key', '=' , "buyers_update_approval")
					
					->count();
					
				if(!empty($user_meta_well))
				{	
			   $user_meta = DB::table('user_metas')
					->where('user_id', '=' , $userid)
					->where('user_meta_key', '=' , "buyers_update_approval")
					
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
			
		 
		 if($profile_status == "yes")
		 {
		 
		     $sale_count = DB::table('product_orders')
							->where('item_token', '=', $token)
							->where('approval_status', '=', 'payment released to vendor')
							->groupBy('user_id')
							->count();
				if(!empty($sale_count))
				{
				   $view_record = DB::table('product_orders')
									->where('item_token', '=', $token)
									->where('approval_status', '=', 'payment released to vendor')
									->groupBy('user_id')
									->get();
						$userid_record = $view_record[0]->user_id;
						
						$userinfo = DB::table('users')
							            ->where('id', '=', $userid_record)
										->count();
						if(!empty($userinfo))
						{
						
						     $view_info = DB::table('users')
							            ->where('id', '=', $userid_record)
										->get();
						     foreach($view_info as $info)
							 {
							     
								 $email_info = $info->email;
								 $name_info = $info->name;
								 
								 
								 $admin_idd=1;
		
								$admin_email = DB::table('users')
										->where('id', '=', $admin_idd)
										->get();
								$item_details = DB::table('products')
										->where('item_token', '=', $token)
										->get();
								$item_id_value = $item_details[0]->item_id;
								$item_slug_value = $item_details[0]->item_slug;				
										
										
								
								$url = URL::to("/");
								
								$site_logo=$url.'/local/images/media/settings/'.$settings[0]->site_logo;
								
								$site_name = $settings[0]->site_name;
								
								$adminemail = $admin_email[0]->email;
								
								$adminname = $admin_email[0]->name;
								
								$datas = [
									'name_info' => $name_info, 'email_info' => $email_info, 'site_logo' => $site_logo,
									'site_name' => $site_name, 'url' => $url, 'item_id_value' => $item_id_value, 'item_slug_value' => $item_slug_value
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
		
		
		
								
								Mail::send('update_mail', $datas , function ($message) use ($adminemail,$adminname,$email_info,$sett_sender_name,$sett_sender_email,$lang)
								{
								
								
								
								
									$message->subject($this->call_translate( 1045, $lang));
									
									$message->from($sett_sender_email, $sett_sender_name);
						
									$message->to($email_info);
						
								}); 
								
						
								 
								 
								 
								 
								 
								 
							 }
						
						}				
						
						
									
				}			
		 
		 
		 }
		 
		 
		 
		 
		  
		 }
		 else
		 {
		    $zipname = $data['current_file'];
			
			
		 }
		 
		 
		 $url = URL::to("/");
		 
		 
		 
		 $videofile = $request->file('video_file'); 
		 if(isset($videofile))
		 {
		 $myname = preg_replace('/\s+/', '', $videofile->getClientOriginalName()); 
		 $filenamme = time() . '172.' . $myname;
		
		if($site_file_upload_by == "s3_server")
		 {
		    Storage::disk('s3')->delete($data['current_video']);
			Storage::disk('s3')->put($filenamme, file_get_contents($videofile), 'public');
			$videoname = $filenamme;
		 }
		 else
		 {
		
		
			 $check_item = DB::table('products')
					->where('item_token', '=' , $data['item_token'])
					->count();
			if(!empty($check_item))
			{
			$users = DB::select('select * from products where item_token = ?',[$data['item_token']]);
			
			$loadphotos="/media/video/";
				$delpathee = base_path('images'.$loadphotos.$data['current_video']);
				File::delete($delpathee);
			}
			
			 $videoformat = base_path('images/media/video/'); 
			 $videofile->move($videoformat,$filenamme); 
			 $videoname = $filenamme;
		 
		 }
		 
		  
		 }
		 else
		 {
		    if(!empty($data['current_video']))
			{
		    $videoname = $data['current_video'];
			}
			else
			{
			$videoname = "";
			}
		 }
		 
		 
		 
		 
		 
		 
		 $thumbnail = $request->file('item_thumbnail');
		if($thumbnail!="")
		{	
		$userphoto="/media/thumbnail/";
		$myname = preg_replace('/\s+/', '', $thumbnail->getClientOriginalName()); 
		$fileename  = time() . '78.' . $myname;
		
		$check_item = DB::table('products')
		        ->where('item_token', '=' , $data['item_token'])
				->count();
		if(!empty($check_item))
		{
		$users = DB::select('select * from products where item_token = ?',[$data['item_token']]);
		
		$loadphotos="/media/thumbnail/";
			$delpathee = base_path('images'.$loadphotos.$data['current_thumb']);
			File::delete($delpathee);
		}
		
		
		
		$patth = base_path('images'.$userphoto);
		$request->file('item_thumbnail')->move($patth, $fileename);
		$save_thumb=$fileename;
		if($site_watermark_status == "on")
			{
			$img = Image::make($url.'/local/images/media/thumbnail/'.$fileename)->resize(80,80)->encode('jpg', 50);
			 $img->insert($url.'/local/images/media/settings/'.$site_watermark,'center');
			
		
			 $img->save(base_path('images/media/thumbnail/'.$fileename));
			 }
		
		}
		else
		{
		$save_thumb=$data['current_thumb'];
		}
		 
		 
		 
	   
	   
	   $image = $request->file('preview_image');
		if($image!="")
		{	
		$userphoto="/media/preview/";
		$myname = preg_replace('/\s+/', '', $image->getClientOriginalName()); 
		$filename  = time() . '30.' . $myname;
		
		
		$check_item = DB::table('products')
		        ->where('item_token', '=' , $data['item_token'])
				->count();
		if(!empty($check_item))
		{
		$users = DB::select('select * from products where item_token = ?',[$data['item_token']]);
		
		$loadphotos="/media/preview/";
			$delpathee = base_path('images'.$loadphotos.$data['current_preview']);
			File::delete($delpathee);
		}
		
		
		$path = base_path('images'.$userphoto);
		$request->file('preview_image')->move($path, $filename);
		$savefname=$filename;
		if($site_watermark_status == "on")
			{
			$img = Image::make($url.'/local/images/media/preview/'.$filename)->resize(600, 450)->encode('jpg', 50);
			 $img->insert($url.'/local/images/media/settings/'.$site_watermark,'center');
			
		
			 $img->save(base_path('images/media/preview/'.$filename));
			 }
		}
		else
		{
		$savefname=$data['current_preview'];
		}
	   
	   
	   
	   
	   if(!empty($data['item_tags']))
	   {
	     $item_tags = $data['item_tags'];
	   }
	   else
	   {
	     $item_tags = "";
	   }
	   
	   
	   
	   
	   /*if($settings[0]->with_submit_product==1)
	   {
	     $status_approval = 0;
		 $submit_msg = $this->call_translate( 1048, $lang);
		 
	   }
	   else
	   {*/
	     $status_approval = 1;
		 $submit_msg = "Item has been updated.";
	   /*}*/
	   
	   $update_date = date("Y-m-d");
	   
	   
	   
	   
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
	      $pther = str_replace(" ","-",$item_slug);
	   }
	   else
	   {
	      $pther = $this->clean($item_slug);
	   }
	   
	 $item_id = $data['item_id'];
	 
	 
	 foreach($data['code'] as $index => $code)
		{
		
		   $pagename=$item_title[$index];
		   $pagedesc=$item_desc[$index];
		   $pageshort = $item_short_desc[$index];		
		   	
		   if($code=="en")
			{
			  
			  
			  
			 
			  
			  
			  DB::update('update products set item_title="'.$pagename.'",item_slug="'.$pther.'",item_desc="'.htmlentities($pagedesc).'",item_short_desc="'.htmlentities($pageshort).'",regular_price_six_month="'.$regular_price_six_month.'",regular_price_one_year="'.$regular_price_one_year.'",extended_price_six_month="'.$extended_price_six_month.'",extended_price_one_year="'.$extended_price_one_year.'",high_resolution="'.$high_resolution.'",compatible_browser="'.$compatiblebrowser.'",file_included="'.$file_included.'",demo_url="'.$demo_url.'",support_item="'.$support_item.'",future_update="'.$future_update.'",unlimited_download="'.$unlimited_download.'",category="'.$categoryid.'", framework_category="'.$frameworkid.'",last_update="'.$update_date.'" ,item_thumbnail="'.$save_thumb.'",preview_image="'.$savefname.'",main_file="'.$zipname.'",item_tags="'.$item_tags.'",item_status="'.$status_approval.'",lang_code="'.$code.'",item_token="'.$token.'",item_type="'.$item_type.'",item_script_type="'.$item_script_type.'",	item_layered = "'.$item_layered.'", graphics_files = "'.$graphicsid.'", adobe_cs_version = "'.$adobe_cs_version.'", pixel_dimensions = "'.$pixel_dimensions.'", print_dimensions = "'.$print_dimensions.'" where item_id = ?', [$item_id]);	
			  
			}
			else
			{
			    $counts = DB::table('products')
		            ->where('lang_code', '=', $code)
					 ->where('parent', '=', $item_id)
					  ->count();
			     if($counts==0)
				 {
						if(!empty($pagename))
						{
						   $pagenamo = $pagename;
						   $pagedeso = $pagedesc;
						   $pagesort = $pageshort;
						}
						else
						{
						   $pagenamo = "";
						   $pagedeso = "";
						   $pagesort = "";
						}
						
						
						
						
				     DB::insert('insert into products (user_id,item_title,item_slug,item_desc,item_short_desc,regular_price_six_month, regular_price_one_year,extended_price_six_month,extended_price_one_year,high_resolution,compatible_browser, file_included,demo_url,support_item,future_update,unlimited_download,category,framework_category,last_update,preview_image, 
item_thumbnail,main_file,item_tags,item_status,lang_code,
item_token,parent,item_type,item_script_type,item_layered,graphics_files,adobe_cs_version,pixel_dimensions,print_dimensions) values (?, ?,?,?,?,?, ?,?,?,?,?, ?,?,?,?,?, ?,?,?,?,?, ?,?,?,?,?,?,?, ?,?,?,?,?,?)', [$userid,$pagenamo,$pther,htmlentities($pagedeso),htmlentities($pagesort),$regular_price_six_month,  $regular_price_one_year,$extended_price_six_month,$extended_price_one_year,$high_resolution,$compatiblebrowser,  $file_included,$demo_url,$support_item,$future_update,$unlimited_download,  $categoryid,$frameworkid,$update_date,$savefname,$save_thumb,$zipname,$item_tags,$status_approval,$code,$token,$item_id,$item_type,$item_script_type,$item_layered,$graphicsid,$adobe_cs_version,$pixel_dimensions,$print_dimensions]);
					 
			
			
					 
				 }
				 else
				 {
				   
				   
				   DB::update('update products set item_title="'.$pagename.'",item_slug="'.$pther.'",item_desc="'.htmlentities($pagedesc).'",item_short_desc="'.htmlentities($pageshort).'",regular_price_six_month="'.$regular_price_six_month.'",regular_price_one_year="'.$regular_price_one_year.'",extended_price_six_month="'.$extended_price_six_month.'",extended_price_one_year="'.$extended_price_one_year.'",high_resolution="'.$high_resolution.'",compatible_browser="'.$compatiblebrowser.'",file_included="'.$file_included.'",demo_url="'.$demo_url.'",support_item="'.$support_item.'",future_update="'.$future_update.'",unlimited_download="'.$unlimited_download.'",category="'.$categoryid.'", framework_category="'.$frameworkid.'",last_update="'.$update_date.'" ,item_thumbnail="'.$save_thumb.'",preview_image="'.$savefname.'",main_file="'.$zipname.'",item_tags="'.$item_tags.'",item_status="'.$status_approval.'",item_token="'.$token.'",item_type="'.$item_type.'",item_script_type="'.$item_script_type.'",	item_layered = "'.$item_layered.'", graphics_files = "'.$graphicsid.'", adobe_cs_version = "'.$adobe_cs_version.'", pixel_dimensions = "'.$pixel_dimensions.'", print_dimensions = "'.$print_dimensions.'" where lang_code="'.$code.'" and parent = ?', [$item_id]);	
				   
				   
				  
				   
				   
				 }
			
			}
		}
		
	   	
			
		
			
			
			
			
	   
	  } 
	  
	  
	  
	  $picture = '';
			if ($request->hasFile('image')) {
				$files = $request->file('image');
				foreach($files as $file){
					
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					$myname = preg_replace('/\s+/', '', $file->getClientOriginalName());
					$picture = time().'65'.$myname;
					
					if($site_file_upload_by == "s3_server")
					 {
						
						Storage::disk('s3')->put($picture, file_get_contents($file), 'public');
						
					 }
					 else
					 {
					
					
					
						$destinationPath = base_path('images/media/screenshots/');
						$file->move($destinationPath, $picture);
						if($site_watermark_status == "on")
						{
						$img = Image::make($url.'/local/images/media/screenshots/'.$picture)->encode('jpg', 50);
						 $img->insert($url.'/local/images/media/settings/'.$site_watermark,'center');
						
					
						 $img->save(base_path('images/media/screenshots/'.$picture));
						 }
					 
					 }
					 
					
					DB::insert('insert into product_images (item_token,image) values (?, ?)', [$token,$picture]);
					
				}
			}
			
			
			 
			
		
		
		
		if($videofile!="")
		{
		
		   $check_item_meta =  DB::table('product_metas')
		        				->where('item_token', '=' , $token)
				                ->where('item_meta_key', '=' , 'item_video_preview')
		                        ->count();
			if(!empty($check_item_meta))
			{
			   DB::update('update product_metas set item_meta_value="'.$videoname.'" where item_meta_key="item_video_preview" and item_token = ?', [$token]);
			}
			else
			{
			DB::insert('insert into product_metas (item_token,user_id,item_meta_key,item_meta_value) values (?, ?, ?, ?)', [$token,$userid,'item_video_preview',$videoname]);
			
			}					
		
		  
		}
			
			
	   
	  
	   return back()->with('success', $submit_msg);
	   
	}   
	
	
	
	
	
   
	
	
	
	
	
	
}
