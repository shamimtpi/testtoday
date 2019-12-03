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

class AddcategoryController extends Controller
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
        $language = DB::table('codepopular_langs')
		            ->where('lang_status', '=', 1)
					->orderBy('id','asc')
					->get();
        return view('admin.addcategory', ['language' => $language]);

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
	 
	 
	public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	} 
	 
    protected function addcategorydata(Request $request)
    {
        
		
		
		 $this->validate($request, [

        		'name' => 'required'

        		
				
				

        	]);
         
		 
				
		$input['name'] = $request->input('name');
		$settings = DB::select('select * from settings where id = ?',[1]);
	   
	   $imgsize = $settings[0]->image_size;
	   $imgtype = $settings[0]->image_type;
       
		
		$rules = array(
		'name' => 'required' 
		
		
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
		
		
		 $image = $request->file('photo');
		 if($image!="")
		 {
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $userphoto="/media/";
            $path = base_path('images'.$userphoto.$filename);
			$destinationPath=base_path('images'.$userphoto);
 
        
                Image::make($image->getRealPath())->resize(400, 290)->save($path);
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

			/*User::create([
            'name' => $data['name'],
            'email' => $data['email'],
			'admin' => '0',
            'password' => bcrypt($data['password']),
			'phone' => $data['phone']
			
        ]);*/
		
		if(!empty($data['name']))
		{
		$name=$data['name'];
		}
		else
		{
		  $name = "";
		}
		
		$status = 1;
		
		if(!empty($data['display_menu']))
		{
		   $display_menu = $data['display_menu'];
		}
		else
		{
		 $display_menu = 0;
		}
		
		
		if(!empty($data['slug']))
		{
		   $slug = $data['slug'];
		}
		else
		{
		  $slug = "";
		}
		
		
		
		
		$cat_type = "default";
		
		
		
		
		$token = $data['token'];
		foreach($data['code'] as $index => $code)
		{
		
		   $pagename=$name[$index];
		   
		   
		
			if($code=='en')
			   {
				   $parent=0;
			   }
			   else
			   {
			   
			       $category = DB::table('product_categories')
		           	->where('token', '=', $token)
					->where('cat_type','=',$cat_type)
					->where('parent', '=', 0)
					->get();
					
					 $category_cnt = DB::table('product_categories')
		           		->where('token', '=', $token)
						->where('cat_type','=',$cat_type)
					->where('parent', '=', 0)
					->count();
					if($category_cnt==0)
					{
					
                       	$parent = $idd;				
					  
					   
					}
					else
					{
					   $parent=$category[0]->id;
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
		
		
		
		
		$idd = DB::table('product_categories')-> insertGetId(array(
        'cat_name' => $pagenamo,
		'post_slug' => $pther,
		'image' => $namef,
		'display_menu' => $display_menu,
		'lang_code' => $code,
		'cat_type' => $cat_type,
		'token' => $token,
		'parent' => $parent,
		'status' => $status,
			));
		
		
		}
		
		
		
		
		
		
			return back()->with('success', 'Category has been created');
        
		
		
		}
		
		
		
		
    }
}
