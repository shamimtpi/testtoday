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


class EditblogController extends Controller
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
      $blog = DB::select('select * from posts where post_id = ?',[$id]);
      return view('admin.edit-blog',['blog'=>$blog,'language' => $language]);
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
            'post_title' => 'required|string|max:255'
            
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	 
    protected function blogdata(Request $request)
    {
        /*return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);*/
		
		
		
		 $this->validate($request, [

        		'post_title' => 'required'

        		
				
				

        	]);
         
		 $data = $request->all();
			
         $post_id=$data['post_id'];
		 $id=$data['post_id'];
        			
		$input['post_title'] = $request->input('post_title');
       $settings = DB::select('select * from settings where id = ?',[1]);
	      $imgsize = $settings[0]->image_size;
		  $imgtype = $settings[0]->image_type;	
		  $mp3size = $settings[0]->mp3_size;
       
		
		$rules = array(
		
		
		'post_title'=>'required',
		'photo' => 'max:'.$imgsize.'|mimes:'.$imgtype,
		'audio_file' => 'max:'.$mp3size.'|mimes:mpga',
		
		
		);

		
		
		
		$messages = array(
            
            
			
        );

		$validator = Validator::make($request->all(), $rules, $messages);
		
		

		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			/*return back()->withErrors($validator);*/
			return back()->with('error', 'Invalid file type OR File size is big');
		}
		else
		{  
		  

		
		$currentphoto=$data['currentphoto'];
		 $save_audio=$data['save_audio'];
		
		$image = DB::table('posts')->where('post_id', $post_id)->first();
		$orginalfile=$image->post_image;
		
		$audiofile=$image->post_audio;
		
		
		
       $path = base_path('images/media/blog/'.$currentphoto);
	   
	   $mp3path = base_path('images/media/blog/'.$save_audio);
		
		
		if($image->post_media_type=="image"){DB::update('update posts set post_audio="",post_video="" where post_id = ?', [$post_id]);}
		if($image->post_media_type=="mp3"){DB::update('update posts set post_image="",post_video="" where post_id = ?', [$post_id]);}
		if($image->post_media_type=="video"){ DB::update('update posts set post_image="",post_audio="" where post_id = ?', [$post_id]);}
		
		
		
		
		
		
		$image = $request->file('photo');
         if($image!="")
		 {
            
			 
	         File::delete($path);
	         File::delete($mp3path);
			$filename  = time() . '.' . $image->getClientOriginalExtension();
            $testimonialphoto="/media/blog/";
            $path = base_path('images'.$testimonialphoto.$filename);
			$destinationPath=base_path('images'.$testimonialphoto);
 
        
               Image::make($image->getRealPath())->resize(870, 490)->save($path);
				
				$namef=$filename;
				
		 }
		 else
		 {
			 $namef=$currentphoto;
		 }
		 
		 
		
		 $music_file = $request->file('audio_file'); 
		 if(isset($music_file))
		 {
		 File::delete($path);
	         File::delete($mp3path);
	     
		 $filename = time() . '.' . $music_file->getClientOriginalName();
		
		 $sermonmp3 = base_path('images/media/blog/'); 
		 $music_file->move($sermonmp3,$filename); 
		 $mp3name = $filename; 
		 
		 
		 }
		 else
		 {
		    $mp3name = $save_audio;
		 }
		 
		 $post_title=$data['post_title'];
		
		
		if(!empty($data['post_desc']))
		{
		$post_desc=$data['post_desc'];
		}
		else
		{
		  $post_desc = "";
		}
		
		
		$post_type = $data['post_type'];
		$media_type = $data['media_type'];
		
		
		
		if(!empty($data['slug']))
		{
		$slug = $data['slug'];
		}
		else
		{
		   $slug = "";
		}
		
		
		
		
		$save_video=$data['save_video'];
		if(!empty($data['video_url']))
		{
		   
		   
			 $videourl = $data['video_url'];
			
		}
		else
		{
		   $videourl = "";
		}
		$post_status = 1;
		
		 
		 if(!empty($data['tags']))
		{
		$post_tags=$data['tags'];
		}
		else
		{
		  $post_tags=$data['save_tags'];
		}
		 			
		
		$post_date = date("Y-m-d H:i:s");
		
		
		
		
		
		
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
		
		   $pagename=$post_title[$index];
		   $postdesc=$post_desc[$index];
		   	
		   	
		   if($code=="en")
			{
			  
			  
			  
			  
			  
			  DB::update('update posts set post_title="'.$pagename.'",post_slug="'.$pther.'",post_desc="'.htmlentities($postdesc).'",post_tags="'.$post_tags.'",post_type="'.$post_type.'",lang_code="'.$code.'",post_media_type="'.$media_type.'",post_image="'.$namef.'",post_audio="'.$mp3name.'",post_video="'.$videourl.'",post_date="'.$post_date.'" where post_id = ?', [$post_id]);
			  
			}
			else
			{
			    $counts = DB::table('posts')
		            ->where('lang_code', '=', $code)
					 ->where('parent', '=', $post_id)
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
						
						
						if(!empty($postdesc))
						{
						   $postdeco = $postdesc;
						}
						else
						{
						   $postdeco = "";
						}
						
						
						
						
						if(!empty($namef))
						{
						   $imgnamer = $namef;
						}
						else
						{
						   $imgnamer = "";
						}
						if(!empty($mp3name))
						{
						  $mpname = $mp3name;
						}
						else
						{
						  $mpname = "";
						}
				     
					 
			
			
			DB::insert('insert into post (post_title,post_slug,post_desc,post_tags,post_type,token,lang_code, parent,post_media_type,post_image,post_audio,post_video,post_date,post_status) values (?, ?, ?, ? ,?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$pagenamo,$pther,htmlentities($postdeco),$post_tags,$post_type,$token,$code,$post_id,$media_type,$imgnamer,$mpname,$videourl,$post_date,$post_status]);
			
			
				 
					 
				 }
				 else
				 {
				   
				   
				   
				
				 
				 
				 
				 DB::update('update posts set post_title="'.$pagename.'",post_slug="'.$pther.'",post_desc="'.htmlentities($postdesc).'",post_tags="'.$post_tags.'",post_type="'.$post_type.'",post_media_type="'.$media_type.'",post_image="'.$namef.'",post_audio="'.$mp3name.'",post_video="'.$videourl.'",post_date="'.$post_date.'" where lang_code="'.$code.'" and parent = ?', [$post_id]);
				   
				   
				 }
			
			}
		}
		
		
		
		
		
		
		
		/*DB::update('update posts set post_title="'.$post_title.'",post_slug="'.$post_slug.'",post_desc="'.$post_desc.'",post_tags="'.$post_tags.'",post_type="'.$post_type.'",post_media_type="'.$media_type.'",post_image="'.$namef.'",post_audio="'.$mp3name.'",post_video="'.$videourl.'",post_date="'.$post_date.'" where post_id = ?', [$post_id]);*/
		
			return back()->with('success', 'Post has been updated');
        }
		
		
		
		
    }
}
