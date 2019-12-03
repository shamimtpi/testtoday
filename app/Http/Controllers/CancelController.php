<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Mail;
use Cookie;

class CancelController extends Controller
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
    
	
	public function avigher_payu_failed($cid) 
	{
			
			
			
			
				
				
			
		
	 $datas = array('cid' => $cid);
     return view('payu_failed')->with($datas);
		
	
	  
	
	}
	
	
	public function avigher_returnpage(Request $request) 
	{
	
	 return view('cancel');
	}
	
	
	
	public function avigher_showpage() {
		
		 
		 
		 
		 
		
		
		
		
		
	 
	  
      return view('cancel');
   }
   
   
   
  
	
	
	
	
	
	
	
	
	
	
}
