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


class VerifyController extends Controller
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
		
	  $data=array('msettings'=>$msettings, 'code_feedback' => $code_feedback, 'cc_byname' => $cc_byname);
      return view('admin.verify-purchase-code')->with($data);
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
	 
    protected function settings(Request $request)
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
		
		
		
		if($data['purchase_code']!="")
		{
		
		   $check_user_meta =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 73)
				                ->where('sett_meta_key', '=' , 'cc_token')
		                        ->count();
			if(!empty($check_user_meta))
			{
			   DB::update('update settings_metas set sett_meta_value="'.base64_encode($data['purchase_code']).'" where sett_meta_key="cc_token" and sett_meta_id = ?', [73]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [73,"cc_token",base64_encode($data['purchase_code'])]);
			
			}					
		
		  
		}
		
		
		if($data['buyer_name']!="")
		{
		
		   $check_user_meta =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 74)
				                ->where('sett_meta_key', '=' , 'cc_byname')
		                        ->count();
			if(!empty($check_user_meta))
			{
			   DB::update('update settings_metas set sett_meta_value="'.base64_encode($data['buyer_name']).'" where sett_meta_key="cc_byname" and sett_meta_id = ?', [74]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [74,"cc_byname",base64_encode($data['buyer_name'])]);
			
			}					
		
		  
		}
		
			return back()->with('success', 'Purchase details has been updated');
        
		
		}
		
		
    }
}
