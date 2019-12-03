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
			
			
			<script type="text/javascript">
	 
	 $(function() {
   
    $('#stripe_mode').change(function(){
        if($('#stripe_mode').val() == 'test') {
            $('#test_box').show(); 
			$('#live_box').hide();
        } 
		
		if($('#stripe_mode').val() == 'live') {
            $('#live_box').show(); 
			$('#test_box').hide();
        }
		
		
		
    });
});

</script>
			
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
       @include('admin.top')
		
		
		
		
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
         
		 
		 
		 
           <?php  if (in_array(2, $hidden)){?>
		 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                  
 	@if(Session::has('success'))

	    <div class="alert alert-success">

	      {{ Session::get('success') }}

	    </div>

	@endif


	
	
 	@if(Session::has('error'))

	    <div class="alert alert-danger">

	      {{ Session::get('error') }}

	    </div>

	@endif
                <?php $url = URL::to("/"); ?>    
                   <form class="form-horizontal form-label-left" role="form" method="POST" action="{{ route('admin.payment-settings') }}" enctype="multipart/form-data" novalidate>
                     {{ csrf_field() }}  
                      <span class="section">Payment Settings</span>

                      
                      
					  
					  
					  
					  
						
						
					
                      
                      
                      
                      
					  
                      
                      
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Submit items live requiring approval</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top:7px;">
                          <input id="with_submit_product" type="checkbox" name="with_submit_product" value="1"  class="" <?php if($msettings[0]->with_submit_product==1){ ?> checked <?php } ?> >
						  
                        </div>
                      </div>
                      
					  
					 
					 
						
                        
                        
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      <div class="item form-group">
                <label for="amount" class="control-label col-md-3">Payment Option</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                        
						<?php 
						
						
						$array_payment =  explode(',', $msettings[0]->payment_option);
						
						
						foreach($payment as $draw){?>
						<input type="checkbox" name="payment_opt[]"  value="<?php echo $draw;?>" <?php  if(in_array($draw,$array_payment)){?> checked <?php } ?>> <?php echo $draw;?><br/>
						<?php } ?>
						</div>
						
						</div>
                        
                        
                        
                        
                        <div class="item form-group">
                <label for="amount" class="control-label col-md-3">Withdraw Option</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                        
						<?php 
						
						
						$array =  explode(',', $msettings[0]->withdraw_option);
						
						
						foreach($withdraw as $draw){?>
						<input type="checkbox" name="withdraw_opt[]" value="<?php echo $draw;?>" <?php  if(in_array($draw,$array)){?> checked <?php } ?>> <?php echo $draw;?><br/>
						<?php } ?>
						</div>
						
						</div>
                        
              
              
               
              
              
              
              
              <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Local Bank Details
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
			<textarea name="bank_details" class="form-control col-md-7 col-xs-12" required="required" style="min-height:100px;"><?php echo $bank_details; ?></textarea>
                 		<br/>
                        <strong>Example :</strong><br/>
                        Bank Name : TEST BANK<br/>
                        Branch Name : TEST BRANCH<br/>
                        Branch Code : 000000<br/>
                        IFSC Code : 38484FE <br/> 		  		  
                </div>
              </div> 
              
              
              <div class="item form-group">
                <label for="amount" class="control-label col-md-3">Paypal Id</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
             	
			<input id="paypal_id" type="text" name="paypal_id" value="<?php echo $msettings[0]->paypal_id; ?>"  class="form-control col-md-7 col-xs-12" required="required">
                 		  		  		  
                </div>
              </div>   
                      
                      
                     
                      <div class="item form-group">
                <label for="amount" class="control-label col-md-3">Paypal site Mode</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
             	
			
                 		
                     <select name="paypal_url" id="paypal_url" class="form-control col-md-7 col-xs-12" required="required">
						<option value="">Select</option>
									<option value="https://www.sandbox.paypal.com/cgi-bin/webscr" <?php { if($msettings[0]->paypal_url=="https://www.sandbox.paypal.com/cgi-bin/webscr") echo "selected='selected'"; }?>>Test</option>
									<option value="https://www.paypal.com/cgi-bin/webscr" <?php { if($msettings[0]->paypal_url=="https://www.paypal.com/cgi-bin/webscr") echo "selected='selected'"; }?>>Live</option>
								</select>   
                          		  		  
                </div>
              </div> 
              
              
              
             
                        
                        <div class="item form-group">
                <label for="amount" class="control-label col-md-3">Stripe site Mode</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                        
						
						<select name="stripe_mode" id="stripe_mode" class="form-control col-md-7 col-xs-12" required="required">
						<option value="">Select</option>
									<option value="test" <?php { if($msettings[0]->stripe_mode=="test") echo "selected='selected'"; }?>>Test</option>
									<option value="live" <?php { if($msettings[0]->stripe_mode=="live") echo "selected='selected'"; }?>>Live</option>
								</select>
						
                          
                        </div>
                      </div>
              
              
              
              
              
              
             
                        
                        <div id="test_box" <?php if($msettings[0]->stripe_mode!="test"){?> style="display:none;" <?php } ?>>
                        <div class="item form-group" id="stripe_test_publish">
                <label for="amount" class="control-label col-md-3">Test Publishable key</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                        
                        
                          <input id="test_publish_key" type="text" name="test_publish_key" value="<?php echo $msettings[0]->test_publish_key; ?>"  class="form-control col-md-7 col-xs-12" required="required">
						  
                        </div>
                      </div>
					  
                      
                      <div class="item form-group" id="stripe_test_secret">
                <label for="amount" class="control-label col-md-3">Test Secret key</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
					  
					  
                          <input id="test_secret_key" type="text" name="test_secret_key" value="<?php echo $msettings[0]->test_secret_key; ?>"  class="form-control col-md-7 col-xs-12" required="required">
						  
                        </div>
                      </div>
					  
                    </div>  
                      
                      
                      
                      
                      
                     
                      <div id="live_box" <?php if($msettings[0]->stripe_mode!="live"){?> style="display:none;" <?php } ?>>
                       
                        <div class="item form-group" id="stripe_live_publish">
                <label for="amount" class="control-label col-md-3">Live Publishable key</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                       
                       
                          <input id="live_publish_key" type="text" name="live_publish_key" value="<?php echo $msettings[0]->live_publish_key; ?>"  class="form-control col-md-7 col-xs-12" required="required">
						  
                        </div>
                      </div>
					  
                      
                      
                      <div class="item form-group" id="stripe_live_secret">
                <label for="amount" class="control-label col-md-3">Live Secret key</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
					  
					   
                          <input id="live_secret_key" type="text" name="live_secret_key" value="<?php echo $msettings[0]->live_secret_key; ?>"  class="form-control col-md-7 col-xs-12" required="required">
						  
                        </div>
                      </div>
					  
                      
                   </div>   
                      
              
              
              
              
              
              
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Razorpay Key Id
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
             	
			<input id="razorpay_key_id" type="text" name="razorpay_key_id" value="<?php echo $sett_razor_item; ?>"  class="form-control col-md-7 col-xs-12" required="required">
                 		  		  		  
                </div>
              </div> 
              
              
              
             
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Razorpay Key Secret
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
             	
			<input id="razorpay_key_secret" type="text" name="razorpay_key_secret" value="<?php echo $sett_razor_secret; ?>"  class="form-control col-md-7 col-xs-12" required="required">
                 		  		  		  
                </div>
              </div> 
              
              
              
              <div class="item form-group">
                <label for="amount" class="control-label col-md-3">Payu Site Mode</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                        
						
						<select name="payu_mode" id="payu_mode" class="form-control col-md-7 col-xs-12" required="required">
						<option value="">Select</option>
									<option value="test" <?php { if($payu_mode=="test") echo "selected='selected'"; }?>>Test</option>
									<option value="live" <?php { if($payu_mode=="live") echo "selected='selected'"; }?>>Live</option>
								</select>
						
                          
                        </div>
                      </div>
                      
                      
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Payu Merchant Key
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
             	
			<input id="payu_merchant_key" type="text" name="payu_merchant_key" value="<?php echo $payu_merchant_key; ?>"  class="form-control col-md-7 col-xs-12" required="required">
                 		  		  		  
                </div>
              </div> 
              
              
              
              <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Payu Salt
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
             	
			<input id="payu_salt" type="text" name="payu_salt" value="<?php echo $payu_salt; ?>"  class="form-control col-md-7 col-xs-12" required="required">
                 		  		  		  
                </div>
              </div> 
              
              
              
              
              
              
              
              
                <div class="item form-group">
                <label for="amount" class="control-label col-md-3">Paytm Site Mode</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                        
						
						<select name="paytm_mode" id="paytm_mode" class="form-control col-md-7 col-xs-12" required="required">
						<option value="">Select</option>
									<option value="TEST" <?php { if($paytm_mode=="TEST") echo "selected='selected'"; }?>>Test</option>
									<option value="PROD" <?php { if($paytm_mode=="PROD") echo "selected='selected'"; }?>>Live</option>
								</select>
						
                          
                        </div>
                      </div>
              
               
               
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Paytm Merchant Key
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
             	
			<input id="paytm_merchant_key" type="text" name="paytm_merchant_key" value="<?php echo $paytm_merchant_key; ?>"  class="form-control col-md-7 col-xs-12" required="required">
                 		  		  		  
                </div>
              </div> 
               
               
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Paytm Merchant ID
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
             	
			<input id="paytm_merchant_id" type="text" name="paytm_merchant_id" value="<?php echo $paytm_merchant_id; ?>"  class="form-control col-md-7 col-xs-12" required="required">
                 		  		  		  
                </div>
              </div> 
              
              
              
              <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Paytm Merchant Website
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
             	
			<input id="paytm_merchant_website" type="text" name="paytm_merchant_website" value="<?php echo $paytm_merchant_website; ?>"  class="form-control col-md-7 col-xs-12" required="required">
                 		  		  		  
                </div>
              </div> 
              
              
					
               
              
               
              
              
              <div class="item form-group">
                <label for="amount" class="control-label col-md-3">2Checkout Site Mode</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                        
						
						<select name="two_checkout_mode" id="two_checkout_mode" class="form-control col-md-7 col-xs-12" required="required">
						<option value="">Select</option>
									<option value="true" <?php { if($two_checkout_mode=="true") echo "selected='selected'"; }?>>Test</option>
									<option value="false" <?php { if($two_checkout_mode=="false") echo "selected='selected'"; }?>>Live</option>
								</select>
						
                          
                        </div>
                      </div>
                      
                      
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">2Checkout Account Number
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
             	
			<input id="two_checkout_account" type="text" name="two_checkout_account" value="<?php echo $two_checkout_account; ?>"  class="form-control col-md-7 col-xs-12" required="required">
                 		  		  		  
                </div>
              </div>       
                      
              
              
              <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">2Checkout Publishable Key
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
             	
			<input id="two_checkout_publishable" type="text" name="two_checkout_publishable" value="<?php echo $two_checkout_publishable; ?>"  class="form-control col-md-7 col-xs-12" required="required">
                 		  		  		  
                </div>
              </div> 
              
              
              <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">2Checkout Private Key
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
             	
			<input id="two_checkout_private" type="text" name="two_checkout_private" value="<?php echo $two_checkout_private; ?>"  class="form-control col-md-7 col-xs-12" required="required">
                 		  		  		  
                </div>
              </div> 
              
              
              
               <?php /* perfect money */ ?>
              
              <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Perfectmoney Account Id
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
             	
			<input id="perfectmoney_id" type="text" name="perfectmoney_id" value="<?php echo $perfectmoney_id; ?>"  class="form-control col-md-7 col-xs-12" required="required">
                 		  		  		  
                </div>
              </div> 
               
               
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Perfectmoney Account Name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
             	
			<input id="perfectmoney_name" type="text" name="perfectmoney_name" value="<?php echo $perfectmoney_name; ?>"  class="form-control col-md-7 col-xs-12" required="required">
                 		  		  		  
                </div>
              </div> 
              
              <?php /* perfect money */ ?>
              
              
              
					
                        
                        <div class="item form-group">
                <label for="amount" class="control-label col-md-3">Commission Mode</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                        
						
						<select name="commission_mode" id="commission_mode" class="form-control col-md-7 col-xs-12" required="required">
									<option value="fixed" <?php { if($msettings[0]->commission_mode=="fixed") echo "selected='selected'"; }?>>Fixed</option>
									<option value="percentage" <?php { if($msettings[0]->commission_mode=="percentage") echo "selected='selected'"; }?>>Percentage</option>
								</select>
						
                          
                        </div>
                      </div>
						
						
                         <div class="item form-group">
                <label for="amount" class="control-label col-md-3">Enter Amout / percentage</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                
                
						
                          <input id="commission_amt" type="text" name="commission_amt" value="<?php echo $msettings[0]->commission_amt; ?>"  class="form-control col-md-7 col-xs-12" required="required">
						  
                        </div>
                      </div> 
                      
                      
                      
                      
                       <div class="item form-group">
                <label for="amount" class="control-label col-md-3">Minimum Withdraw Amount</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                
                
                     
                          <input id="withdraw_amt" type="text" name="withdraw_amt" value="<?php echo $msettings[0]->withdraw_amt; ?>"  class="form-control col-md-7 col-xs-12" required="required">(<?php echo $msettings[0]->site_currency;?>)
						  
                        </div>
                      </div>
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                     <?php /*?> <div class="item form-group">
                <label for="amount" class="control-label col-md-3">Processing Fee</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                
                
                     
                          <input id="processing_fee" type="text" name="processing_fee" value="<?php echo $msettings[0]->processing_fee; ?>"  class="form-control col-md-7 col-xs-12" required="required">(<?php echo $msettings[0]->site_currency;?>)
						  
                        </div>
                      </div><?php */?>
					  
                      <input id="processing_fee" type="hidden" name="processing_fee" value="0">
                      
                      
                      
                      
                      <div class="item form-group">
                <label for="amount" class="control-label col-md-3">Featured Item Price</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                
                
                     
                          <input id="featured_price" type="text" name="featured_price" value="<?php echo $msettings[0]->featured_price; ?>"  class="form-control col-md-7 col-xs-12" required="required">(<?php echo $msettings[0]->site_currency;?>)
						  
                        </div>
                      </div>
                      
                      
                      
                      
                      <div class="item form-group">
                <label for="amount" class="control-label col-md-3">How many days display featured item?</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                
                
                     
                          <input id="featured_days" type="text" name="featured_days" value="<?php echo $msettings[0]->featured_days; ?>"  class="form-control col-md-7 col-xs-12" required="required">(days)
						  
                        </div>
                      </div>
                      
                      
                      
                      <div class="item form-group">
                <label for="amount" class="control-label col-md-3">Dispute refund time limit (buyer request)
</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                
                
                     
                          <input id="refund_time_limit" type="number" name="refund_time_limit" min="0" value="<?php echo $msettings[0]->refund_time_limit; ?>"  class="form-control col-md-7 col-xs-12" required="required">(days)
						  
                        </div>
                      </div>
                      
                      
                      
                      
                      
                      <div class="item form-group">
                <label for="amount" class="control-label col-md-3">Referral Commission Amount
</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                
                
                     
                          <input id="referral_amount" type="number" name="referral_amount" min="0" value="<?php if(!empty($referral_amount)){ echo $referral_amount; }?>"  class="form-control col-md-7 col-xs-12" required="required"><?php echo $msettings[0]->site_currency;?>
						  
                        </div>
                      </div>
					 
					 
					  
					  <?php /*?><div class="item form-group">
                <label for="amount" class="control-label col-md-3">Payment Approval? (waiting for approval)</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                        
						
						<select name="payment_approval" id="payment_approval" class="form-control col-md-7 col-xs-12" required="required">
						<option value="">Select</option>
									<option value="yes" <?php { if($payment_website=="yes") echo "selected='selected'"; }?>>Yes</option>
									<option value="no" <?php { if($payment_website=="no") echo "selected='selected'"; }?>>No</option>
								</select>
						
                          
                        </div>
                      </div><?php */?>
                      
                      
                      <input type="hidden" name="payment_approval" value="no">
                      
					  
                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <a href="<?php echo $url;?>/admin/payment-settings" class="btn btn-primary">Cancel</a>
						  <?php if(config('global.demosite')=="yes"){?><button type="button" class="btn btn-success btndisable">Submit</button> 
								<span class="disabletxt">( <?php echo config('global.demotxt');?> )</span><?php } else { ?>
						  
                          <button id="send" type="submit" class="btn btn-success">Submit</button>
								<?php } ?>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <?php }  ?>
			
		
		
		
		
		
		
		
		
		
		
		
		
        <!-- /page content -->

      @include('admin.footer')
      </div>
    </div>

    
	
  </body>
</html>
