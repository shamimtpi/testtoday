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

class AddsubframeworkController extends Controller
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
        return view('admin.add_framework_subcategory', ['language' => $language]);

    }
	
	
	public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	} 
	
	
	
	
	
	public function getcategory()

    {
         $language = DB::table('codepopular_langs')
		            ->where('lang_status', '=', 1)
					->orderBy('id','asc')
					->get();
        $category = DB::table('product_categories')
		            ->where('delete_status','=','')
					->where('cat_type','=','framework')
					->orderBy('cat_name', 'asc')->get();

        return view('admin.add_framework_subcategory', ['category' => $category,'language' => $language]);

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
	 
    protected function addsubcategorydata(Request $request)
    {
        
		
		
		 $this->validate($request, [

        		'name' => 'required'

        		
				
				

        	]);
         
		 
				
		$input['name'] = $request->input('name');
       $settings = DB::select('select * from settings where id = ?',[1]);
	   
	   $imgsize = $settings[0]->image_size;
	   $imgtype = $settings[0]->image_type;
		
		$rules = array(
		
		
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

		if(!empty($data['name']))
		{	
		$name=$data['name'];
		}
		else
		{
		  $name = "";
		}
		$cat_id=$data['cat_id'];
		
		$subcat_type = "framework";
		
		$status = 1;
		
		
		
		
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
			   
			       $subcategory = DB::table('product_subcats')
		           	->where('token', '=', $token)
					->where('subcat_type','=',$subcat_type)
					->where('parent', '=', 0)
					->get();
					
					 $subcategory_cnt = DB::table('product_subcats')
		           		->where('token', '=', $token)
						->where('subcat_type','=',$subcat_type)
					->where('parent', '=', 0)
					->count();
					if($subcategory_cnt==0)
					{
					
                       	$parent = $idd;				
					  
					   
					}
					else
					{
					   $parent=$subcategory[0]->subid;
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
		
		
		
		
		
		
		$idd = DB::table('product_subcats')-> insertGetId(array(
        'subcat_name' => $pagenamo,
		'post_slug' => $pther,
		'cat_id' => $cat_id,
		'subimage' => $namef,
		'lang_code' => $code,
		'token' => $token,
		'parent' => $parent,
		'status' => $status,
		'subcat_type' => $subcat_type,
			));
		
		
		}
		
		
		
		
		
		
			return back()->with('success', 'Sub category has been created');
        }
		
		
		
		
    }
}
