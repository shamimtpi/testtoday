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


class EditcategoryController extends Controller
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
      $category = DB::select('select * from product_categories where id = ?',[$id]);
	  $language = DB::table('codepopular_langs')
		            ->where('lang_status', '=', 1)
					->orderBy('id','asc')
					->get();
      return view('admin.editcategory',['category'=>$category, 'language' => $language]);
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
	 
	public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	}   
	 
    protected function editcategorydata(Request $request)
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
	   $imgtype = $settings[0]->image_type;
		
		$rules = array(
		
		'name'=>'required'
		
		/*'photo' => 'max:'.$imgsize.'|mimes:'.$imgtype*/
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
		
		
		

		

			/*User::create([
            'name' => $data['name'],
            'email' => $data['email'],
			'admin' => '0',
            'password' => bcrypt($data['password']),
			'phone' => $data['phone']
			
        ]);*/
		$name=$data['name'];
		
		
		
		
		
		
		if(!empty($data['display_menu']))
		{
		   $display_menu = $data['display_menu'];
		}
		else
		{
		 $display_menu = "";
		}			
		
		$cat_type = "default";
		
		$status = 1;
		
		
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
		
		   $pagename=$name[$index];
		   
		   	
		   if($code=="en")
			{
			  
			  DB::update('update product_categories set cat_name="'.$pagename.'",post_slug="'.$pther.'",	display_menu="'.$display_menu.'",lang_code="'.$code.'",status="'.$status.'",cat_type="'.$cat_type.'" where id = ?', [$id]);
			}
			else
			{
			    $counts = DB::table('product_categories')
		            ->where('lang_code', '=', $code)
					->where('cat_type','=',$cat_type)
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
				     DB::insert('insert into product_categories (cat_name, post_slug, display_menu, lang_code, token, parent, status, cat_type) values (?, ?, ?, ?, ?, ?, ?, ?)', [$pagenamo,$pther,$display_menu,$code,$token,$id, $status, $cat_type]);
				 }
				 else
				 {
				   DB::update('update product_categories set cat_name="'.$pagename.'",post_slug="'.$pther.'",display_menu="'.$display_menu.'",cat_type="'.$cat_type.'" where lang_code="'.$code.'" and parent = ?', [$id]);
				 }
			
			}
		}
		
		
		
		
			return back()->with('success', 'Category has been updated');
        }
		
		
		
		
    }
}
