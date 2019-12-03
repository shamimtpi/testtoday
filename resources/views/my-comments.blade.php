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
?>
<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
	<title><?php echo translate( 25, $lang);?> - <?php echo translate( 646, $lang);?></title>




</head>
<body class="index">

    

    <!-- fixed navigation bar -->
    @include('header')

    
     
    

	
    
	
	<div class="pagetitle" align="center">
        
           
                <h2 class="black text-center"><?php echo translate( 646, $lang);?></h2>
           
       
    </div>
	
	
	
	
	
	
	
	
	
	
	
	<main class="main-wrapper-inner blog-wrapper" id="container">

            	<div class="container">

                	<div class="wrapper-inner">
    
    
			<div id="page-inner"> 
                  <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 paddingoff">
                    <!-- Advanced Tables -->
                   
                        <div class="float-left">
                        <h4 class="bold black "><?php echo $postcount;?> <?php echo translate( 649, $lang);?></h4>
                        </div>
                        <div class="float-right">
                        <a href="<?php echo $url;?>/dashboard" class="newcustombtn"><?php echo translate( 652, $lang);?></a>
                        </div>
                        
                    </div>    
                        
                        
                            <div class="overx">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><?php echo translate( 655, $lang);?></th>
											<th width="20%"><?php echo translate( 88, $lang);?></th>
											<th  width="10%"><?php echo translate( 658, $lang);?></th>
											<th><?php echo translate( 661, $lang);?></th>
											
											<th><?php echo translate( 664, $lang);?></th>
                                            <th><?php echo translate( 667, $lang);?></th>
                                        </tr>
                                    </thead>
									<tbody>
									<?php
										$sno=0;
										
										foreach($viewpost as $row)
										{
											$getpost_count = DB::table('posts')
														->where('post_type', '!=' , 'comment')
														->where('post_id', '=' , $row->post_parent)
														
														->count();
														if(!empty($getpost_count))
														{
											              $getpost = DB::table('posts')
														->where('post_type', '!=' , 'comment')
														->where('post_id', '=' , $row->post_parent)
														->get();
											$sno++;
											
											if($row->post_status==1){ $status = translate( 670, $lang); $color ="#078748"; } else {  $status = translate( 673, $lang); $color ="#CB2027"; }
											
									?>  									
										<tr>
											<td><?php echo $sno; ?></td>
											<td><?php echo $getpost[0]->post_title;?></td>
											<td><?php echo $row->post_comment_type;?></td>	
											<td><?php echo $row->post_desc;?></td>	
												
											<td style="color:<?php echo $color;?>"><?php echo $status;?></td>											
											<td><a href="<?php echo $url;?>/my-comments/<?php echo $row->post_id;?>" onClick="return confirm('<?php echo translate( 304, $lang);?>');"><img src="<?php echo $url;?>/local/images/delete.png" border="0" alt="delete" /></a></td>
										</tr>
										<?php } } ?>		
									</tbody>
															
                                </table>
                            </div>
                        
                   
                    <!--End Advanced Tables -->
               
            </div>
                <!-- /. ROW  -->
            </div>
		</div>
	
    
    
	</div>
	
	<div class="clearfix height50"></div>
	

     </main>

      @include('footer')
</body>
</html>