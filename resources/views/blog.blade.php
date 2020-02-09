<?php
use Illuminate\Support\Facades\Route;
use App\Models\lang\codepopular_lang;
use App\Models\settings\setting;
$currentPaths= Route::getFacadeRoot()->current()->uri();  
$url = URL::to("/");
$setid=1;
$setts = setting::where('id',$setid)->get();
$headertype = $setts[0]->header_type;
$default = codepopular_lang::where('lang_default',1)->get();


$default_cnt = codepopular_lang::where('lang_default',1)->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }     
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8" />
 <link rel="stylesheet" href="{{asset('local/public/contents/frontend/css')}}/modal-video.min.css">

 @include('style')
 <title><?php echo translate( 25, $lang);?> - <?php if(!empty($blog_count)){?><?php echo translate( 226, $lang);?><?php } ?><?php if(!empty($post_count)){?><?php echo $post[0]->post_title; ?><?php } ?></title>


 <?php if(!empty($post_count)){?>
 <meta property="og:type" content="article">
 <meta property="og:title" content="<?php echo $post[0]->post_title;?>">
 <meta property="og:description" content="<?php echo substr($post[0]->post_desc,0,280).'...';?>">
 <meta property="og:url" content="<?php echo $url;?>/<?php echo $post[0]->post_slug;?>">
 <meta property="og:site_name" content="<?php echo $setts[0]->site_name;?>">
 <?php if(!empty($post[0]->post_image)){ ?>
 <meta property="og:image" content="<?php echo $url.'/local/images/media/blog/'.$post[0]->post_image;?>">
 <?php } else { ?>
 <meta property="og:image" content="<?php echo $url;?>/local/images/noimage.jpg">
 <?php } ?>
 <meta property="og:image:width" content="400">
 <meta property="og:image:height" content="300">


 <!-- twitter meta ---->
 <meta name="twitter:title" content="<?php echo $post[0]->post_title;?>">
 <meta name="twitter:description" content="<?php echo substr($post[0]->post_desc,0,280).'...';?>">
 <meta name="twitter:image" content="<?php echo $url.'/local/images/media/blog/'.$post[0]->post_image;?>">
 <meta name="twitter:site" content="<?php echo $setts[0]->site_name;?>">
 <meta name="twitter:creator" content="<?php echo $setts[0]->site_name;?>">




 <?php } ?>

 <script type="text/javascript">
  $(document).ready(function() {

    $(".listShow1").cPager({
      pageSize: {{$setts[0]->site_blog_per}}, 
      pageid: "welpager1", 
      itemClass: "li-item1",
      pageIndex: 1

    });
    
  });
</script>
</head>
<body class="index">
  <!-- fixed navigation bar -->
  @include('header')

  <?php if($setts[0]->site_blog_visible=="yes"){?>



  <!-- Main Section -->
  <main class="main-wrapper-inner blog-wrapper" id="container">
    <div class="container">
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
      </div>


      <div class="wrapper-inner row">
        <?php if(!empty($blog_count)){?>
        <?php foreach($blogs as $blog){
          $date = $blog->post_date;
          $old_date = strtotime($date);
          $dateonly = date('d M Y', $old_date);
          ?>
          <div class="col-md-4" style="maring-bottom:50px">  
           <div class="bloglist listShow1 mb20">
            <article id="post" class="post li-item1">

              <?php if($blog->post_media_type=="image"){ ?>
              <?php if(!empty($blog->post_image)){ ?>

              <a href="<?php echo $url;?>/blog/<?php echo $blog->post_slug;?>" title="<?php echo $blog->post_title;?>">
                <img src="<?php echo $url.'/local/images/media/blog/'.$blog->post_image;?>" class="img-responsive" alt="<?php echo $blog->post_title;?>">

              </a>
              <?php } else {?>
              <a href="<?php echo $url;?>/blog/<?php echo $blog->post_slug;?>" title="<?php echo $blog->post_title;?>">
                <img src="<?php echo $url;?>/local/images/noimage.jpg" class="img-responsive" alt="<?php echo $blog->post_title;?>">
              </a>

              <?php } ?>
              <?php } ?>

              <?php if($blog->post_media_type=="mp3"){ ?>

              <div class="text-center mp3_boxer">
                <div class="height20"></div>
                <div class="mediPlayer" style="height:156px">
                  <audio class="listen" preload="none" data-size="250" src="<?php echo $url;?>/local/images/media/blog/<?php echo $blog->post_audio;?>" style="height: 100px"></audio>
                </div>
                <div class="height20"></div>
              </div>
              <style> 
                svg#playable0 {
                    height: 104px;
                    margin-top: 24px;
                }
              </style>

              <?php } ?>

              <div>

                <?php 
                if($blog->post_media_type=="video"){
                  if (strpos($blog->post_video, 'youtube') > 0) {
                   $vurl = $blog->post_video;
                   preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $vurl, $matches);
                   $id = $matches[1];

                   $height = '420px';
                   ?>




                 <!--  <iframe id="ytplayer" type="text/html" width="100%" height="<?php echo $height ?>" src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3" frameborder="0" allowfullscreen></iframe> -->

                 <div class="blog-video" style="background:url(https://img.youtube.com/vi/<?php echo $id;?>/hqdefault.jpg)no-repeat scroll 0 0 / 100% 100%">
                  <div class="blog-video-overlay">
                    <a class="play-btn" href="#" data-video-id="{{$id}}"></a>
                  </div>
                </div>

                 <?php } 
                 if (strpos($blog->post_video, 'vimeo') > 0) {
                  $vimeo = $blog->post_video;
                  ?>
                  <div class='embed-container'>
                    <iframe src="https://player.vimeo.com/video/<?php echo (int) substr(parse_url($vimeo, PHP_URL_PATH), 1);?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                  </div>
                <?php }
              } ?>

            </div>
            <?php
            $post_comment = DB::table('posts')
            ->where('post_parent', '=', $blog->post_id)
            ->where('post_comment_type', '=', 'blog')
            ->where('post_type', '=', 'comment')
            ->where('post_status', '=', '1')
            ->count();
            ?>

            <div class="codepopular_bloginfo">
              <span class="blogerdate">
                <i class="fa fa-calendar"></i> <?php echo $dateonly;?>
              </span>
              <h3>
                <a href="<?php echo $url;?>/blog/<?php echo $blog->post_slug;?>" title="<?php echo $blog->post_title;?>" class="btitles">

                  {{substr($blog->post_title,0,50).'..'}}

                </a>
              </h3>


              {{--     <p>{!!(substr($blog->post_desc,0,110)).'..'!!}</p> --}}




              <div class="clearfix"></div>
              <div class="float-left">
                <div class="text-left"><a href="<?php echo $url;?>/blog/<?php echo $blog->post_slug;?>" class="custom-btn"><?php echo translate( 232, $lang);?></a></div>
              </div>
              <div class="float-right">
               <i class="fa fa-comment-o" aria-hidden="true"></i> <?php echo $post_comment;?> <?php echo translate( 235, $lang);?>
             </div>
           </div>

           <div class="clearfix height20"></div>
         </article>
       </div>
     </div>

     <?php } ?>

     <?php } ?>

   </div>

   <div class=" row justify-content-center">
     <div class="turn-page" id="welpager1"></div>
   </div>

 </div>
 <div class="container">
  <div class="row">
    <?php if(!empty($post_count)){
      $date = $post[0]->post_date;
      $old_date = strtotime($date);
      $dateonly = date('d F Y', $old_date);
      ?>

      <div class="col-md-9">
        <?php if($post[0]->post_media_type=="image"){ ?>
        <div class="text-center">
          <?php if(!empty($post[0]->post_image)){ ?>
          <img src="<?php echo $url.'/local/images/media/blog/'.$post[0]->post_image;?>" class="img-responsive" title="<?php echo $post[0]->post_title;?>">
          <?php } else {?>
          <img src="<?php echo $url;?>/local/images/noimage.jpg" class="img-responsive" title="<?php echo $post[0]->post_title;?>">
          <?php } ?>
        </div>
        <?php } ?>


        <?php if($post[0]->post_media_type=="mp3"){ ?>
        <div class="text-center mp3_boxer">
          <div class="height20"></div>
          <div class="mediPlayer">
            <audio class="listen" preload="none" data-size="200" src="<?php echo $url;?>/local/images/media/blog/<?php echo $post[0]->post_audio;?>"></audio>
          </div>
          <div class="height20"></div>
        </div>
        <?php } ?>


        <?php 
        if($post[0]->post_media_type=="video"){?>





        <div>
          <?php
          if (strpos($post[0]->post_video, 'youtube') > 0) {
           $vurl = $post[0]->post_video;
           preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $vurl, $matches);
           $id = $matches[1];

           $height = '420px';
           ?>


           <iframe id="ytplayer" type="text/html" width="100%" height="<?php echo $height ?>" src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3" frameborder="0" allowfullscreen></iframe>

         <?php } 
         if (strpos($post[0]->post_video, 'vimeo') > 0) {
          $vimeo = $post[0]->post_video;
          ?>
          <iframe src="https://player.vimeo.com/video/<?php echo (int) substr(parse_url($vimeo, PHP_URL_PATH), 1);?>" width="100%" height="420" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
          <?php }?>
        </div>
        <?php } ?>




        <div class="blogbody">
          <div class="h3 black"><?php echo $post[0]->post_title;?></div>

          <p><i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo $dateonly;?></p>
          <div class="clearfix"></div>
          <div class="cpara black"><?php echo html_entity_decode($post[0]->post_desc);?></div>
          <div class="clearfix height40"></div>


          <div class="socialshare text-left">
            <?php 
            if(!empty($post[0]->post_image)){  $imgurls = $url.'/local/images/media/blog/'.$post[0]->post_image; } 
            else { $imgurls = $url.'/local/images/noimage.jpg'; }

            ?>
            
            <span class="bold black"><i class="fa fa-share-alt" aria-hidden="true"></i> <?php echo translate( 238, $lang);?> :</span>
            <span>
              <a class="share-button" data-share-url="<?php echo $url;?>/<?php echo $post[0]->post_slug;?>" data-share-network="facebook" data-share-text="<?php echo substr($post[0]->post_desc,0,80);?>" data-share-title="<?php echo $post[0]->post_title;?>" data-share-via="<?php echo $setts[0]->site_name;?>" data-share-tags="" data-share-media="<?php echo $imgurls;?>" href="javascript:void(0);"><img src="<?php echo $url;?>/local/images/social/facebook.png" border="0" /></a>

              <a class="share-button" data-share-url="<?php echo $url;?>/<?php echo $post[0]->post_slug;?>" data-share-network="twitter" data-share-text="<?php echo substr($post[0]->post_desc,0,80);?>" data-share-title="<?php echo $post[0]->post_title;?>" data-share-via="<?php echo $setts[0]->site_name;?>" data-share-tags="" data-share-media="<?php echo $imgurls;?>" href="javascript:void(0);"><img src="<?php echo $url;?>/local/images/social/twitter.png" border="0" /></a>

              <a class="share-button" data-share-url="<?php echo $url;?>/<?php echo $post[0]->post_slug;?>" data-share-network="linkedin" data-share-text="<?php echo substr($post[0]->post_desc,0,80);?>" data-share-title="<?php echo $post[0]->post_title;?>" data-share-via="<?php echo $setts[0]->site_name;?>" data-share-tags="" data-share-media="<?php echo $imgurls;?>" href="javascript:void(0);"><img src="<?php echo $url;?>/local/images/social/linkedin.png" border="0" /></a>

              <a class="share-button" data-share-url="<?php echo $url;?>/<?php echo $post[0]->post_slug;?>" data-share-network="googleplus" data-share-text="<?php echo substr($post[0]->post_desc,0,80);?>" data-share-title="<?php echo $post[0]->post_title;?>" data-share-via="<?php echo $setts[0]->site_name;?>" data-share-tags="" data-share-media="<?php echo $imgurls;?>" href="javascript:void(0);"><img src="<?php echo $url;?>/local/images/social/gplus.png" border="0" /></a>

              <a class="share-button" data-share-url="<?php echo $url;?>/<?php echo $post[0]->post_slug;?>" data-share-network="pinterest" data-share-text="<?php echo substr($post[0]->post_desc,0,80);?>" data-share-title="<?php echo $post[0]->post_title;?>" data-share-via="<?php echo $setts[0]->site_name;?>" data-share-tags="" data-share-media="<?php echo $imgurls;?>" href="javascript:void(0);"><img src="<?php echo $url;?>/local/images/social/pinterest.png" border="0" /></a>


              <a  class="share-button" data-share-url="<?php echo $url;?>/<?php echo $post[0]->post_slug;?>" data-share-network="reddit" data-share-text="<?php echo substr($post[0]->post_desc,0,80);?>" data-share-via="<?php echo $setts[0]->site_name;?>" data-share-tags="" data-share-media="<?php echo $imgurls;?>" href="javascript:void(0);"><img src="<?php echo $url;?>/local/images/social/reddit.png" border="0" /></a>
            </span>

          </div>

          <div class="clearfix height20"></div>     
          <div class="text-left">
            <span class="bold black"><i class="fa fa-tags" aria-hidden="true"></i> <?php echo translate( 205, $lang);?> :</span>

            <span>
              <?php 
              $post_tags = explode(',',$post[0]->post_tags);

              foreach($post_tags as $tags)
              {
                $tag =strtolower(str_replace(" ","-",$tags)); 
                if(!empty($tags))
                {
                  ?>
                  <a href="<?php echo $url;?>/tag/blog/<?php echo $tag;?>" class="white gcolorbg"><?php echo $tags;?></a>
                  <?php
                }
              }
              ?>
            </span>

          </div>



          <div class="clearfix height50"></div>

         <?php /*?><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 paddingoff">
          <?php if(!empty($previous)){
    
    ?>
         <div class="float-left"><a href="<?php echo $url;?>/blog/<?php echo $previous_link[0]->post_slug;?>" class="custom-btn"><i class="fa fa-chevron-left" aria-hidden="true"></i> <?php echo 'previous';?></a></div>
         <?php } ?>
         
         
         
         <?php if(!empty($next)){
    
     ?>
         <div class="float-right"><a href="<?php echo $url;?>/blog/<?php echo $next_link[0]->post_slug;?>" class="custom-btn"><?php echo 'next';?> <i class="fa fa-chevron-right" aria-hidden="true"></i></a></div>
          <?php } ?>
        </div><?php */?>


        

        
        <div class="clearfix height50"></div>

        {{-- START BLOG COMMENT --}}
        {{-- @include('template-parts.blog.blog-comments') --}}

        <div class="fb-comments" data-href="{{$url}}/blog" data-width="800" data-numposts="10"></div>

        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v4.0&appId=2236718163260865&autoLogAppEvents=1"></script>






        {{-- END BLOG COMMENTS --}}



      </div>      


      <?php } ?>

    </div>



        <!-----------------------------------------
                    start right sidebar
                    ---------------------------------------->  
                    <?php if(!empty($post_count)){?>
                    <div class="col-md-3" style="background: #fff">

                      <div class="borderbottom">
                        <h3 class="h4 heading black blogsidebar">
                          <?php echo translate( 229, $lang);?>
                        </h3>

                      </div>
                      <div class="height20"></div>

                      <?php foreach($popular_blog as $popular){?>

                      <div class="clearfix row">
                        <div class="col-md-4">
                          <?php if($popular->post_media_type=="image"){ ?>
                          <?php if(!empty($popular->post_image)){ ?>
                          <a href="<?php echo $url;?>/blog/<?php echo $popular->post_slug;?>" title="<?php echo $popular->post_title;?>"><img src="<?php echo $url.'/local/images/media/blog/'.$popular->post_image;?>" class="img-responsive blogpost"></a>
                          <?php } else {?>
                          <a href="<?php echo $url;?>/blog/<?php echo $popular->post_slug;?>" title="<?php echo $popular->post_title;?>"><img src="<?php echo $url;?>/local/images/noimage.jpg" class="img-responsive blogpost" alt="{{$popular->post_title}}"></a>
                          <?php } ?>
                          <?php } ?>

                          <?php if($popular->post_media_type=="mp3"){ ?>
                          <a href="<?php echo $url;?>/<?php echo $popular->post_slug;?>" title="<?php echo $popular->post_title;?>"><img src="<?php echo $url;?>/local/images/blogaudio.png" class="img-responsive blogpost"></a>

                          <?php } ?>
                          <?php if($popular->post_media_type=="video"){?>
                          <a href="<?php echo $url;?>/<?php echo $popular->post_slug;?>" title="<?php echo $popular->post_title;?>"><img src="<?php echo $url;?>/local/images/blogvideo.png" class="img-responsive blogpost"></a>
                          <?php } ?>

                        </div>
                        <div class="col-md-8 paddingleft10rightoff">
                          <div class="black para poptitle ellipsis"><a href="<?php echo $url;?>/blog/<?php echo $popular->post_slug;?>" title="<?php echo $popular->post_title;?>" class="black decorationoff hoveroff"><?php echo $popular->post_title;?></a></div>
                          <div class="ash fontsize12"><?php echo date("d M Y h:i:s a",strtotime($popular->post_date));?></div>
                        </div>

                      </div>
                      <div class="clearfix height20"></div>
                      <?php } ?>
                    </div>
                    <?php } ?>               
      <!---------------------------------
                  End right sidebar 
                  -------------------------------->  









                </div>
              </div>





            </main>
            <!--End Main Section-->



            <?php } else { ?>

            <!-- promo section -->
            <div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
              <div class="container">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="promo-text">
                      <h2 class="avigher-title bolder fontsize30"><?php echo translate( 79, $lang);?></h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end promo -->

            <!-- Breadcum -->
            <div class="about-breadcrumb">
              <div class="container">
                <div class="row">
                  <div class="col-sm-12">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?php echo $url;?>"><?php echo translate( 40, $lang);?></a>
                      </li>

                      <li class="breadcrumb-item active"><?php echo translate( 79, $lang);?></li>

                    </ol>
                  </div>
                </div>
              </div>
            </div> 
            <!-- end Breadcum -->


  <!-----------------------------
            Main Sesion
            ------------------------------>
            <main class="checkout-area main-content">
              <div class="clearfix height20"></div>
              <div class="container">
                <div class="row">
                  <div class="">
                    <div class="">
                      <div class="col-md-12 text-center">
                        <h3>
                          <?php echo translate( 82, $lang);?>
                        </h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </main>

            <?php } ?>
            <script src="<?php echo $url;?>/local/resources/views/theme/js/jquery.simpleSocialShare.min.js"></script>
            <script type="text/javascript">

              $(document).ready(function(){
                $('.share-button').simpleSocialShare();
              });
            </script>
            @include('footer')


  <script src={{asset('local/public/contents/frontend/js')}}/jquery-modal-video.min.js></script>
   <script>
       $(".play-btn").modalVideo({
        autoplay:true,
       });
  </script>


            <style type="text/css"> 

              body{

                background: #f0f0f0
              }


            </style>

          </body>
          </html>