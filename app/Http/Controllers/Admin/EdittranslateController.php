<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use File;
use Image;


class EdittranslateController extends Controller
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
	
	$language = DB::table('codepopular_langs')
		            ->where('lang_status', '=', 1)
					->orderBy('id','asc')
					->get();
      $translate = DB::select('select * from codepopular_translates where id = ?',[$id]);
      return view('admin.edittranslate',['translate'=>$translate, 'language' => $language]);
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
            'name' => 'required|string|max:255'
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
	 
	  
	 
    protected function edittranslatedata(Request $request)
    {
        /*return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);*/
		
		
		
		 $this->validate($request, [

        		'name' => 'required'

        		
				
				

        	]);
         
		 $data = $request->all();
			
         $id=$data['id'];
        			
		$input['name'] = $request->input('name');
       
	    $settings = DB::select('select * from settings where id = ?',[1]);
	      $imgsize = $settings[0]->image_size;
	   
		
		$rules = array(
		
		/*'name'=>'required|unique:codepopular_translates,name,'.$id,*/
		
		'photo' => 'max:'.$imgsize.'|mimes:jpg,jpeg,png'
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
		
		
		

		

		
		
		
		
		
		
		
		$name=$data['name'];
		$token = $data['token'];
		foreach($data['code'] as $index => $code)
		{
		
		   $pagename=$name[$index];		
		   	
		   if($code=="en")
			{
			  DB::update('update codepopular_translates set name="'.$pagename.'",lang_code="'.$code.'" where id = ?', [$id]);
			}
			else
			{
			    $counts = DB::table('codepopular_translates')
		            ->where('lang_code', '=', $code)
					 ->where('parent', '=', $id)
					  ->count();
			     if($counts==0)
				 {
						if(!empty($pagename))
						{
						   $pagenamo = $pagename;
						}
						else
						{
						   $pagenamo = "";
						}
				     DB::insert('insert into codepopular_translates (name, lang_code, token, parent) values (?, ?, ?, ?)', [$pagenamo,$code,$token,$id]);
				 }
				 else
				 {
				   DB::update('update codepopular_translates set name="'.$pagename.'" where lang_code="'.$code.'" and parent = ?', [$id]);
				 }
			
			}
		}
		
		/* DB::insert('insert into users (name, email,password,phone,admin) values (?, ?,?, ?,?)', [$name,$email,$password,$phone,$admin]);*/
		
		
			return back()->with('success', 'Translate text has been updated');
        }
		
		
		
		
    }
}
