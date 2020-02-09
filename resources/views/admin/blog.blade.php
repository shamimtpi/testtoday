<!DOCTYPE html>
<html lang="en">
<head>
	@include('admin.title')
	@include('admin.style')
	<?php
	$logid = Auth::user()->id;
	$user_checkker = DB::select('select * from users where id = ?',[$logid]);
	$hidden = explode(',',$user_checkker[0]->show_menu);
	?>
</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					@include('admin.sitename');

					<div class="clearfix"></div>

					<!-- menu profile quick info -->
					@include('admin.welcomeuser')
					<!-- /menu profile quick info -->

					<br />

					<!-- sidebar menu -->
					@include('admin.menu')

					<!-- /sidebar menu -->

					<!-- /menu footer buttons -->

					<!-- /menu footer buttons -->
				</div>
			</div>

			<!-- top navigation -->
			@include('admin.top')

			<?php $url = URL::to("/"); ?>


			<!-- /top navigation -->

			<!-- page content -->
			<div class="right_col" role="main">
				<!-- top tiles -->

				<?php  if (in_array(11, $hidden)){?>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Blog</h2>
							<ul class="nav navbar-right panel_toolbox">

								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
							</ul>
							<div class="clearfix"></div>

						</div>

						<form action="{{ route('admin.blog') }}" method="post">

							{{ csrf_field() }}
							<div align="right">

								<?php if(config('global.demosite')=="yes"){?>

								<a href="#" class="btn btn-danger btndisable">Delete All</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
								<?php } else { ?>
								<input type="submit" value="Delete All" class="btn btn-danger" id="checkBtn" onClick="return confirm('Are you sure you want to delete?');">
								<?php } ?>


								<?php if(config('global.demosite')=="yes"){?>
								<span class="disabletxt">( <?php echo config('global.demotxt');?> )</span> <a href="#" class="btn btn-primary btndisable">Add Post</a> 
								<?php } else { ?>
								<a href="<?php echo $url;?>/admin/add-blog" class="btn btn-primary">Add Post</a>
								<?php } ?>
								<div class="x_content">


									<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th width="10%">
													<button type="button" id="selectAll" class="main">
														<span class="sub"></span> Select All </button></th>

														<th>Sno</th>
														<th>Title</th>

														<th>Comment</th>
														<th>Media</th>
														<th>Action</th>

													</tr>
												</thead>
												<tbody>
													<?php 
													$i=1;
													foreach ($blog as $blogs) { 

														$post_comment = DB::table('posts')
														->where('post_parent', '=', $blogs->post_id)
														->where('post_comment_type', '=', 'blog')
														->where('post_type', '=', 'comment')
														->count();
														$active_comment = DB::table('posts')
														->where('post_parent', '=', $blogs->post_id)
														->where('post_comment_type', '=', 'blog')
														->where('post_type', '=', 'comment')
														->where('post_status', '=', '1')
														->count();		 
														$deactive_comment = DB::table('posts')
														->where('post_parent', '=', $blogs->post_id)
														->where('post_comment_type', '=', 'blog')
														->where('post_type', '=', 'comment')
														->where('post_status', '=', '0')
														->count();	 
														?>


														<tr>

															<td><input type="checkbox" name="postid[]" value="<?php echo $blogs->post_id;?>"/></td>
															<td><?php echo $i;?></td>

															<td><?php echo $blogs->post_title;?></td>



															<td> <a href="<?php echo $url;?>/admin/comment/blog/comment/<?php echo $blogs->post_id;?>" style="color:#067DE3; text-decoration:underline;"><?php echo $post_comment;?> Comment</a> 
																<br/>
																<span style="color:#006600;"><?php echo $active_comment;?> Active</span> |  <span style="color:#FF0000;"><?php echo $deactive_comment;?> Deactive</span>
															</td>

															<?php 

															$path ='/local/images/media/blog/'.$blogs->post_image;
															if($blogs->post_media_type=="image"){
																?>
																<td><img src="<?php echo $url.$path;?>" class="thumb" width="70"></td>
																<?php } if($blogs->post_media_type=="mp3"){ ?>
																<td><img src="<?php echo $url.'/local/images/mp3.png';?>" class="thumb" width="70"></td>
																<?php } if($blogs->post_media_type=="video"){ ?>
																<td><img src="<?php echo $url.'/local/images/video.png';?>" class="thumb" width="70"></td>
																<?php  } ?>



																<td>
																	<?php if(config('global.demosite')=="yes"){?>
																	<a href="#" class="btn btn-success btndisable">Edit</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
																	<?php } else { ?>

																	<a href="<?php echo $url;?>/admin/edit-blog/{{ $blogs->post_id }}" class="btn btn-success">Edit</a>
																	<?php } ?>
																	<?php if(config('global.demosite')=="yes"){?>
																	<a href="#" class="btn btn-danger btndisable">Delete</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
																	<?php } else { ?>
																	<a href="<?php echo $url;?>/admin/blog/{{ $blogs->post_id }}" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this?')">Delete</a>
																	<?php } ?>
																</td>
															</tr>
															<?php $i++;} ?>

														</tbody>
													</table>
												</div>
											</div>
										</form>
									</div>
									<?php }  ?>
								</div>
								<!-- /page content -->

								@include('admin.footer')
							</div>
						</div>
					</body>
					</html>
