
<!--Start Portfolio Area-->
@if(!empty($items_count))

<div class="section-inner container listShow" id="cp_portfolio">
  <div class="page-header">
         <h2 class="section-title">Portfolio</h2>
      </div>
      <div class="height20"></div>
     <div class="row">
                <?php 
        $items = DB::table('products')
        ->where('delete_status', '=', '')
        ->where('item_status', '=', 1)
        ->where('lang_code','=',$lang)
        ->where('user_id','=',$uu)
        ->orderBy('item_id', 'desc')
        ->get();  
        foreach($items as $views){
        
        $user_count = DB::table('users')
             ->where('id', '=', $views->user_id)
             ->count(); 
        if(!empty($user_count))
        {
           $user_details = DB::table('users')
             ->where('id', '=', $views->user_id)
             ->get();
          $user_name = $user_details[0]->name;
          $user_slug = $user_details[0]->user_slug;
          $user_photo = $user_details[0]->photo;    
        }
        else
        {
          $user_name = "";
          $user_slug = "";
           $user_photo = "";
        }
        
        
        if($lang == "en")
        {
          $texter = $views->item_id;
        }
        else
        {
          $texter = $views->parent;
        }
        
        $review_count_03 = DB::table('product_ratings')
        ->where('item_id', '=', $texter)
        ->count();
        
        if(!empty($review_count_03))
        {
        $review_value_03 = DB::table('product_ratings')
                       ->where('item_id', '=', $texter)
                       ->get();
        
        
        $over_03 = 0;
            $fine_value_03 = 0;
        foreach($review_value_03 as $review){
        if($review->rating==1){$value1 = $review->rating*1;} else { $value1 = 0; }
    if($review->rating==2){$value2 = $review->rating*2;} else { $value2 = 0; }
    if($review->rating==3){$value3 = $review->rating*3;} else { $value3 = 0; }
    if($review->rating==4){$value4 = $review->rating*4;} else { $value4 = 0; }
    if($review->rating==5){$value5 = $review->rating*5;} else { $value5 = 0; }
    
    $fine_value_03 += $value1 + $value2 + $value3 + $value4 + $value5;
    

      $over_03 +=$review->rating;
    
    
    
        }
        if(!empty(round($fine_value_03/$over_03))){ $roundeding_03 = round($fine_value_03/$over_03); } else {
      $roundeding_03 = 0; } 
        
        
        }
        
        if(!empty($review_count_03))
                                       {
                                             if(!empty($roundeding_03)){
  
                                             if($roundeding_03==1){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                   
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    
                                                    
                          <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_03.')
                                                </p>';
                        }
                        if($roundeding_03==2){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                   
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                   
                          
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_03.')
                                                </p>';
                        }
                        
                        if($roundeding_03==3){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                   
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                          <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                   
                          
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_03.')
                                                </p>';
                        }
                        
                        if($roundeding_03==4){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                          <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                          <i class="fa fa-star my_yellow" aria-hidden="true"></i> 
                                                    
                                                                      
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_03.')
                                                </p>';
                        }
                        
                        if($roundeding_03==5){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                          <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                          <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                           <i class="fa fa-star my_yellow" aria-hidden="true"></i> ('.$review_count_03.')
                                                    
                          </p>';
                        }
                        
                        
                        }
                          else if(empty($roundeding_03)){  $rateus_new_03 = '
                        <p class="review-icon">
                                                    
                          <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                          <i class="fa fa-star" aria-hidden="true"></i>
                          <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_03.')
                          </p>';
                        }
                        
                        }
                        
                        
                        
                        $rateus_empty_03 = '
                        <p class="review-icon">
                                                    
                          <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                          <i class="fa fa-star" aria-hidden="true"></i>
                          <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_03.')
                          </p>';
                        
           
        ?>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 li-item">
                    <div class="item-demo">
                        <figure>
                            
                            <?php if(!empty($views->preview_image)){?>
                            <img src="<?php echo $url;?>/local/images/media/preview/<?php echo $views->preview_image;?>" alt="">
                            <?php } else { ?>
                             <img src="<?php echo $url;?>/local/images/noimage.jpg" alt="">
                             <?php } ?>
                            
                            <div class="product-caption">
                                <div class="caption-cel">
                                    <div class="product-link">
                                        <div>
                                            <div>
                                                <a href="<?php echo $url;?>/item/<?php echo $texter;?>/<?php echo $views->item_slug;?>" class="radiusoff"><?php echo translate( 223, $lang);?> <span><i class="fa fa-eye"></i></span></a>
                                            </div>
                                            <?php /*?><div>
                                                <a href="<?php echo $url;?>/cart" class="radiusoff">Add to Cart<span><i class="fa fa-shopping-cart"></i></span></a>
                                            </div><?php */?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </figure>
                        <div class="product-info">
                            <div class="product-header">
                              <div class="row pl-3 pr-3">
                                <h3 class="product-name custom_tittle col-md-8 paddingoff homenew"><a href="<?php echo $url;?>/item/<?php echo $texter;?>/<?php echo $views->item_slug;?>"><?php echo $views->item_title;?></a> </h3><span class="alink col-md-4 paddingoff text-right">
                                @if($site_setting[0]->site_currency == "USD")
                                  ${{$views->regular_price_six_month}}
                                @else
                                  {{$site_setting[0]->site_currency}}
                                  {{$views->regular_price_six_month}}
                                @endif
                                  
                                </span>
                            </div>
                                <span class="p-author">
                                    <a href="<?php echo $url;?>/<?php echo $user_slug;?>" class="auth_texter"><?php if(!empty($user_photo)){?><img src="<?php echo $url;?>/local/images/media/userphoto/<?php echo $user_photo;?>" alt="<?php echo $user_name;?>" border="0" class="roundshape" style="width:30px; border-radius:50px;" /><?php } else { ?><img src="<?php echo $url;?>/local/images/nophoto.jpg" alt="<?php echo $user_name;?>" border="0" class="roundshape" style="width:30px; border-radius:50px;" /><?php } ?> <?php echo $user_name;?></a>
                                </span>
                            </div>
                            <div class="product-meta">
                                <span class="meta-download">
                                    <i class="fa fa-cloud-download"></i><?php echo $views->downloaded;?>
                                </span>
                                <span class="meta-love">
                                    <i class="fa fa-heart"></i><?php echo $views->liked;?>
                                </span>
                                 <span class="meta-love" style="padding-left:8px">
                                    <i class="fa fa-eye"></i>{{$views->view_count}}
                                </span>
                                <span class="meta-rating">
                                    <?php if(!empty($review_count_03)){ echo $rateus_new_03; } else { echo $rateus_empty_03; }?> 
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <?php }  ?>
            </div>
            <!-- Pagination -->
          <div class="row justify-content-center">
                <div class="turn-page" id="welpager"></div>
          </div>
          <!--End Pagination-->
        </div>
     @endif
        <!--End Portfolio Area-->

        