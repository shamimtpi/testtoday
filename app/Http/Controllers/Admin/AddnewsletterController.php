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
use Mail;
use Illuminate\Support\Facades\DB;

class AddnewsletterController extends Controller
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
       
	   $set_id=1;
		$setting = DB::table('settings')->where('id', $set_id)->get();
		
		$aid=1;
		$admindetails = DB::table('users')
		 ->where('id', '=', $aid)
		 ->get();
		
		$data=array('setting' => $setting, 'admindetails' => $admindetails);
	   
        return view('admin.sendupdates')->with($data);

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
	 
    protected function addupdatedata(Request $request)
    {
        /*return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);*/
		
		
		
		 $this->validate($request, [

        		'nsubject' => 'required'

        		

        		
				
				

        	]);
         
		 
				
		
		
		$input['nsubject'] = $request->input('nsubject');
      
		
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
		
		
		
		

		$nsubject=$data['nsubject'];
		$msg=$data['message'];
		$admin_email = $data['admin_email'];
		$site_logo = $data['site_logo'];
		$site_url = $data['site_url'];
		$site_name = $data['site_name'];
		
		
		$newsletter = DB::table('newsletters')->where('activated', '=', '1')->get();	
		
		foreach($newsletter as $letter)
		{	
		$to_address = $letter->email;
		
		$datas = [
            'nsubject' => $nsubject, 'msg' => $msg, 'site_logo' => $site_logo, 'site_url' => $site_url, 'site_name' => $site_name
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
		
		
		
		
		
		Mail::send('admin.newsletteremail', $datas , function ($message) use ($admin_email,$to_address,$sett_sender_name,$sett_sender_email)
        {
            $message->subject('Newsletter Subscription');
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($to_address);

        }); 
		
		
		
		}
		
		
			
			
			return redirect()->back()->with('success', 'Email has been sent successfully');
        }
		
		
		
		
    }
}
