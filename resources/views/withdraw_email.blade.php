<!DOCTYPE html>
<html lang="en">
<head>

    <title>Withdrawal Request</title>

  
	




</head>
<body>

   

    
    

	
    
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<div class="container">
	 <h1><?php echo $site_name;?> - Withdrawal Request</h1>
	 
	 
	
	 
	 
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
			
			<h3> Withdrawal Request</h3>
			<p> Amount - <?php echo $currency.$withdraw_amount;?></p>
			<p> Withdrawal Type - <?php echo $withdraw_type;?></p>
            <?php if(!empty($paypal_id)){?> 	
			<p> Paypal Id - <?php echo $paypal_id;?></p>
            <?php } ?>
            <?php if(!empty($stripe_id)){?> 	
			<p> Stripe - <?php echo $stripe_id;?></p>
            <?php } ?>
            
            <?php if($withdraw_type=="localbank"){?>
            <p> Bank Account No - <?php echo $bank_acc_no;?></p>
            <p> Bank Name & Address - <?php echo $bank_name;?></p>
            <p> IFSC Code - <?php echo $ifsc_code;?></p>
            <?php } ?>
             	
		   <?php if($withdraw_type=="paytm"){?>			
			 <p> Paytm Number - <?php echo $paytm_id;?></p>
            <?php } ?> 
            
             <?php if(!empty($perfectmoney)){?>			
			 <p> Perfect Money Id - <?php echo $perfectmoney;?></p>
            <?php } ?> 		
			
	
	
	</div>
	</div>
	 
	 
	 
	
	 
	 
	
	
	
	
	 
	 
	 
	 
	 
	 <div class="height30"></div>
	 <div class="row">
	
	
	
	
	
	</div>
	
	</div>
	

      
</body>
</html>