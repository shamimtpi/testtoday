<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;



use File;
use Image;
use URL;
use Mail;
use Carbon\Carbon;
use Session;
use Razorpay\Api\Api;
use Cookie;
use Purifier;


class DropboxController extends Controller
{
    
    public function uploadToDropbox(){
                return view('test');
    }
	
	public function uploadToDropboxFile(Request $request){
			$file_src=$request->file('upload_file'); //file src
		  $is_file_uploaded = Storage::disk('dropbox')->put('digitkart',$file_src);
		   
		  if($is_file_uploaded){
			return Redirect::back()->withErrors(['msg'=>'Succesfuly file uploaded to dropbox']);
			
			
			
		  } else {
			return Redirect::back()->withErrors(['msg'=>'file failed to uploaded on dropbox']);
		  } 
		}
	 
	
	
}
