<!DOCTYPE html>
<html lang="en">
<head>

    <title>Newsletter Subscribe</title>

</head>
<body>

	
	<div class="container">
	 <h1><?php echo $site_name;?> - Newsletter Subscribe</h1>
	 
	 
	 <div class="clearfix"></div>
	 
	 <div class="row profile shop">
		<div class="col-md-6">
	 
	 
	
	<div id="outer" style="width: 100%;margin: 0 auto;background-color:#cccccc; padding:10px;">  
	
	
	<div id="inner" style="width: 80%;margin: 0 auto;background-color: #fff;font-family: Open Sans,Arial,sans-serif;font-size: 13px;
	font-weight: normal;line-height: 1.4em;color: #444;margin-top: 10px; padding:10px;">
			<div style="background:#B98B4B;padding:15px 10px 10px 10px;">
			
			<?php if(!empty($site_logo)){?>
			<div align="center"><img src="<?php echo $site_logo;?>" border="0" alt="logo" /></div>
			<?php } else { ?>
			<div align="center"><h2><?php echo $site_name;?></h2></div>
			<?php } ?>
            
            </div>
			
			<h3>Hi,</h3>
				
            <br/>
            <br/>
                
			<p style="line-height:25px;">
            A newsletter subscription request for this email address was received.
            Please confirm it by <a href="<?php echo $site_url;?>/thankyou/<?php echo $get_id;?>">clicking here</a>. <br/>If you cannot click the link, please use the following link:
            <a href="<?php echo $site_url;?>/thankyou/<?php echo $get_id;?>"><?php echo $site_url;?>/thankyou/<?php echo $get_id;?></a>
            </p>
            
            <br/>
            <br/>
            
            
            <p>Thanks,<br/>Admin</p>
	
	
	
	
	</div>
	</div>
	 
	 
	 
	 
	 <div class="height30"></div>
	 <div class="row">
	
	
	
	
	
	</div>
	
	</div>
	

      
</body>
</html>