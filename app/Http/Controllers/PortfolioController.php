<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use File;
use Image;
use URL;
use Mail;
use Carbon\Carbon;
use Cookie;

class PortfolioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
	
	public function avigher_portfolio($id)
    {
	
	
	$query = DB::table('portfolio')
		       ->where('post_slug', '=', $id)
			   ->get();
		$query_cnt = DB::table('portfolio')
		       ->where('post_slug', '=', $id)
			   ->count();
			   
			   
	$previous =  DB::table('portfolio')
		        
				 
				 ->where('title', '<', $query[0]->title)
	             ->max('title');
				 
				 
	$previous_link = DB::table('portfolio')
		         
				  ->where('title', '=', $previous)
				  ->get();
				  			 
				 
	$next =  DB::table('portfolio')
		         
				 ->where('title', '>', $query[0]->title)
	             ->min('title');	
				 
				 
	$next_link = DB::table('portfolio')
		         
				  ->where('title', '=', $next)
				  ->get();			 		   
			   
	
	
	 $data = array('query' => $query, 'query_cnt' => $query_cnt, 'previous' => $previous, 'previous_link' => $previous_link, 'next_link' => $next_link, 'next' => $next);
	 return view('portfolio')->with($data);
	
	
	}
	
	
	 
	
	
}
