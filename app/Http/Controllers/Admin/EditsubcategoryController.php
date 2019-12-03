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


class EditsubcategoryController extends Controller
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
    
	
	
	public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	} 
	
	
	public function edit($id)

    {
		
		
	 $subcategory = DB::select('select * from product_subcats where delete_status="" and subid = ?',[$id]);
     

       $category = DB::table('product_categories')
	               ->where('delete_status','=','')
				   ->where('cat_type','=','default')
				   ->where('parent','=',0)
				   ->orderBy('cat_name', 'asc')->get();

         $language = DB::table('codepopular_langs')
		            ->where('lang_status', '=', 1)
					->orderBy('id','asc')
					->get();
		
		$data = array('subcategory'=>$subcategory, 'category'=>$category, 'language' => $language);
            return view('admin.editsubcategory')->with($data);

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
	 
	  
	 
    protected function editsubcategorydata(Request $request)
    {
        
		
		
		 $this->validate($request, [

        		'name' => 'required'

        		
				
				

        	]);
         
		 $data = $request->all();
			
         $subid=$data['subid'];
        			
		$input['name'] = $request->input('name');
       
		$settings = DB::select('select * from settings where id = ?',[1]);
	   
	   $imgsize = $settings[0]->image_size;
	   $imgtype = $settings[0]->image_type;
		
		
		
		 
		
		/*$rules = array('name' => 'unique:subservices,subname,'.$data['subid'].',subid'); */
		
		
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
		
		$currentphoto=$data['currentphoto'];
		
		
		$image = $request->file('photo');
        if($image!="")
		{	
            $subservicephoto="/media/";
			$delpath = base_path('images'.$subservicephoto.$currentphoto);
			File::delete($delpath);	
			$filename  = time() . '.' . $image->getClientOriginalExtension();
            
            $path = base_path('images'.$subservicephoto.$filename);
			$destinationPath=base_path('images'.$subservicephoto);
      
                /* Image::make($image->getRealPath())->resize(200, 200)->save($path);*/
				/*$request->file('photo')->move($destinationPath, $filename);*/
				 Image::make($image->getRealPath())->resize(400, 290)->save($path);
				$savefname=$filename;
		}
        else
		{
			/*$savefname=$currentphoto;*/
			$savefname="";
		}			
		
		
		$cat_id=$data['cat_id'];
		
		$status = 1;
		
		$subcat_type = "default";
		
		
		
		
		
		
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
			  
			  DB::update('update product_subcats set subcat_name="'.$pagename.'",post_slug="'.$pther.'",cat_id="'.$cat_id.'",subimage="'.$savefname.'",lang_code="'.$code.'",status="'.$status.'",subcat_type="'.$subcat_type.'" where subid = ?', [$subid]);
			}
			else
			{
			    $counts = DB::table('product_subcats')
		            ->where('lang_code', '=', $code)
					->where('subcat_type','=',$subcat_type)
					 ->where('parent', '=', $subid)
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
				     DB::insert('insert into product_subcats (subcat_name, 	post_slug, cat_id, subimage,  lang_code, token, parent, status, subcat_type) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$pagenamo,$pther, $cat_id, $savefname,$code,$token,$subid, $status, $subcat_type]);
				 }
				 else
				 {
				   DB::update('update product_subcats set subcat_name="'.$pagename.'",post_slug="'.$pther.'",cat_id="'.$cat_id.'",subimage="'.$savefname.'",status="'.$status.'",subcat_type="'.$subcat_type.'" where lang_code="'.$code.'" and parent = ?', [$subid]);
				 }
			
			}
		}
		
		
		
		
			return back()->with('success', 'Sub category has been updated');
        }
		
		
		
		
    }
}
