<!DOCTYPE html>
<html lang="en">
<head>

    <title>Reset Password</title>

 
</head>
<body>

   
	
	<div class="container">
	 <h1><?php echo $site_name;?> - Reset Password</h1>
	 
	 
	 <div class="clearfix"></div>
	 
	 <div class="row profile shop">
		<div class="col-md-6">
	 
	 
	
	<div id="outer" style="width: 100%;margin: 0 auto;background-color:#cccccc; padding:10px;">  
	
	
	<div id="inner" style="width: 80%;margin: 0 auto;background-color: #fff;font-family: Open Sans,Arial,sans-serif;font-size: 13px;
	font-weight: normal;line-height: 1.4em;color: #444;margin-top: 10px; padding:10px;">
			
			<div style="background:#22313F;padding:15px 10px 10px 10px;">
			<?php if(!empty($site_logo)){?>
			<div align="center"><img src="<?php echo $site_logo;?>" border="0" alt="logo" /></div>
			<?php } else { ?>
			<div align="center"><h2><?php echo $site_name;?></h2></div>
			<?php } ?>
			</div>
            
            
            <br/><br/>
            <div>
			<h2> Hello,</h2>
			<div style="font-size:16px;"><p> Your profile password has been changed.

</p>
			<br/><br/><p align="center">To sign in, go to <a href='<?php echo $url;?>/login'><?php echo $url;?>/login</a> and enter the following username and password :
				</p><br/>
	
	<p><strong>Username / Email: </strong> <?php echo $email;?></p>
    <p><strong>Password: </strong> <?php echo $new_pass;?></p>
    
    
    <br/><br/>
    
    <p>Regards,<br/><br/>Admin</p>
    
    </div>
    
    </div>
    
	
	</div>
	</div>
	 
	 
	 
	
	 
	 
	
	
	
	
	 
	 
	 
	 
	 
	 <div class="height30"></div>
	 <div class="row">
	
	
	
	
	
	</div>
	
	</div>
	

      
</body>
</html>