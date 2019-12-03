<!DOCTYPE html>
<html lang="en">
<head>

    <title>Cancellation & Refund Request</title>

  
	




</head>
<body>

   

    
    

	
    
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<div class="container">
	 <h1><?php echo $site_name;?> - Cancellation & Refund Request</h1>
	 
	 
	
	 
	 
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
			
			<h3> Order_details</h3>
            
            
			<p> Item Name - <?php echo $item_title;?></p>
			<p> Purchase Id - <?php echo $purchase_token;?></p>
           <p> Order Id - <?php echo $order_id;?></p>
            <p> Item url - <a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $item_slug;?>" target="_blank"><?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $item_slug;?></a></p> 
           <p> Payment Date - <?php echo $payment_date;?></p>
           <p> Payment Type - <?php echo $payment_type;?></p>
           <p> Amount - <?php echo $currency.' '.$payment;?></p>  
             	
			<br/>			
			<h3> Buyer Details</h3>
            
            <p> Name - <?php echo $buyer_name;?></p>
            <p> Email - <?php echo $buyer_email;?></p>
            <p> Profile url - <a href="<?php echo $url;?>/user/<?php echo $buyer_slug;?>" target="_blank"><?php echo $url;?>/user/<?php echo $buyer_slug;?></a></p>
	
    
    
           <br/>			
			<h3> Vendor Details</h3>
            
            <p> Name - <?php echo $vendor_name;?></p>
            <p> Email - <?php echo $vendor_email;?></p>
            <p> Profile Url - <a href="<?php echo $url;?>/user/<?php echo $vendor_slug;?>" target="_blank"><?php echo $url;?>/user/<?php echo $vendor_slug;?></a></p>
            
            
            <br/>			
			<h3> Refund Reason</h3>
            <p> Subject - <?php echo $subjected;?></p>
            <p> Comment - <?php echo $messaged;?></p>
            
            
	
	</div>
	</div>
	 
	 
	 
	
	 
	 
	
	
	
	
	 
	 
	 
	 
	 
	 <div class="height30"></div>
	 <div class="row">
	
	
	
	
	
	</div>
	
	</div>
	

      
</body>
</html>