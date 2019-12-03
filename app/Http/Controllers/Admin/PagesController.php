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

class PagesController extends Controller
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
		
	
        $pages = DB::table('pages')
		         ->where('lang_code','=','en')
				 ->get();

        return view('admin.pages', ['pages' => $pages, 'cany_check_value' => $cany_check_value]);
    }
	
	
	public function showform($id) {
	
	 $idd = base64_decode($id);
	    $language = DB::table('codepopular_langs')
		            ->where('lang_status', '=', 1)
					->orderBy('id','asc')
					->get();
      $pages = DB::select('select * from pages where page_id = ?',[$idd]);
      return view('admin.edit-page',['pages'=>$pages, 'language' => $language]);
   }
   
   public function formview()

    {
        $language = DB::table('codepopular_langs')
		            ->where('lang_status', '=', 1)
					->orderBy('id','asc')
					->get();
        return view('admin.add-page', ['language' => $language]);

    }
	
	
	
	
	
	public function avigher_report()
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
		
	
	
	  $report_count = DB::table('product_reports')
		                  ->orderBy('rid','desc')
					      ->count();
	   
	   
	    $report_view = DB::table('product_reports')
		                  ->orderBy('rid','desc')
					     ->get();
					   
		$set_id=1;
		$site_setting = DB::table('settings')->where('id', $set_id)->get();			   

        return view('admin.report', ['report_count' => $report_count, 'report_view' => $report_view, 'site_setting' => $site_setting, 'cany_check_value' => $cany_check_value]);
	
	
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
    
	
	
	public function avigher_report_delete($id)
	{
	
	
	DB::delete('delete from product_reports where rid = ?',[$id]);
	   
      return back();
	
	
	}
	
	
	
	public function avigher_contact()
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
		
	  
	
	  $contact_count = DB::table('contact_uses')
		                  ->orderBy('cont_id','desc')
					      ->count();
	   
	   
	    $contact_view = DB::table('contact_uses')
		                 ->orderBy('cont_id','desc')
					     ->get();
					   
		$set_id=1;
		$site_setting = DB::table('settings')->where('id', $set_id)->get();			   

        return view('admin.contact', ['contact_count' => $contact_count, 'contact_view' => $contact_view, 'site_setting' => $site_setting, 'cany_check_value' => $cany_check_value]);
	
	
	}
	
	
	
	public function avigher_contact_delete($id)
	{
	
	
	DB::delete('delete from contact_uses where cont_id = ?',[$id]);
	   
      return back();
	
	
	}
	
	
	
	
	
	
	public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	}
	
	
	
	
	
	
	protected function addpagedata(Request $request)
    {
       
		
		
		$this->validate($request, [

        		'page_title' => 'required'

        		
				
				

        	]);
         
		 
				
		$input['page_title'] = $request->input('page_title');
		$settings = DB::select('select * from settings where id = ?',[1]);
	   
	   $imgsize = $settings[0]->image_size;
	   $imgtype = $settings[0]->image_type;
       
		
		$rules = array(
		'page_title' => 'required|unique:pages,page_title', 		
		'photo' => 'max:'.$imgsize.'|mimes:'.$imgtype
		
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
		
		
		 $image = $request->file('photo');
		 if($image!="")
		 {
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $userphoto="/media/page/";
            $path = base_path('images'.$userphoto.$filename);
			$destinationPath=base_path('images'.$userphoto);
 
        
                Image::make($image->getRealPath())->resize(1031, 541)->save($path);
				/*$request->file('photo')->move($destinationPath, $filename);*/
               /* $user->image = $filename;
                $user->save();*/
				$namef=$filename;
		 }
		 else
		 {
			 $namef="";
		 }

		
		
		  $data = $request->all();

			
		$page_title=$data['page_title'];
		if(!empty($data['page_desc']))
		{
		   $page_desc = $data['page_desc'];
		}
		else
		{
		   $page_desc = "";
		}
		
		
		
		
		if(!empty($data['menu_position']))
		{
		$menu_opt="";
		foreach($data['menu_position'] as $with)
		{
			$menu_opt .=$with.",";
		}
		$menu_position = rtrim($menu_opt,",");
		}
		else
		{
		$menu_position = "";
		}
		
		
		
		
		
		if(!empty($data['menu_order']))
		{
		    $menu_order = $data['menu_order'];
		}
		else
		{
		   $menu_order = "";
		}
		
		
		if(!empty($data['slug']))
		{
		   $slug = $data['slug'];
		}
		else
		{
		  $slug = "";
		}
		
		
		
		
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
	      $pther = str_replace(" ","-",$slug);
	   }
	   else
	   {
	      $pther = $this->clean($slug);
	   }
	   
		
		
		
		
	    $token = $data['token'];
		foreach($data['code'] as $index => $code)
		{
		
		   $pagename=$page_title[$index];
		   $pagedesc=$page_desc[$index];
		   
		
			if($code=='en')
			   {
				   $parent=0;
			   }
			   else
			   {
			   
			       $pages = DB::table('pages')
		           	->where('token', '=', $token)
					->where('parent', '=', 0)
					->get();
					
					 $pages_cnt = DB::table('pages')
		           		->where('token', '=', $token)
					->where('parent', '=', 0)
					->count();
					if($pages_cnt==0)
					{
					
                       	$parent = $idd;				
					  
					   
					}
					else
					{
					   $parent=$pages[0]->page_id;
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
		
		
		
		
		$idd = DB::table('pages')-> insertGetId(array(
        'page_title' => $pagenamo,
		'post_slug' => $pther,
		'page_desc' => htmlentities($pagedeo),
		'photo' => $namef,
		'menu_position' => $menu_position,
		'menu_order' => $menu_order,
        'lang_code' => $code,
		'token' => $token,
		'parent' => $parent,
		));
		
		
		}
			
		
		
		
		
		
		
			return back()->with('success', 'Page has been created');
        
		
		
		}
		
         
		 
		 
		 
	}
	
	
	
   
   
   protected function pagedata(Request $request)
    {
       
		
		
		
		$this->validate($request, [

        		'page_title' => 'required'

        		
				
				

        	]);
         $data = $request->all();
		 
				
		$input['page_title'] = $request->input('page_title');
		$settings = DB::select('select * from settings where id = ?',[1]);
	   
	   $imgsize = $settings[0]->image_size;
	   $imgtype = $settings[0]->image_type;
       
		
		$rules = array(
		'page_title' => 'required', 
		
		
		'photo' => 'max:'.$imgsize.'|mimes:'.$imgtype
		
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
		
		
		
		 
		    $currentphoto=$data['currentphoto'];
			
			 $image = $request->file('photo');
		 
		
		 
		 
		 if($image!="")
		{	
            $servicephoto="/media/page/";
			$delpath = base_path('images'.$servicephoto.$currentphoto);
			File::delete($delpath);	
			$filename  = time() . '.' . $image->getClientOriginalExtension();
            
            $path = base_path('images'.$servicephoto.$filename);
			$destinationPath=base_path('images'.$servicephoto);
      
                
				
				Image::make($image->getRealPath())->resize(1031, 541)->save($path);
				$namef=$filename;
		}
        else
		{
			if(!empty($currentphoto))
			{
			$namef=$currentphoto;
			}
			else
			{
			  $namef = "";
			}
		}		
		 
		 
		 
		
		
		
		  

			
		$page_title=$data['page_title'];
		if(!empty($data['page_desc']))
		{
		   $page_desc = $data['page_desc'];
		}
		else
		{
		   $page_desc = "";
		}
		
		$page_id=$data['page_id'];
		
		
		
		
		if(!empty($data['menu_position']))
		{
		$menu_opt="";
		foreach($data['menu_position'] as $with)
		{
			$menu_opt .=$with.",";
		}
		$menu_position = rtrim($menu_opt,",");
		}
		else
		{
		$menu_position = "";
		}
		
		
		
		
		if(!empty($data['menu_order']))
		{
		    $menu_order = $data['menu_order'];
		}
		else
		{
		   $menu_order = "";
		}
		
		
		
		if(!empty($data['slug']))
		{
		   $slug = $data['slug'];
		}
		else
		{
		  $slug = "";
		}
		
		
		
		
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
	      $pther = str_replace(" ","-",$slug);
	   }
	   else
	   {
	      $pther = $this->clean($slug);
	   }
	   
		
		
		
		
		
		$token = $data['token'];
		foreach($data['code'] as $index => $code)
		{
		
		   $pagename=$page_title[$index];
		   $pagedesc=$page_desc[$index];		
		   	
		   if($code=="en")
			{
			  
			  DB::update('update pages set page_title="'.$pagename.'",post_slug="'.$pther.'",page_desc="'.htmlentities($pagedesc).'",photo="'.$namef.'",menu_position="'.$menu_position.'",menu_order="'.$menu_order.'",lang_code="'.$code.'" where page_id = ?', [$page_id]);
			}
			else
			{
			    $counts = DB::table('pages')
		            ->where('lang_code', '=', $code)
					 ->where('parent', '=', $page_id)
					  ->count();
			     if($counts==0)
				 {
						if(!empty($pagename))
						{
						   $pagenamo = $pagename;
						   $pagedeso = $pagedesc;
						}
						else
						{
						   $pagenamo = "";
						   $pagedeso = "";
						}
				     DB::insert('insert into pages (page_title, post_slug, page_desc, photo, menu_position, menu_order, lang_code, token, parent) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$pagenamo,$pther,htmlentities($pagedeso),$namef,$menu_position,$menu_order,$code,$token,$page_id]);
				 }
				 else
				 {
				   DB::update('update pages set page_title="'.$pagename.'",post_slug="'.$pther.'",page_desc="'.htmlentities($pagedesc).'",photo="'.$namef.'",menu_position="'.$menu_position.'",menu_order="'.$menu_order.'" where lang_code="'.$code.'" and parent = ?', [$page_id]);
				 }
			
			}
		}
		
		
		
		
		
			return back()->with('success', 'Page has been updated');
        
		
		
		}
		
		
		
		
		
		
		
    }
   
   
   
   public function deleted($id) {
	
	     $idd = base64_decode($id);
		
		$image = DB::table('pages')->where('page_id', $idd)->first();
		$orginalfile=$image->photo;
		$userphoto="/media/page/";
       $path = base_path('images'.$userphoto.$orginalfile);
	  File::delete($path);
	  
	  
	   DB::delete('delete from pages where page_id!=4 and page_id!=1 and parent = ?',[$idd]);
      DB::delete('delete from pages where page_id!=4 and page_id!=1 and page_id = ?',[$idd]);
	  
	  
      
	   
      return back();
	  
      
      
   }
   
   
   
   
   
   protected function delete_all(Request $request)
    {
		
		$data = $request->all();
	   $pageid = $data['pageid'];
	   
	   foreach($pageid as $pid)
	   {
   
   
		  $image = DB::table('pages')->where('page_id', $pid)->get();
			$orginalfile=$image[0]->photo;
			$userphoto="/media/page/";
		   $path = base_path('images'.$userphoto.$orginalfile);
		  File::delete($path);
		  
		  DB::delete('delete from pages where page_id!=4 and page_id!=1 and parent = ?',[$pid]);
      DB::delete('delete from pages where page_id!=4 and page_id!=1 and page_id = ?',[$pid]);
		  
		
		   
		  
      
        }
   return back();
		
		
		
	   
   }
   
   
   
   
   
   
   
	
	public function destroy($id) {
		
		
	   
      return back();
      
   }
	
}