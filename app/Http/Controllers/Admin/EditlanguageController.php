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


class EditlanguageController extends Controller
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
    
	
	public function showform($id) {
      $language = DB::select('select * from codepopular_langs where id = ?',[$id]);
      return view('admin.edit-language',['language'=>$language]);
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
            'slide_title' => 'required|string|max:255'
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
	 
	  
	 
    protected function languagedata(Request $request)
    {
        /*return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);*/
		
		
		
		 $this->validate($request, [

        		'lang_name' => 'required'

        		
				
				

        	]);
			
			 $settings = DB::select('select * from settings where id = ?',[1]);
	      $imgsize = $settings[0]->image_size;
		  $imgtype = $settings[0]->image_type;
         
		 $data = $request->all();
			
         $id=$data['id'];
        			
		
       
		
		$rules = array(
		
		'lang_name'=>'required|unique:codepopular_langs,lang_name,'.$id,
		'lang_code' => 'required|unique:codepopular_langs,lang_code,'.$id,
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
		  

			
		
		
		$currentphoto=$data['currentphoto'];
		
		
		$image = $request->file('lang_flag');
		 if($image!="")
		 {
             $nimage = DB::table('codepopular_langs')->where('id', $id)->first();
		$orginalfiles=$nimage->lang_flag;
			 $npath = base_path('images/media/language/'.$orginalfiles);
	  File::delete($npath);
			
			$filename  = time() . '.' . $image->getClientOriginalExtension();
            $photo="/media/language/";
            $path = base_path('images'.$photo.$filename);
			$destinationPath=base_path('images'.$photo);
 
        
               Image::make($image->getRealPath())->resize(24, 24)->save($path);
				 
				$savefname=$filename;
		 }
        else
		{
			$savefname=$currentphoto;
		}			
		
		
		
		
		
		$lang_name=$data['lang_name'];
		$lang_code=$data['lang_code'];
		
		
		
		
		
		
		
		
		
		DB::update('update codepopular_langs set lang_name="'.$lang_name.'",lang_code="'.$lang_code.'",lang_flag="'.$savefname.'" where id = ?', [$id]);
		
			return back()->with('success', 'Language has been updated');
        }
		
		
		
		
    }
}
