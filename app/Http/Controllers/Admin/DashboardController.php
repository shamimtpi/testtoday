<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
/*use App\Article;
use App\ArticleCategory;
use App\User;
use App\Photo;
use App\PhotoAlbum;*/
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class DashboardController extends AdminController {

    public function __construct()
    {
        parent::__construct();
        view()->share('type', '');
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
		
	
        $title = "Dashboard";
		
		$total_user = DB::table('users')
		              ->where('delete_status','=','')
		              ->where('id','!=','1')
			           ->count();


        $blog_cnt = DB::table('posts')
		        ->where('post_type', '=' , 'blog')
				->where('lang_code','=','en')
				->where('post_status', '=' , '1')
		        ->orderBy('post_id','desc')
				->limit(3)->offset(0)
				->count();
				
			 $top_items_count = DB::table('products')
				->where('delete_status', '=', '')
				->where('lang_code','=','en')
				->where('item_status', '=', 1)
				->orderBy('item_id', 'desc')
				->limit(3)->offset(0)
				->count();	
				
				
           $items_count = DB::table('products')
				->where('delete_status', '=', '')
				->where('item_status', '=', 1)
				->where('lang_code','=','en')
				->orderBy('item_id', 'desc')->count();	
		
         $blog = DB::table('posts')
		        ->where('post_type', '=' , 'blog')
				->where('post_status', '=' , '1')
				->where('lang_code','=','en')
		        ->orderBy('post_id','desc')
				->limit(3)->offset(0)
				->get();
		
		
        $total_blog = DB::table('posts')
			           ->where('post_type','=', 'blog')
					   ->where('lang_code','=','en')
					   ->count();
					   
					   
		$total_comment = DB::table('posts')
			           ->where('post_type','=', 'comment')
					   ->count();

         
					  
				$set_id=1;
		$setting = DB::table('settings')->where('id', $set_id)->get();	   
		
		$users = DB::table('users')
		         ->where('id','!=','1')
		         ->orderBy('id','desc')
				 ->limit(4)->offset(0)
				 ->get();
				 
			
				 
				

       $pages = DB::table('pages')
		         ->where('lang_code','=','en')
				 ->count();	
				 
				 
				 
		$curr_date=date("Y-m-d");

       $last_date1=date('Y-m-d',strtotime("-1 days"));
       $last_date2=date('Y-m-d',strtotime("-2 days"));
       $last_date3=date("Y-m-d", strtotime("-3 days"));
       $last_date4=date("Y-m-d", strtotime("-4 days"));
       $last_date5=date("Y-m-d", strtotime("-5 days"));
       $last_date6=date("Y-m-d", strtotime("-6 days"));


                      $date1 = DB::table('product_checkouts')
			           ->where('payment_date','=', $curr_date)
					   ->count();
					   $date2 = DB::table('product_checkouts')
			           ->where('payment_date','=', $last_date1)
					   ->count();
					   $date3 = DB::table('product_checkouts')
			           ->where('payment_date','=', $last_date2)
					   ->count();
					   $date4 = DB::table('product_checkouts')
			           ->where('payment_date','=', $last_date3)
					   ->count();
					   $date5 = DB::table('product_checkouts')
			           ->where('payment_date','=', $last_date4)
					   ->count();
					   $date6 = DB::table('product_checkouts')
			           ->where('payment_date','=', $last_date5)
					   ->count();
					   $date7 = DB::table('product_checkouts')
			           ->where('payment_date','=', $last_date6)
					   ->count();
                $javas="{ label: '$last_date6', y: $date7 },";
				$javas.="{ label: '$last_date5', y: $date6 },";
				$javas.="{ label: '$last_date4', y: $date5 },";
				$javas.="{ label: '$last_date3', y: $date4 },";
				$javas.="{ label: '$last_date2', y: $date3 },";
				$javas.="{ label: '$last_date1', y: $date2 },";
				$javas.="{ label: '$curr_date', y: $date1 },";
		  
				 
				 
				 
				 

       $newsletter = DB::table('newsletters')
		         
				 ->count();	

				 
		
		$data = array('total_user' => $total_user, 'total_blog' => $total_blog, 'setting' => $setting, 'users' => $users,
		'pages' => $pages, 'newsletter' => $newsletter, 'total_comment' => $total_comment, 'blog' => $blog, 'blog_cnt' => $blog_cnt, 'items_count' => $items_count,'top_items_count' => $top_items_count, 'cany_check_value' => $cany_check_value, 'javas' => $javas);
		
		return view('admin.index')->with($data);
		
		
		
		
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
    
	
	
	
	
}