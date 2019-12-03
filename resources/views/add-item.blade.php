
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
    <title><?php echo translate( 25, $lang);?> - <?php echo translate( 85, $lang);?></title>

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
        
         

<!-- Start tabs area --->

  <div class="nav nav-tabs justify-content-center" role="tablist">
    <a class="nav-item nav-link active" id="nav-itemcode-tab" data-toggle="tab" href="#nav-itemcode" role="tab" aria-controls="nav-itemcode" aria-selected="true">CODE</a>
    <a class="nav-item nav-link" id="nav-itemgraphics-tab" data-toggle="tab" href="#nav-itemgraphics" role="tab" aria-controls="nav-itemgraphics" aria-selected="false">GRAPHICS</a>
  </div>

<!-- start tab content -->
<div class="tab-content">
    
       <!-- start code tab -->
  <div class="tab-pane fade show active" id="nav-itemcode" role="tabpanel" aria-labelledby="nav-itemcode-tab">
         <form  role="form" method="POST" action="{{ route('add-item') }}" id="formID" enctype="multipart/form-data">
         {{ csrf_field() }}
         
            <div class="row">
                 <!--end right side form -->
                <div class="col-md-6 col-sm-12">
                    <div class="billing-details">
                     <div class="height20"></div>

                     <!-- item title -->
                <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                       <label><?php echo translate( 88, $lang);?> <span class="required">*</span></label>
                        <input type="text" id="item_title[]" placeholder="" name="item_title[]" class="validate[required]" value="{{old('item_title[]')}}" required="required">
                      </div>
                     </div>
                </div>
                
                    <!-- item short des-->
                
                 <div class="row">
                    <div class="col-sm-12">
                       <div class="form-group">
                       <label><?php echo translate( 1218, $lang);?> <span class="required">*</span></label>
                        <textarea rows="5" class="form-control" name="item_short_desc[]">{{old('item_short_desc[]')}}</textarea>
                      </div>
                    </div>
                </div>
                
    
                    <!-- item full des -->
                <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                        <label><?php echo translate( 91, $lang);?> <span class="required">*</span></label>
                        <textarea id="id_cazary_full" placeholder="" class="validate[required] form-control" name="item_desc[]" style="width:100% !important; height:300px;">{{old('item_desc[]')}}</textarea>
                      </div>
                    </div>
                </div>
                                                    
                 <input type="hidden" name="code[]" value="en">
           
                       
                        <!-- item slug -->
                       <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                <label><?php echo translate( 946, $lang);?> <span class="required">*</span></label>
                                    <input type="text" id="item_slug" placeholder="" name="item_slug" value="{{old('item_slug')}}" required="required" class="validate[required]">
                                </div>
                            </div>
                         </div>
                       
                            <!-- script type -->
                           <input type="hidden" value="code" name="item_script_type">
                       
                           
                            
                            <!-- Download item free or not -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 94, $lang);?> <span class="required">*</span></label>
                                       <select name="item_type" id="item_type" class="validate[required]">
                                        <option value=""><?php echo translate( 97, $lang);?></option>
                                        <option value="yes"><?php echo translate( 100, $lang);?></option>
                                        <option value="no"><?php echo translate( 103, $lang);?></option>
                                        </select> 
                                    </div>
                                </div>
                            </div>
                            
                            
                            <!-- Regular Price for 6-->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label><?php echo translate( 106, $lang);?> <span class="required">*</span></label>
                                        <input type="text" id="regular_price_six_month" placeholder="" name="regular_price_six_month" class="validate[required,custom[integer],min[1]]" value="{{old('regular_price_six_month')}}">
                                    </div>
                                </div>

                                <!-- Regular Price for 12 -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label><?php echo translate( 109, $lang);?></label>
                                        <input type="text" id="regular_price_one_year" placeholder="" name="regular_price_one_year" class="validate[custom[integer],min[1]]" value="{{old('regular_price_one_year')}}">
                                    </div>
                                </div>
                            </div>
                            
                            
                            <!-- Extended Price (Six Month) -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label><?php echo translate( 112, $lang);?></label>
                                        <input type="text" id="extended_price_six_month" placeholder="" name="extended_price_six_month" class="validate[custom[integer],min[1]]" value="{{old('extended_price_six_month')}}">
                                    </div>
                                </div>

                                 <!-- Extended Price (One Year) -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label><?php echo translate( 115, $lang);?></label>
                                        <input type="text" id="extended_price_one_year" placeholder="" name="extended_price_one_year" class="validate[custom[integer],min[1]]" value="{{old('extended_price_one_year')}}">
                                    </div>
                                </div>
                            </div>
                            
                           
                           
                            <!-- high resulation -->
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 118, $lang);?> <span class="required">*</span></label>
                                        <select name="high_resolution" class="validate[required]">
                                        <option value=""><?php echo translate( 97, $lang);?></option>
                                        <option value="Yes"><?php echo translate( 100, $lang);?></option>
                                        <option value="No"><?php echo translate( 103, $lang);?></option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            
                           
                            <!-- browser compability -->
                             <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 121, $lang);?> <span class="required">*</span></label>
                            <select multiple="multiple" name="compatible_browser[]" id="compatible_browser" class="validate[required]">
                            <?php foreach($browser as $browse){?>
                            <option value="<?php echo $browse;?>"><?php echo $browse;?></option>
                            <?php } ?>
                            
                            
                            </select>
                           </div>
                                </div>
                                
                            </div>
                            
                            
                          <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 157, $lang);?> <span class="required">*</span></label>
                                        <input type="text" id="file_included" placeholder="" name="file_included" class="validate[required]" value="{{old('file_included')}}">
                                        <span class="fontsize12"><?php echo translate( 160, $lang);?></span>
                                    </div>
                                </div>
                                
                            </div>  
                            
                            
                            
                              <input type="hidden" name="item_token" value="<?php echo uniqid();?>">
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 166, $lang);?> <span class="required">*</span></label>
                                        
                                       <select name="support_item" class="validate[required]">
                                        <option value=""><?php echo translate( 97, $lang);?></option>
                                        <option value="Yes"><?php echo translate( 100, $lang);?></option>
                                        <option value="No"><?php echo translate( 103, $lang);?></option>
                                        </select> 
                                    </div>
                                </div>
                                
                            </div>
                    </div>
                </div>
                 <!-- left side form -->
                <div class="col-md-6 col-sm-12">
                    <div class="billing-details">
                            <div class="height20"></div>
                              <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 169, $lang);?> <span class="required">*</span></label>
                                        
                                       <select name="future_update" class="validate[required]">
                                        <option value=""><?php echo translate( 97, $lang);?></option>
                                        <option value="Yes"><?php echo translate( 100, $lang);?></option>
                                        <option value="No"><?php echo translate( 103, $lang);?></option>
                                        </select> 
                                    </div>
                                </div>
                                
                            </div>
                       
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 172, $lang);?></label>
                                        <input type="number" id="unlimited_download" placeholder="" name="unlimited_download" value="{{old('unlimited_download')}}">
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
                            <option value="<?php echo $cat_id;?>-cat" class="bold"><?php echo $view->cat_name;?></option>
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
                            ->where('cat_id','=',$cat_id)
                            ->where('lang_code','=',$lang)
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
                            <option value="<?php echo $subcat_id;?>-subcat"> - <?php echo $subview->subcat_name;?></option>
                            
                            
                            <?php } } } } ?>
                            </select>
                           </div>
                                </div>
                                
                            </div>
                            
                            
                            
                            
                            <div class="row" id="code_only2">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 181, $lang);?> </label>
                            <select multiple="multiple" name="item_framework[]" id="item_framework" class="">
                            <?php 
                            if(!empty($framework_count))
                            {
                            $category = DB::table('product_categories')
                                        ->where('delete_status','=','')
                                        ->where('status','=',1)
                                        ->where('lang_code','=',$lang)
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
                            <option value="<?php echo $cat_id;?>-cat" class="bold"><?php echo $view->cat_name;?></option>
                            <?php 
                          $subcount = DB::table('product_subcats')
                            ->where('delete_status','=','')
                            ->where('status','=',1)
                            ->where('cat_id','=',$cat_id)
                            ->where('lang_code','=',$lang)
                            ->where('subcat_type','=','framework')
                            ->orderBy('subcat_name', 'asc')->count();
                            if(!empty($subcount)){
                            $subcategory = DB::table('product_subcats')
                            ->where('delete_status','=','')
                            ->where('status','=',1)
                            ->where('cat_id','=',$cat_id)
                            ->where('lang_code','=',$lang)
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
                            <option value="<?php echo $subcat_id;?>-subcat"> - <?php echo $subview->subcat_name;?></option>
                            
                            
                            <?php } } } } ?>
                            </select>
                           </div>
                                </div>
                                
                            </div>
                            
                            
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 184, $lang);?> <span class="required">*</span></label>
                                        <input type="file" id="item_thumbnail" placeholder="" name="item_thumbnail" required="required" class="validate[required]" value="{{old('item_thumbnail')}}">
                                        (80px X 80px)
                                        @if ($errors->has('item_thumbnail'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('item_thumbnail') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 187, $lang);?> <span class="required">*</span></label>
                                        <input type="file" id="preview_image" required="required" name="preview_image" class="validate[required]" value="{{old('preview_image')}}">
                                        (600 X 450px)
                                        @if ($errors->has('preview_image'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('preview_image') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                   <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label><?php echo translate( 190, $lang);?></label>
                                <input type="file" placeholder="" name="image[]" class="" accept="image/*" multiple>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                            
                            
                            
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 193, $lang);?> <span class="required">*</span></label>
                                        <input type="file" id="main_file" required="required" name="main_file" class="validate[required]">
                                        <span class="fontsize12"><?php echo translate( 196, $lang);?></span>
                                        @if ($errors->has('main_file'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('main_file') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                                
                            </div>

                            <!-- demo url-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <?php if($protocol == "http://"){ $linker = "https://"; } else { $linker = "http://"; } ?>
                                    <label><?php echo translate( 163, $lang);?></label>
                                        <input type="text" id="demo_url" placeholder="" name="demo_url" class="validate[required,custom[url]] text-input">
                                        <span style="color:#FF0033; font-size:12px;">( <?php echo translate( 1090, $lang);?> :  <?php echo $protocol;?>www.yourwebsite.com )  <b style="color:#009900;"><?php echo translate( 1128, $lang);?> - <?php echo $linker;?></b></span>
                                    </div>
                                </div>
                                
                            </div> 
                            
                            
                            <!-- upload video file -->
                            
                            <div class="row" id="code_only3">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 199, $lang);?></label>
                                        <input type="file" id="video_file" placeholder="" name="video_file" class="">
                                        <span class="fontsize12"><?php echo translate( 202, $lang);?></span>
                                        @if ($errors->has('video_file'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('video_file') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                            
                            <!-- item tags-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 205, $lang);?></label>
                                        <textarea id="item_tags" placeholder="" rows="5" name="item_tags">{{old('item_tags')}}</textarea>
                                        <span class="fontsize12"><?php echo translate( 208, $lang);?></span>
                                    </div>
                                </div>
                                
                            </div>
                            
                           

                    </div>
                </div>
                
                <!--end right side form -->
                
            </div>
                <div class="height20"></div>
              <div class="row justify-content-center text-center">
                    <div class="col-md-4">
                    <a href="<?php echo $url;?>/my-items" class="resetbtn"><?php echo translate( 211, $lang);?></a>
                        <button class="custom-btn"><?php echo translate( 214, $lang);?></button>
                        
                    </div>
                </div>

          </form>  
           </div><!-- End code form -->

            <!-- start graphic area -->
           <div class="tab-pane fade" id="nav-itemgraphics" role="tabpanel" aria-labelledby="nav-itemgraphics-tab">
           


 <form  role="form" method="POST" action="{{ route('add-item') }}" id="formID" enctype="multipart/form-data">
         {{ csrf_field() }}
         
            <div class="row">
                 <!--end right side form -->
                <div class="col-md-6 col-sm-12">
                    <div class="billing-details">
                     <div class="height20"></div>

                     <!-- item title -->
                <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                       <label><?php echo translate( 88, $lang);?> <span class="required">*</span></label>
                        <input type="text" id="item_title[]" placeholder="" name="item_title[]" class="validate[required]" value="{{old('item_title[]')}}" required="required">
                      </div>
                     </div>
                </div>
                
                    <!-- item short des-->
                
                 <div class="row">
                    <div class="col-sm-12">
                       <div class="form-group">
                       <label><?php echo translate( 1218, $lang);?> <span class="required">*</span></label>
                        <textarea rows="5" class="form-control" name="item_short_desc[]"></textarea>
                      </div>
                    </div>
                </div>
                
    
                    <!-- item full des -->
                <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                        <label><?php echo translate( 91, $lang);?> <span class="required">*</span></label>
                        <textarea id="id_cazary_full" placeholder="" class="validate[required] form-control" name="item_desc[]" style="width:100% !important; height:300px;"></textarea>
                      </div>
                    </div>
                </div>
                                                    
                 <input type="hidden" name="code[]" value="en">
           
                       
                        <!-- item slug -->
                       <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                <label><?php echo translate( 946, $lang);?> <span class="required">*</span></label>
                                    <input type="text" id="item_slug" placeholder="" name="item_slug" required="required" class="validate[required]">
                                </div>
                            </div>
                         </div>
                       
                         <input type="hidden" value="graphics" name="item_script_type">
                           
                            
                            <!-- Download item free or not -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 94, $lang);?> <span class="required">*</span></label>
                                       <select name="item_type" id="item_type" class="validate[required]">
                                        <option value=""><?php echo translate( 97, $lang);?></option>
                                        <option value="yes"><?php echo translate( 100, $lang);?></option>
                                        <option value="no"><?php echo translate( 103, $lang);?></option>
                                        </select> 
                                    </div>
                                </div>
                            </div>
                            
                            
                            <!-- Regular Price for 6-->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label><?php echo translate( 106, $lang);?> <span class="required">*</span></label>
                                        <input type="text" id="regular_price_six_month" placeholder="" name="regular_price_six_month" class="validate[required,custom[integer],min[1]]">
                                    </div>
                                </div>

                                <!-- Regular Price for 12 -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label><?php echo translate( 109, $lang);?></label>
                                        <input type="text" id="regular_price_one_year" placeholder="" name="regular_price_one_year" class="validate[custom[integer],min[1]]">
                                    </div>
                                </div>
                            </div>
                            
                            
                            <!-- Extended Price (Six Month) -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label><?php echo translate( 112, $lang);?></label>
                                        <input type="text" id="extended_price_six_month" placeholder="" name="extended_price_six_month" class="validate[custom[integer],min[1]]">
                                    </div>
                                </div>

                                 <!-- Extended Price (One Year) -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label><?php echo translate( 115, $lang);?></label>
                                        <input type="text" id="extended_price_one_year" placeholder="" name="extended_price_one_year" class="validate[custom[integer],min[1]]">
                                    </div>
                                </div>
                            </div>
                            
                           
                           
                            
                            <!-- item resulation -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 118, $lang);?> <span class="required">*</span></label>
                                        <select name="high_resolution" class="validate[required]">
                                        <option value=""><?php echo translate( 97, $lang);?></option>
                                        <option value="Yes"><?php echo translate( 100, $lang);?></option>
                                        <option value="No"><?php echo translate( 103, $lang);?></option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div  id="grapics_only1">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 1191, $lang);?> <span class="required">*</span></label>
                                        <select name="item_layered" class="validate[required]">
                                        <option value=""><?php echo translate( 97, $lang);?></option>
                                        <option value="Yes"><?php echo translate( 100, $lang);?></option>
                                        <option value="No"><?php echo translate( 103, $lang);?></option>
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
                            <option value="<?php echo $graphic;?>"><?php echo $graphic;?></option>
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
                                        <option value="<?php echo $adobe;?>"><?php echo $adobe;?></option>
                                       <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            
                             <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 1200, $lang);?></label>
                                        <input type="text" id="pixel_dimensions" placeholder="" name="pixel_dimensions" class="validate[required]">
                                        <span class="fontsize12"><?php echo translate( 1209, $lang);?></span>
                                    </div>
                                </div>
                             </div>  
                             
                             
                             
                             <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 1203, $lang);?></label>
                                        <input type="text" id="print_dimensions" placeholder="" name="print_dimensions" class="validate[required]">
                                        <span class="fontsize12"><?php echo translate( 1206, $lang);?></span>
                                    </div>
                                </div>
                             </div> 
                            
                            
                           </div> 
                            
                            
                          
                            
                              <input type="hidden" name="item_token" value="<?php echo uniqid();?>">
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 166, $lang);?> <span class="required">*</span></label>
                                        
                                       <select name="support_item" class="validate[required]">
                                        <option value=""><?php echo translate( 97, $lang);?></option>
                                        <option value="Yes"><?php echo translate( 100, $lang);?></option>
                                        <option value="No"><?php echo translate( 103, $lang);?></option>
                                        </select> 
                                    </div>
                                </div>
                                
                            </div>
                    </div>
                </div>
                 <!-- left side form -->
                <div class="col-md-6 col-sm-12">
                    <div class="billing-details">
                        
                        <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 169, $lang);?> <span class="required">*</span></label>
                                        
                                       <select name="future_update" class="validate[required]">
                                        <option value=""><?php echo translate( 97, $lang);?></option>
                                        <option value="Yes"><?php echo translate( 100, $lang);?></option>
                                        <option value="No"><?php echo translate( 103, $lang);?></option>
                                        </select> 
                                    </div>
                                </div>
                                
                            </div>
                       
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 172, $lang);?></label>
                                        <input type="number" id="unlimited_download" placeholder="" name="unlimited_download">
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
                            <option value="<?php echo $cat_id;?>-cat" class="bold"><?php echo $view->cat_name;?></option>
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
                            ->where('cat_id','=',$cat_id)
                            ->where('lang_code','=',$lang)
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
                            <option value="<?php echo $subcat_id;?>-subcat"> - <?php echo $subview->subcat_name;?></option>
                            
                            
                            <?php } } } } ?>
                            </select>
                           </div>
                                </div>
                                
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 184, $lang);?> <span class="required">*</span></label>
                                        <input type="file" id="item_thumbnail" placeholder="" name="item_thumbnail" required="required" class="validate[required]">
                                        (80px X 80px)
                                        @if ($errors->has('item_thumbnail'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('item_thumbnail') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 187, $lang);?> <span class="required">*</span></label>
                                        <input type="file" id="preview_image" required="required" name="preview_image" class="validate[required]">
                                        (600 X 450px)
                                        @if ($errors->has('preview_image'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('preview_image') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                            
                   <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label><?php echo translate( 190, $lang);?></label>
                                <input type="file" placeholder="" name="image[]" class="" accept="image/*" multiple>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                            
                            
                            
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 193, $lang);?> <span class="required">*</span></label>
                                        <input type="file" id="main_file" required="required" name="main_file" class="validate[required]">
                                        <span class="fontsize12"><?php echo translate( 196, $lang);?></span>
                                        @if ($errors->has('main_file'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('main_file') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                            
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label><?php echo translate( 205, $lang);?></label>
                                        <textarea id="item_tags" placeholder="" rows="5" name="item_tags"></textarea>
                                        <span class="fontsize12"><?php echo translate( 208, $lang);?></span>
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                            
                       

                    </div>
                </div>
                
                <!--end right side form -->
                
            </div>
            
              <div class="row justify-content-center">
                    <div class="col-md-12">
                    <a href="<?php echo $url;?>/my-items" class="resetbtn"><?php echo translate( 211, $lang);?></a>
                        <button class="custom-btn"><?php echo translate( 214, $lang);?></button>
                        
                    </div>
                </div>

          </form>  




          </div>
          <!-- end graphic aria -->

</div> <!-- End tab content -->





          </div>
        </div>
    </main>

    
    
      @include('footer')
      
      

          
</body>
</html>