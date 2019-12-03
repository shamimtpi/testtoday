<?php
use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");
$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
$default = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }	


if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $protocol = 'https://';
}
else {
  $protocol = 'http://';
}		
?>
<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
	<title><?php echo translate( 25, $lang);?> - <?php echo translate( 466, $lang);?></title>




</head>
<body>

    

   
    @include('header')

   
    <main class="checkout-area main-content">
        <div class="container">
          <div class="page-content cpshadow">
        <div class="clearfix height20"></div>
        <div class="row">
                     <div class="col-md-12 col-sm-12">
                    @if(Session::has('success'))

	    <p class="alert alert-success">

	      {{ Session::get('success') }}

	    </p>

	@endif


	
	
 	@if(Session::has('error'))

	    <p class="alert alert-danger">

	      {{ Session::get('error') }}

	    </p>

	@endif
    
   
    
    </div>
	
	
	
	<div>
        @if (count($errors) > 0)
         
        <div class="alert alert-danger">
         
        <ul>
         
        @foreach ($errors->all() as $error)
         
        <li>{{ $error }}</li>
         
        @endforeach
         
        </ul>
         
        </div>
         
        @endif
        </div>
	
    </div>
        
         
         
         <form  role="form" method="POST" action="{{ route('edit-item') }}" id="formID" enctype="multipart/form-data">
         {{ csrf_field() }}
         
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="billing-details">
                    
                    
          <div class="row">
               <div class="col-sm-12">
                   <div class="form-group">
		   <label><?php echo translate( 88, $lang);?> <span class="required">*</span></label>
		    <input type="text" id="item_title" placeholder="" value="{!! $edit[0]->item_title !!}" name="item_title[]" class="validate[required]">
            
		  </div>
		
	      </div>
            </div>
    
    
    <div class="row">
         <div class="col-sm-12">
           <div class="form-group">
		   <label><?php echo translate( 1218, $lang);?> <span class="required">*</span></label>
		    
            <textarea placeholder="" class="validate[required] form-control" name="item_short_desc[]" style="width:100% !important; height:100px;">{!! $edit[0]->item_short_desc !!}</textarea>
		  </div>
		
	     </div>
    </div>
    
    
    
    <div class="row">
        <div class="col-sm-12">
             <div class="form-group">
		    <label><?php echo translate( 91, $lang);?> <span class="required">*</span></label>
            <textarea id="id_cazary_full" placeholder="" class="validate[required] form-control" name="item_desc[]" style="width:100% !important; height:300px;">{!! $edit[0]->item_desc !!}</textarea>
		    </div>
	     </div>    
    </div>                           
        <input type="hidden" name="code[]" value="en">
                    
                       
                            
                     <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 946, $lang);?> <span class="required">*</span></label>
                                        <input type="text" id="item_slug" placeholder="" name="item_slug" value="<?php echo $edit[0]->item_slug;?>" class="validate[required]">
                                    </div>
                                </div>
                                
                                
                            </div>       
                            
                            <input type="hidden" name="item_script_type" value="{{$edit[0]->item_script_type}}">
                            
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 94, $lang);?> <span class="required">*</span></label>
                                        
                                       <select name="item_type" id="item_type" class="validate[required]">
                                        <option value=""><?php echo translate( 97, $lang);?></option>
                                        <option value="yes" <?php if($edit[0]->item_type=="yes"){?> selected <?php } ?>><?php echo translate( 100, $lang);?></option>
                                        <option value="no" <?php if($edit[0]->item_type=="no"){?> selected <?php } ?>><?php echo translate( 103, $lang);?></option>
                                        </select> 
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label><?php echo translate( 106, $lang);?> <span class="required">*</span></label>
                                        <input type="text" id="regular_price_six_month" placeholder="" name="regular_price_six_month" value="<?php if(!empty($viewcount)){ echo $edit[0]->regular_price_six_month; } ?>" class="validate[required,custom[integer],min[1]]">
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label><?php echo translate( 109, $lang);?></label>
                                        <input type="text" id="regular_price_one_year" placeholder="" name="regular_price_one_year" value="<?php if(!empty($viewcount)){ if(!empty($edit[0]->regular_price_one_year)){ echo $edit[0]->regular_price_one_year; } } ?>" class="validate[custom[integer],min[1]]">
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                            
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label><?php echo translate( 112, $lang);?></label>
                                        <input type="text" id="extended_price_six_month" placeholder="" name="extended_price_six_month" value="<?php if(!empty($viewcount)){ if(!empty($edit[0]->extended_price_six_month)){ echo $edit[0]->extended_price_six_month; } } ?>" class="validate[custom[integer],min[1]]">
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label><?php echo translate( 115, $lang);?></label>
                                        <input type="text" id="extended_price_one_year" placeholder="" name="extended_price_one_year" value="<?php if(!empty($viewcount)){ if(!empty($edit[0]->extended_price_one_year)){ echo $edit[0]->extended_price_one_year;  } } ?>" class="validate[custom[integer],min[1]]">
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 118, $lang);?> <span class="required">*</span></label>
                                        <select name="high_resolution" class="validate[required]">
                                        <option value="">Select</option>
                                        <option value="Yes" <?php if(!empty($viewcount)){ if($edit[0]->high_resolution=="Yes"){?> selected <?php } } ?>>Yes</option>
                                        <option value="No" <?php if(!empty($viewcount)){ if($edit[0]->high_resolution=="No"){?> selected <?php } } ?>>No</option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                            
                            
                            
                            <div  id="grapics_only1" <?php if(!empty($viewcount)){  if(!empty($edit[0]->item_script_type=="graphics")){?> style="display:block;" <?php } else {?> style="display:none;" <?php } } ?>>
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 1191, $lang);?> <span class="required">*</span></label>
                                        <select name="item_layered" class="validate[required]">
                                        <option value=""><?php echo translate( 97, $lang);?></option>
                                        <option value="Yes" <?php if($edit[0]->item_layered=="Yes"){?> selected <?php } ?>><?php echo translate( 100, $lang);?></option>
                                        <option value="No" <?php if($edit[0]->item_layered=="No"){?> selected <?php } ?>><?php echo translate( 103, $lang);?></option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 1194, $lang);?> <span class="required">*</span></label>
                            <select multiple="multiple" name="graphics_files[]" id="graphics_files" class="validate[required]">
                            <?php foreach($graphics as $graphic){?>
                             <?php 
				  if(!empty($viewcount)){
				  $sel=explode(",",$edit[0]->graphics_files);
				  }
				   ?>
                            <option value="<?php echo $graphic;?>" <?php if(!empty($viewcount)){ if(in_array($graphic,$sel)){?> selected <?php } } ?>><?php echo $graphic;?></option>
                            <?php } ?>
                            
                            
                            </select>
                           </div>
                                </div>
                                
                            </div>
                            
                            
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 1197, $lang);?> <span class="required">*</span></label>
                                        <select name="adobe_cs_version" class="validate[required]">
                                        <option value=""><?php echo translate( 97, $lang);?></option>
                                        <?php foreach($adobe_cs as $adobe){?>
                                        <option value="<?php echo $adobe;?>" <?php if(!empty($viewcount)){ if($edit[0]->adobe_cs_version==$adobe){?> selected <?php } } ?>><?php echo $adobe;?></option>
                                       <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            
                             <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 1200, $lang);?></label>
                                        <input type="text" id="pixel_dimensions" placeholder="" value="<?php if(!empty($viewcount)){ echo $edit[0]->pixel_dimensions; } ?>" name="pixel_dimensions" class="validate[required]">
                                        <span class="fontsize12"><?php echo translate( 1209, $lang);?></span>
                                    </div>
                                </div>
                             </div>  
                             
                             
                             
                             <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 1203, $lang);?></label>
                                        <input type="text" id="print_dimensions" placeholder="" value="<?php if(!empty($viewcount)){ echo $edit[0]->print_dimensions; } ?>" name="print_dimensions" class="validate[required]">
                                        <span class="fontsize12"><?php echo translate( 1206, $lang);?></span>
                                    </div>
                                </div>
                             </div> 
                            
                            
                            
                            
                           </div>
                            
                            
                            
                            <div  id="code_only1" <?php if(!empty($viewcount)){  if(!empty($edit[0]->item_script_type=="code")){?> style="display:block;" <?php } else {?> style="display:none;" <?php } } ?>>
                            
                             <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 121, $lang);?> <span class="required">*</span></label>
                            <select multiple="multiple" name="compatible_browser[]" id="compatible_browser" class="validate[required]">
                            <?php foreach($browser as $browse){?>
                            
                             <?php 
				  if(!empty($viewcount)){
				  $sel=explode(",",$edit[0]->compatible_browser);
				  }
				   ?>
                            
                            <option value="<?php echo $browse;?>" <?php if(!empty($viewcount)){ if(in_array($browse,$sel)){?> selected <?php } } ?>><?php echo $browse;?></option>
                            <?php } ?>
                            </select>
                            
                           </div>
                                </div>
                                
                            </div>
                            
                            
                          <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 157, $lang);?> <span class="required">*</span></label>
                                        <input type="text" id="file_included" placeholder="" name="file_included" class="validate[required]" value="<?php if(!empty($viewcount)){ echo $edit[0]->file_included; } ?>">
                                        <span class="fontsize12"><?php echo translate( 160, $lang);?></span>
                                    </div>
                                </div>
                                
                            </div>  
                            
                            
                            
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <?php if($protocol == "http://"){ $linker = "https://"; } else { $linker = "http://"; } ?>
                                    
                                    <label><?php echo translate( 163, $lang);?></label>
                                    
                                        <input type="text" id="demo_url" placeholder="" name="demo_url" value="<?php if(!empty($viewcount)){ echo $edit[0]->demo_url; } ?>" class="validate[required,custom[url]] text-input">
                                        
                                        <span style="color:#FF0033; font-size:12px;">( <?php echo translate( 1090, $lang);?> :  <?php echo $protocol;?>www.yourwebsite.com ) 
                                        <b style="color:#009900;"><?php echo translate( 1128, $lang);?> - <?php echo $linker;?></b>
                                        </span>
                                        
                                    </div>
                                </div>
                                
                            </div>  
                            
                            </div>
                            
                            
                              <input type="hidden" name="item_token" value="<?php if(!empty($viewcount)){ echo $edit[0]->item_token; } ?>">
                            <input type="hidden" name="item_id" value="<?php if(!empty($viewcount)){ echo $edit[0]->item_id; } ?>">
                            
                             <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 166, $lang);?> <span class="required">*</span></label>
                                        
                                       <select name="support_item" class="validate[required]">
                                        <option value=""><?php echo translate( 97, $lang);?></option>
                                        <option value="Yes" <?php if(!empty($viewcount)){ if($edit[0]->support_item=="Yes"){?> selected <?php } } ?>><?php echo translate( 100, $lang);?></option>
                                        <option value="No" <?php if(!empty($viewcount)){ if($edit[0]->support_item=="No"){?> selected <?php } } ?>><?php echo translate( 103, $lang);?></option>
                                        </select> 
                                    </div>
                                </div>
                                
                            </div>
                            
                             
                            
                            
                            
                       

                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="billing-details">
                        
                        
                       
                        
                        
                        
                        <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 169, $lang);?> <span class="required">*</span></label>
                                        
                                       <select name="future_update" class="validate[required]">
                                        <option value=""><?php echo translate( 97, $lang);?></option>
                                        <option value="Yes" <?php if(!empty($viewcount)){ if($edit[0]->future_update=="Yes"){?> selected <?php } } ?>><?php echo translate( 100, $lang);?></option>
                                        <option value="No" <?php if(!empty($viewcount)){ if($edit[0]->future_update=="No"){?> selected <?php } } ?>><?php echo translate( 103, $lang);?></option>
                                        </select> 
                                    </div>
                                </div>
                                
                            </div>
                       
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 172, $lang);?></label>
                                        <input type="number" id="unlimited_download" placeholder="" name="unlimited_download" value="<?php if(!empty($viewcount)){ echo $edit[0]->unlimited_download; } ?>">
                                        <span class="fontsize12"><?php echo translate( 175, $lang);?></span>
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 178, $lang);?> <span class="required">*</span></label>
                            <select multiple="multiple" name="item_category[]" id="item_category" class="validate[required]">
                            <?php 
							if(!empty($category_count))
							{
							$category = DB::table('product_categories')
										->where('delete_status','=','')
										->where('cat_type','=','default')
										->where('lang_code','=',$lang)
										->where('status','=',1)
										->orderBy('cat_name', 'asc')->get();
							foreach($category as $view){
							if($lang == "en")
						  {
						    $cat_id = $view->id; 
						  }
						  else
						  {
						     $cat_id = $view->parent;
						  }
							?>
                            <?php 
				  if(!empty($viewcount)){
				  $sel=explode(",",$edit[0]->category);
				  }
				   ?>
                            
                            <option value="<?php echo $cat_id;?>-cat" class="bold" <?php if(!empty($viewcount)){ if(in_array($cat_id.'-cat',$sel)){?> selected <?php } } ?>><?php echo $view->cat_name;?></option>
                            <?php 
						  $subcount = DB::table('product_subcats')
							->where('delete_status','=','')
							->where('status','=',1)
							->where('cat_id','=',$cat_id)
							->where('lang_code','=',$lang)
							->where('subcat_type','=','default')
							->orderBy('subcat_name', 'asc')->count();
							if(!empty($subcount)){
							$subcategory = DB::table('product_subcats')
							->where('delete_status','=','')
							->where('status','=',1)
							->where('lang_code','=',$lang)
							->where('cat_id','=',$cat_id)
							->where('subcat_type','=','default')
							->orderBy('subcat_name', 'asc')->get();
							foreach($subcategory as $subview){
							if($lang == "en")
						  {
						    $subcat_id = $subview->subid; 
						  }
						  else
						  {
						     $subcat_id = $subview->parent;
						  }	
					      ?>
                          
                           <?php 
				  if(!empty($viewcount)){
				  $ssel=explode(",",$edit[0]->category);
				  }
				   ?>
                            <option value="<?php echo $subcat_id;?>-subcat" <?php if(!empty($viewcount)){ if(in_array($subcat_id.'-subcat',$ssel)){?> selected <?php } } ?>> - <?php echo $subview->subcat_name;?></option>
                            
                            
                            <?php } } } } ?>
                            </select>
                           </div>
                                </div>
                                
                            </div>
                            
                            
                            
                            
                            
                            
                            <div class="row" id="code_only2" <?php if(!empty($viewcount)){  if(!empty($edit[0]->item_script_type=="code")){?> style="display:block;" <?php } else {?> style="display:none;" <?php } } ?>>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 181, $lang);?></label>
                            <select multiple="multiple" name="item_framework[]" id="item_framework" class="">
                            <?php 
							if(!empty($framework_count))
							{
							$category = DB::table('product_categories')
										->where('delete_status','=','')
										->where('lang_code','=',$lang)
										->where('status','=',1)
										->where('cat_type','=','framework')
										->orderBy('cat_name', 'asc')->get();
							foreach($category as $view){
							if($lang == "en")
						  {
						    $cat_id = $view->id; 
						  }
						  else
						  {
						     $cat_id = $view->parent;
						  }
							?>
                            <?php 
				  if(!empty($viewcount)){
				  $sel=explode(",",$edit[0]->framework_category);
				  }
				   ?>
                            
                            <option value="<?php echo $cat_id;?>-cat" class="bold" <?php if(!empty($viewcount)){ if(in_array($cat_id.'-cat',$sel)){?> selected <?php } } ?>><?php echo $view->cat_name;?></option>
                            <?php 
						  $subcount = DB::table('product_subcats')
							->where('delete_status','=','')
							->where('status','=',1)
							->where('lang_code','=',$lang)
							->where('cat_id','=',$cat_id)
							->where('subcat_type','=','framework')
							->orderBy('subcat_name', 'asc')->count();
							if(!empty($subcount)){
							$subcategory = DB::table('product_subcats')
							->where('delete_status','=','')
							->where('status','=',1)
							->where('lang_code','=',$lang)
							->where('cat_id','=',$cat_id)
							->where('subcat_type','=','framework')
							->orderBy('subcat_name', 'asc')->get();
							foreach($subcategory as $subview){
							
							if($lang == "en")
						  {
						    $subcat_id = $subview->subid; 
						  }
						  else
						  {
						     $subcat_id = $subview->parent;
						  }	
					      ?>
                          
                           <?php 
				  if(!empty($viewcount)){
				  $ssel=explode(",",$edit[0]->framework_category);
				  }
				   ?>
                            <option value="<?php echo $subcat_id;?>-subcat" <?php if(!empty($viewcount)){ if(in_array($subcat_id.'-subcat',$ssel)){?> selected <?php } } ?>> - <?php echo $subview->subcat_name;?></option>
                            
                            
                            <?php } } } } ?>
                            </select>
                           </div>
                                </div>
                                
                            </div>
                            
                            
                            
                            
                            
                            
                            
                           <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 184, $lang);?> <span class="required">*</span></label>
                                        <input type="file" id="item_thumbnail" placeholder="" name="item_thumbnail" class="<?php if(!empty($viewcount)){ if(empty($edit[0]->item_thumbnail)){?>validate[required]<?php } } ?>">
                                        (200 X 200px)<br/>
                                        <?php if(!empty($viewcount)){ if(!empty($edit[0]->item_thumbnail)){?>
                                        <img src="<?php echo $url;?>/local/images/media/thumbnail/<?php echo $edit[0]->item_thumbnail;?>" alt="" style="max-width:100px;">
                                       
                                        <?php } } ?>
                                        @if ($errors->has('item_thumbnail'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('item_thumbnail') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                                
                            </div> 
                            <input type="hidden" name="current_thumb" value="<?php if(!empty($viewcount)){ if(!empty($edit[0]->item_thumbnail)){?><?php echo $edit[0]->item_thumbnail;?><?php } } ?>">
                            
                            
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label>	<?php echo translate( 187, $lang);?> <span class="required">*</span></label>
                                        <input type="file" id="preview_image" placeholder="" name="preview_image" class="<?php if(!empty($viewcount)){ if(empty($edit[0]->preview_image)){?>validate[required]<?php } } ?>">
                                        (600 X 450px)<br/>
                                        <?php if(!empty($viewcount)){ if(!empty($edit[0]->preview_image)){?>
                                        <img src="<?php echo $url;?>/local/images/media/preview/<?php echo $edit[0]->preview_image;?>" alt="" style="max-width:100px;">
                                       
                                        <?php } } ?>
                                        
                                        @if ($errors->has('preview_image'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('preview_image') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                                
                            </div>
                            
                            <input type="hidden" name="current_preview" value="<?php if(!empty($viewcount)){ if(!empty($edit[0]->preview_image)){?><?php echo $edit[0]->preview_image;?><?php } } ?>">
                            
                            
                            
                            
                            
                            <?php
						  $viewimg_counter = DB::table('product_images')
		                              ->where('item_token', '=' , $edit[0]->item_token)
				                      ->count();
									  
						  ?>
                            
                            <div class="row">
                            <div class="col-sm-12">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputTitle"><?php echo translate( 190, $lang);?></label>
		    <input type="file" placeholder="" name="image[]" class="" accept="image/*" multiple>
						  @if ($errors->has('image'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                                <div class="clearfix"></div>
                      <?php if(!empty($viewcount)){?>
                      
                      <?php
					  $viewimg_count = DB::table('product_images')
		                              ->where('item_token', '=' , $edit[0]->item_token)
				                      ->count();
	
	                   
	
					  if(!empty($viewimg_count)){
					  $viewimg_get = DB::table('product_images')
		                              ->where('item_token', '=' , $edit[0]->item_token)
				                      ->get();
					  foreach($viewimg_get as $gallery){
					  
					  if($site_file_upload_by == "s3_server")
					  {
					  $imageurls = Storage::disk('s3')->url($gallery->image);
					  ?>
                      <div class="col-md-3" style="margin-bottom:15px;">
                      <?php if(!empty($gallery->image)){?>
                      <img src="<?php echo $imageurls;?>" width="80" height="80" border="0" alt="">
                      <a href="<?php echo $url;?>/edit-item/delete/<?php echo $gallery->item_img_id;?>/<?php echo base64_encode($gallery->image);?>" onClick="return confirm('Are you sure you want to delete');"><img src="<?php echo $url;?>/local/images/delete.png" width="24" border="0" alt=""></a>
                      <?php } ?>
                      </div>
                      <?php
					  }
					  else
					  {
					  ?>
                      
                      <div class="col-md-3" style="margin-bottom:15px;">
                      <?php if(!empty($gallery->image)){?>
                      <img src="<?php echo $url;?>/local/images/media/screenshots/<?php echo $gallery->image;?>" width="80" height="80" border="0" alt="">
                      <a href="<?php echo $url;?>/edit-item/delete/<?php echo $gallery->item_img_id;?>/<?php echo base64_encode($gallery->image);?>" onClick="return confirm('Are you sure you want to delete');"><img src="<?php echo $url;?>/local/images/delete.png" width="24" border="0" alt=""></a>
                      </div>
                      
                      <?php } } } } } ?>
                      <div class="clearfix"></div>
                      
            
		  </div>
		
	</div>
                            
        </div>                    
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 193, $lang);?> <span class="required">*</span></label>
                                        <input type="file" id="main_file" placeholder="" name="main_file" class="<?php if(!empty($viewcount)){ if(empty($edit[0]->main_file)){?>validate[required]<?php } } ?>">
                                        <span class="fontsize12">( ZIP - format only )</span>
                                        <?php if(!empty($viewcount)){ if(!empty($edit[0]->main_file)){?>
                                        <?php if($site_file_upload_by == "s3_server"){ 
										$imageurls = Storage::disk('s3')->url($edit[0]->main_file);
										?>
                                                                               
                                        <a href="<?php echo $imageurls;?>" download> <?php echo $edit[0]->main_file;?>
                                        </a>
                                        <?php } else { ?>
                                        <a href="<?php echo $url;?>/local/images/media/itemfile/<?php echo $edit[0]->main_file;?>" download> <?php echo $edit[0]->main_file;?>
                                        </a>
                                        <?php } ?>
                                        <?php } } ?>
                                        @if ($errors->has('main_file'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('main_file') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                            
                            
                            <div class="row" id="code_only3" <?php if(!empty($viewcount)){  if(!empty($edit[0]->item_script_type=="code")){?> style="display:block;" <?php } else {?> style="display:none;" <?php } } ?>>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 199, $lang);?></label>
                                        <input type="file" id="video_file" placeholder="" name="video_file" class="">
                                        <span class="fontsize12"><?php echo translate( 202, $lang);?></span>
                                        <?php if(!empty($video_status)){?>
                                        <?php if($site_file_upload_by == "s3_server"){ 
										$videourls = Storage::disk('s3')->url($video_status);
										?>
                                     <a href="<?php echo $videourls;?>" download> <?php echo $video_status;?>
                                        </a>
                                        <?php } else { ?>
                                        
                                        <a href="<?php echo $url;?>/local/images/media/video/<?php echo $video_status;?>" download> <?php echo $video_status;?>
                                        </a>
                                        <?php } ?>    
                                        <input type="hidden" name="current_video" value="<?php echo $video_status;?>">
                                        <?php } ?>
                                        @if ($errors->has('video_file'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('video_file') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                            
                            
                            
                            <input type="hidden" name="current_file" value="<?php if(!empty($viewcount)){ if(!empty($edit[0]->main_file)){?><?php echo $edit[0]->main_file;?><?php } } ?>">
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 205, $lang);?></label>
                                        <textarea id="item_tags" placeholder="" rows="5" name="item_tags"><?php if(!empty($viewcount)){ echo $edit[0]->item_tags; } ?></textarea>
                                        <span class="fontsize12"><?php echo translate( 208, $lang);?></span>
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                            
                       

                    </div>
                </div>
                
                
            </div>
            
            <div class="row">
                                <div class="col-md-12">
                                <a href="<?php echo $url;?>/my-items" class="resetbtn"><?php echo translate( 211, $lang);?></a>
                                    <button class="custom-btn"><?php echo translate( 463, $lang);?></button>
                                    
                                </div>
                            </div>
          </form>


        </div>
        </div>
    </main>

	
    
      @include('footer')
</body>
</html>