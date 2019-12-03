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
use Illuminate\Support\Facades\DB;

class AddlanguageController extends Controller
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

        return view('admin.add-language');

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
	 
	 /* protected $fillable = ['name', 'email','password','phone']; */
	 
    protected function addlanguagedata(Request $request)
    {
        
		
		
		 $this->validate($request, [

        		'lang_name' => 'required'

        		
				
				

        	]);
         
		 
				
		
       
	    $settings = DB::select('select * from settings where id = ?',[1]);
	      $imgsize = $settings[0]->image_size;
		  $imgtype = $settings[0]->image_type;
	   
		
		$rules = array(
		
		'lang_name' => 'unique:codepopular_langs,lang_name',
		'lang_code' => 'unique:codepopular_langs,lang_code',
		'lang_flag' => 'max:'.$imgsize.'|mimes:'.$imgtype
		
		
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
		 

		
	
	
	     $image = $request->file('lang_flag');
		 if($image!="")
		 {
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $photo="/media/language/";
            $path = base_path('images'.$photo.$filename);
			$destinationPath=base_path('images'.$photo);
 
        
               Image::make($image->getRealPath())->resize(24, 24)->save($path);
				 
				$namef=$filename;
		 }
		 else
		 {
			 $namef="";
		 }
	
	
	
	
	
	
	
		  $data = $request->all();

			
		$lang_name=$data['lang_name'];
		$lang_code=$data['lang_code'];
		
		
		
		$status = 1;
		
		DB::insert('insert into codepopular_langs (	lang_name, 	lang_code,  lang_flag, lang_status) values (?, ? ,?, ?)', [$lang_name,$lang_code,$namef,$status]);
		
		
			return back()->with('success', 'Language has been created');
        }
		
		
		
		
    }
}
