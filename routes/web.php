<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['XSS']], function () {

/* s3 */

Route::get('s3-image-upload','S3ImageController@imageUpload');
Route::post('s3-image-upload','S3ImageController@imageUploadPost');


/* s3 */



/* dropbox */
Route::get('/test','DropboxController@uploadToDropbox');
Route::post('/test', ['as'=>'test','uses'=>'DropboxController@uploadToDropboxFile']);
/* dropbox */





Route::get('setlocale/{locale}', function ($locale) {
  if (in_array($locale, \Config::get('app.locales'))) {
    Session::put('locale', $locale);
  }
  return redirect()->back();
});





Route::get('/lang','PageController@sampleview');	
Route::get('/lang/{id}','PageController@sample');



/* POST */
Route::post('/search', ['as'=>'index','uses'=>'IndexController@avigher_search']);
Route::post('payu_failed/{cid}', function($cid) {
   
    
	return redirect('payu_failed/'.$cid);
});
Route::post('payu_success/{cid}/{txtid}', function($cid,$txtid) {
    
    
	return redirect('payu_success/'.$cid.'/'.$txtid);
});
Route::post('/blog', ['as'=>'blog','uses'=>'BlogController@avigher_blog_comment']);
Route::post('/newsletter', ['as'=>'newsletter','uses'=>'IndexController@avigher_subscribe']);
Route::post('/two_checkout_payment', ['as'=>'two_checkout_payment','uses'=>'twocheckoutController@payment_details']);
Route::post('/paytm_details', ['as'=>'paytm_details','uses'=>'PaytmController@order_details']);
Route::post('/pgResponse/status', 'PaytmController@paymentCallback');
Route::post('/razorpay_verify', ['as'=>'razorpay_verify','uses'=>'RazorpayController@avigher_razorpay']);
Route::post('/featured_paytm_details', ['as'=>'featured_paytm_details','uses'=>'PaytmController@featured_order_details']);
Route::post('/sampleResponse/status', 'PaytmController@featureCallback');
Route::post('/view-refund', ['as'=>'view-refund','uses'=>'ItemController@avigher_refund_data']);

Route::post('/dashboard', ['as'=>'dashboard','uses'=>'DashboardController@avigher_edituserdata']);


Route::post('/user-profile-title','DashboardController@profile_title')->name('profile_title');

Route::post('/wallet-balance', ['as'=>'wallet-balance','uses'=>'SuccessController@avigher_wallet_balance']);
/*Route::post('/test', ['as'=>'test','uses'=>'PageController@avigher_test_form']);*/
Route::post('/forgot-password', ['as'=>'forgot-password','uses'=>'ForgotpasswordController@avigher_forgot_password']);
Route::post('/reset-password', ['as'=>'reset-password','uses'=>'ResetpasswordController@avigher_reset_password']);
Route::post('/contact-us', ['as'=>'contact-us','uses'=>'PageController@avigher_mailsend']);
Route::post('/payment', ['as'=>'payment','uses'=>'PageController@avigher_donate_payment']);
Route::post('/add-item', ['as'=>'add-item','uses'=>'ItemController@avigher_add_items']);
Route::post('/edit-item', ['as'=>'edit-item','uses'=>'ItemController@avigher_edit_items']);
Route::post('/my-earnings', ['as'=>'my-earnings','uses'=>'EarningsController@avigher_post_data']);
Route::post('/my-shopping', ['as'=>'my-shopping','uses'=>'ItemController@avigher_review_data']);

// frontend user
Route::post('/user', ['as'=>'user','uses'=>'DashboardController@avigher_contact_vendor']);
 // user skill
Route::resource('/user-edu','User\UserEducationController');
Route::resource('/user-employment','User\UserEmploymentController');
Route::resource('/myskill','User\UserskillController');
   


Route::post('/featured-payment', ['as'=>'featured-payment','uses'=>'ItemController@avigher_featured_payment']);
Route::post('/stripe_shop_success', ['as'=>'stripe_shop_success','uses'=>'StripeController@avigher_shop_stripe']);
Route::post('/stripe_success', ['as'=>'stripe_success','uses'=>'StripeController@avigher_stripe']);
Route::post('/rozarpay_shop_success', ['as'=>'rozarpay_shop_success','uses'=>'RazorpayController@avigher_shop_rozarpay']);
Route::post('/item', ['as'=>'item','uses'=>'ItemController@avigher_item_cart']);
Route::post('/support_item', ['as'=>'support_item','uses'=>'ItemController@avigher_support_item']);
Route::post('/report_item', ['as'=>'report_item','uses'=>'ItemController@avigher_report_item']);
Route::post('/comment_item', ['as'=>'comment_item','uses'=>'ItemController@avigher_comment_item']);
Route::post('/comment_item_reply', ['as'=>'comment_item_reply','uses'=>'ItemController@avigher_comment_reply']);
Route::post('/checkout', ['as'=>'checkout','uses'=>'ItemController@avigher_item_checkout']);


Route::post('/perfectmoney_success', ['as'=>'perfectmoney_success','uses'=>'PerfectmoneyController@avigher_perfectmoney']);
Route::post('/perfectmoney_status', ['as'=>'perfectmoney_status','uses'=>'PerfectmoneyController@avigher_perfectstatus']);
Route::post('/cancel', ['as'=>'cancel','uses'=>'CancelController@avigher_returnpage']);

Route::post('/localbank', ['as'=>'localbank','uses'=>'SuccessController@avigher_localbank']);
Route::post('/verify-purchase', ['as'=>'verify-purchase','uses'=>'IndexController@avigher_check_purchase']);
/* POST */



/* GET */
Route::get('/verify-purchase','IndexController@avigher_verify_purchase');


Route::get('/localbank/{cid}', 'SuccessController@avigher_localbank_view');

Route::get('/confirmemail/{id}', 'IndexController@confirmation');
Route::get('/confirmemail', 'IndexController@view_former');
Route::get('/resend/{email_address}', 'IndexController@resend_email');
Route::get('/', 'IndexController@avigher_index');
Route::get('/index', 'IndexController@avigher_index');
Route::get('/thankyou/{id}', 'IndexController@newsletter_activate');
Route::get('/preview', 'PreviewController@avigher_index');
Route::get('/preview/{slug}/{prod_slug}', 'PreviewController@avigher_slug');
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/payu_failed/{cid}', 'CancelController@avigher_payu_failed');
Route::get('/payu_success/{cid}/{txtid}', 'SuccessController@avigher_payu_success');
Route::get('/blog', 'BlogController@avigher_index');

Route::get('/twocheckout-success/{transaction_id}', 'twocheckoutController@avigher_view_twocheckout');
Route::get('/razorpay-success/{razor_id}', 'RazorpayController@avigher_view_razorpay');
Route::get('/tag/{type}/{id}', 'TagController@avigher_tag');
Route::get('/logout', 'DashboardController@avigher_logout');
Route::get('/delete-account', 'DashboardController@avigher_deleteaccount');
Route::get('/wallet-balance/{cid}', 'SuccessController@avigher_wallet_view');
Route::get('/success/{cid}', 'SuccessController@avigher_showpage');
Route::get('/cancel', 'CancelController@avigher_showpage');
Route::get('/shop_success/{cid}', 'SuccessController@avigher_shop_success');
Auth::routes();
Route::get('/php-online-editor','PageController@php_editor');
Route::get('/about-us','PageController@avigher_about_us');
Route::get('/page/donate','PageController@avigher_donate_now');
Route::get('/page/{id}','PageController@avigher_viewpage');
Route::get('/support','PageController@avigher_support');
Route::get('/faq','PageController@avigher_faq');
Route::get('/terms-of-use','PageController@avigher_terms');
Route::get('/privacy-policy','PageController@avigher_privacy');
Route::get('/404','PageController@avigher_404');
Route::get('/forgot-password','ForgotpasswordController@avigher_forgot_view');
Route::get('/reset-password/{id}', 'ResetpasswordController@avigher_reset_view');
Route::get('/contact-us','PageController@avigher_contact');
Route::get('/add-item','ItemController@view_add_item');
Route::get('/my-items','ItemController@view_items');
Route::get('/edit-item/{token}','ItemController@view_edit_item');
Route::get('/edit-item/{delete}/{id}/{photo}', 'ItemController@avigher_delete_photo');
Route::get('/my-items/{token}','ItemController@delete_items');
Route::get('/my-items/duplicate/{token}','ItemController@duplicate_items');
Route::get('/all-items','IndexController@view_all_items');
Route::get('/free-items','IndexController@view_free_items');
Route::get('/my-earnings','EarningsController@view_earnings');
Route::get('/my-shopping','ItemController@view_shopping');
Route::get('/view-shopping-details/{ord_id}','ItemController@view_shopping_details');
Route::get('/view-shopping-details/{item_id}/{ord_id}','ItemController@view_download_details');
Route::get('/my-orders','ItemController@view_orders');
Route::get('/view-order-details/{ord_id}','ItemController@view_orders_details');


Route::get('/search','IndexController@view_search');
Route::get('/search/{list}','IndexController@view_list_search');
Route::get('/search/{search}/{text}','IndexController@view_search_text');
Route::get('/search/{search}/{tag}/{category}','IndexController@view_search_category');


Route::get('/featured/{token}','ItemController@view_featured');
Route::get('/feature_success/{token}','ItemController@featured_success');
Route::get('/featured-items','IndexController@view_all_featured_items');
Route::get('/free-item/{id}','ItemController@free_item');
Route::get('/item/{id}/{slug}/{like}','ItemController@view_like_item');
Route::get('/item/{id}/{slug}','IndexController@view_item')->name('view_item');
Route::get('/item/{val}', 'ItemController@get_support_price');
Route::get('/cart', 'ItemController@avigher_view_cart');
Route::get('/cart/{token}', 'ItemController@avigher_remove_cart');
Route::get('/checkout', 'ItemController@avigher_view_checkout');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/my-comments', 'DashboardController@mycomments');
Route::get('/my-comments/{id}', 'DashboardController@mycomments_destroy');

/* GET */

});


 


   

Route::group(['middleware' => ['admin','XSS']], function() {


    Route::get('/admin','Admin\DashboardController@index');
    Route::get('/admin/index','Admin\DashboardController@index');
	
	
	/* item */
	
	Route::get('/admin/add-item','Admin\ItemController@view_add_item');
	Route::post('/admin/add-item', ['as'=>'admin.add-item','uses'=>'Admin\ItemController@avigher_add_items']);
	
	Route::get('/admin/edit-item/{token}','Admin\ItemController@view_edit_item');
	Route::post('/admin/edit-item', ['as'=>'admin.edit-item','uses'=>'Admin\ItemController@avigher_edit_items']);
	Route::get('/admin/edit-item/{delete}/{id}/{photo}', 'Admin\ItemController@avigher_delete_photo');
	/* Item */
	
	
	
	
	
	/* user */

	Route::get('/admin/users','Admin\UsersController@index');
	Route::get('/admin/adduser','Admin\AdduserController@formview');
	Route::post('/admin/adduser', ['as'=>'admin.adduser','uses'=>'Admin\AdduserController@adduserdata']);
    
	Route::get('/admin/users/{id}','Admin\UsersController@destroy');
	Route::get('/admin/edituser/{id}','Admin\EdituserController@showform');
	Route::post('/admin/edituser', ['as'=>'admin.edituser','uses'=>'Admin\EdituserController@edituserdata']);
	Route::post('/admin/users', ['as'=>'admin.users','uses'=>'Admin\UsersController@delete_all']);


  

	/* end user */
	
	
	
	/* administrator */
	Route::get('/admin/administrators','Admin\UsersController@admin_index');
	Route::get('/admin/add_administrator','Admin\AdduserController@admin_formview');
	Route::post('/admin/add_administrator', ['as'=>'admin.add_administrator','uses'=>'Admin\AdduserController@adduserdata']);
    
	Route::get('/admin/administrators/{id}','Admin\UsersController@destroy');
	Route::get('/admin/administrators/{status}/{sid}/{id}','Admin\UsersController@status');
	
	Route::get('/admin/edit_administrator/{id}','Admin\EdituserController@admin_showform');
	Route::post('/admin/edit_administrator', ['as'=>'admin.edit_administrator','uses'=>'Admin\EdituserController@edituserdata']);
		
	/* end administrator */
	
	
	
	
	
	
	
	/* dispute refund */
	
	Route::get('/admin/refund','Admin\RefundController@index');
	Route::get('/admin/rating','Admin\RefundController@rating_index');
	Route::get('/admin/rating/{rate_id}','Admin\RefundController@rating_delete');
	/* end dispute refund */

	
	
	
	
	/* category */
	Route::get('/admin/category','Admin\CategoryController@index');
	Route::get('/admin/addcategory','Admin\AddcategoryController@formview');
	Route::post('/admin/addcategory', ['as'=>'admin.addcategory','uses'=>'Admin\AddcategoryController@addcategorydata']);
	Route::get('/admin/category/{id}','Admin\CategoryController@destroy');
	Route::get('/admin/editcategory/{id}','Admin\EditcategoryController@showform');
	Route::post('/admin/editcategory', ['as'=>'admin.editcategory','uses'=>'Admin\EditcategoryController@editcategorydata']);
	Route::post('/admin/category', ['as'=>'admin.category','uses'=>'Admin\CategoryController@delete_all']);
	/* end category */
	
	
	/* sub category */
	
	Route::get('/admin/subcategory','Admin\SubcategoryController@index');
	Route::get('/admin/addsubcategory','Admin\AddsubcategoryController@formview');
	Route::get('/admin/addsubcategory','Admin\AddsubcategoryController@getcategory');
	Route::post('/admin/addsubcategory', ['as'=>'admin.addsubcategory','uses'=>'Admin\AddsubcategoryController@addsubcategorydata']);
	Route::get('/admin/subcategory/{id}','Admin\SubcategoryController@destroy');
	
	
	
	Route::get('/admin/editsubcategory/{id}','Admin\EditsubcategoryController@edit');
	
	Route::post('/admin/editsubcategory', ['as'=>'admin.editsubcategory','uses'=>'Admin\EditsubcategoryController@editsubcategorydata']);
	Route::post('/admin/subcategory', ['as'=>'admin.subcategory','uses'=>'Admin\SubcategoryController@delete_all']);
	/* end sub category */
	
	
	
	
	
	
	/* framework category */
	Route::get('/admin/framework_category','Admin\FrameworkController@index');
	Route::get('/admin/add_framework_category','Admin\AddframeworkController@formview');
	Route::post('/admin/add_framework_category', ['as'=>'admin.add_framework_category','uses'=>'Admin\AddframeworkController@addcategorydata']);
	Route::get('/admin/framework_category/{id}','Admin\CategoryController@destroy');
	Route::get('/admin/edit_framework_category/{id}','Admin\EditframeworkController@showform');
	Route::post('/admin/edit_framework_category', ['as'=>'admin.edit_framework_category','uses'=>'Admin\EditframeworkController@editcategorydata']);
	Route::post('/admin/framework_category', ['as'=>'admin.framework_category','uses'=>'Admin\FrameworkController@delete_all']);
	/* end framework category */
	
	
	
	/* framework sub category */
	
	Route::get('/admin/framework_subcategory','Admin\SubframeworkController@index');
	Route::get('/admin/add_framework_subcategory','Admin\AddsubframeworkController@formview');
	Route::get('/admin/add_framework_subcategory','Admin\AddsubframeworkController@getcategory');
	Route::post('/admin/add_framework_subcategory', ['as'=>'admin.add_framework_subcategory','uses'=>'Admin\AddsubframeworkController@addsubcategorydata']);
	Route::get('/admin/framework_subcategory/{id}','Admin\SubframeworkController@destroy');
	
	
	
	Route::get('/admin/edit_framework_subcategory/{id}','Admin\EditsubframeworkController@edit');
	
	Route::post('/admin/edit_framework_subcategory', ['as'=>'admin.edit_framework_subcategory','uses'=>'Admin\EditsubframeworkController@editsubcategorydata']);
	Route::post('/admin/framework_subcategory', ['as'=>'admin.framework_subcategory','uses'=>'Admin\SubframeworkController@delete_all']);
	/* end sub category */
	
	
	
	
	
	
	
	/* Newletter */
	Route::get('/admin/newsletter','Admin\NewsletterController@index');
	Route::get('/admin/newsletter/{action}/{id}/{sid}','Admin\NewsletterController@status');
	Route::get('/admin/newsletter/{id}','Admin\NewsletterController@destroy');
	Route::get('/admin/sendupdates','Admin\AddnewsletterController@formview');
	Route::post('/admin/sendupdates', ['as'=>'admin.sendupdates','uses'=>'Admin\AddnewsletterController@addupdatedata']);
	Route::post('/admin/newsletter', ['as'=>'admin.newsletter','uses'=>'Admin\NewsletterController@delete_all']);
	
	/* End Newsletter */
	
	
	
	
	
	
	
	
	
	
	
	/* Blogs */
	
	Route::get('/admin/blog','Admin\BlogController@index');
	Route::get('/admin/add-blog','Admin\AddblogController@formview');
	Route::post('/admin/add-blog', ['as'=>'admin.add-blog','uses'=>'Admin\AddblogController@addblogdata']);
	Route::get('/admin/blog/{id}','Admin\BlogController@destroy');
	Route::get('/admin/edit-blog/{id}','Admin\EditblogController@showform');
	Route::post('/admin/edit-blog', ['as'=>'admin.edit-blog','uses'=>'Admin\EditblogController@blogdata']);
	Route::post('/admin/blog', ['as'=>'admin.blog','uses'=>'Admin\BlogController@delete_all']);
	
	Route::get('/admin/comment/{blog}/{comment}/{id}','Admin\BlogController@view_comment');
	Route::get('/admin/comment/{pid}/{sid}','Admin\BlogController@status_comment');
	Route::get('/admin/comment/{id}','Admin\BlogController@comment_destroy');
	/* end Blogs */
	
	
	
	
	
	
	
	/* withdraw */
	Route::get('/admin/withdraw','Admin\WithdrawController@avigher_withdraw');
	Route::get('/admin/withdraw/{id}','Admin\WithdrawController@avigher_pending_withdraw_data');
	Route::get('/admin/withdraw/{delete}/{id}','Admin\WithdrawController@avigher_delete_withdraw_data');
	/* withdraw */
	
	
	/* contact */
	Route::get('/admin/contact','Admin\PagesController@avigher_contact');
	Route::get('/admin/contact/{id}','Admin\PagesController@avigher_contact_delete');
	/* contact */
	
	
	/* report */
	Route::get('/admin/report','Admin\PagesController@avigher_report');
	Route::get('/admin/report/{id}','Admin\PagesController@avigher_report_delete');
	/* report */
	
	
	
	
	
	
	
	/* order details */
	Route::get('/admin/orders','Admin\OrdersController@index');
	Route::get('/admin/order_details/{ord_id}','Admin\OrdersController@view_orders');
	Route::get('/admin/orders/{ord_id}','Admin\OrdersController@payment_approval');
	Route::get('/admin/orders/{delete}/{ord_id}','Admin\OrdersController@order_delete');
	
	/* order details */
	
	
	
	/* product refund */
	
	Route::get('/admin/refund/{dispute_id}/{order_id}/{purchase_token}/{admin_commission}/{vendor_commission}','Admin\OrdersController@orders_refund');
	
	Route::get('/admin/refund/{dispute_id}/{order_id}/{purchase_token}/{buyer_amount}','Admin\OrdersController@orders_buyer_refund');
	
	Route::get('/admin/refund/{delete}/{dispute_id}','Admin\OrdersController@orders_dispute_delete');
	/* product refund */
	
	
	
	/* pages */
	
	Route::get('/admin/pages','Admin\PagesController@index');
	Route::get('/admin/edit-page/{id}','Admin\PagesController@showform');
	Route::post('/admin/edit-page', ['as'=>'admin.edit-page','uses'=>'Admin\PagesController@pagedata']);
	Route::post('/admin/pages', ['as'=>'admin.pages','uses'=>'Admin\PagesController@delete_all']);
	Route::get('/admin/pages/{id}','Admin\PagesController@deleted');
	
	Route::get('/admin/add-page','Admin\PagesController@formview');
	Route::post('/admin/add-page', ['as'=>'admin.add-page','uses'=>'Admin\PagesController@addpagedata']);
	/* end pages */
	
	
	
	/* currency */
	Route::get('/admin/currency','Admin\CurrencyController@index');
	Route::post('/admin/currency', ['as'=>'admin.currency','uses'=>'Admin\CurrencyController@delete_all']);
	Route::get('/admin/currency/{id}','Admin\CurrencyController@deleted');
	Route::get('/admin/edit-currency/{id}','Admin\CurrencyController@showform');
	Route::post('/admin/edit-currency', ['as'=>'admin.edit-currency','uses'=>'Admin\CurrencyController@pagedata']);
	Route::get('/admin/add-currency','Admin\CurrencyController@formview');
	Route::post('/admin/add-currency', ['as'=>'admin.add-currency','uses'=>'Admin\CurrencyController@addpagedata']);
	/* currency */
	
	
	
	
	/* country */
	Route::get('/admin/country','Admin\CountryController@index');
	Route::post('/admin/country', ['as'=>'admin.country','uses'=>'Admin\CountryController@delete_all']);
	Route::get('/admin/country/{id}','Admin\CountryController@deleted');
	Route::get('/admin/edit-country/{id}','Admin\CountryController@showform');
	Route::post('/admin/edit-country', ['as'=>'admin.edit-country','uses'=>'Admin\CountryController@pagedata']);
	Route::get('/admin/add-country','Admin\CountryController@formview');
	Route::post('/admin/add-country', ['as'=>'admin.add-country','uses'=>'Admin\CountryController@addpagedata']);
	/* country */
	
	
	
	
	/* promo boxes */
	
	
	Route::get('/admin/promo','Admin\PromoController@index');
	Route::post('/admin/promo', ['as'=>'admin.promo','uses'=>'Admin\PromoController@promodata']);
	
	/* promo boxes */
	
	
	
	
	
	
	/* products */
	
	Route::get('/admin/products','Admin\ProductsController@avigher_technologies_index');
	Route::post('/admin/products', ['as'=>'admin.products','uses'=>'Admin\ProductsController@delete_all']);
	Route::get('/admin/product_more/{token}','Admin\ProductsController@avigher_technologies_single');
	Route::get('/admin/products/{token}','Admin\ProductsController@deleted');
	
	Route::get('/admin/products/{token}/{sid}/{id}/{user_id}','Admin\ProductsController@status');
	
	Route::get('/admin/products/{token}/{f_status}','Admin\ProductsController@fstaus');
	
	/*Route::get('/admin/edit-page/{id}','Admin\PagesController@showform');
	Route::post('/admin/edit-page', ['as'=>'admin.edit-page','uses'=>'Admin\PagesController@pagedata']);
	Route::post('/admin/pages', ['as'=>'admin.pages','uses'=>'Admin\PagesController@delete_all']);
	Route::get('/admin/pages/{id}','Admin\PagesController@deleted');
	
	Route::get('/admin/add-page','Admin\PagesController@formview');
	Route::post('/admin/add-page', ['as'=>'admin.add-page','uses'=>'Admin\PagesController@addpagedata']);*/
	/* end products */
	
	
	
	
	
	
	/* start settings */
	
	
	Route::get('/admin/settings','Admin\SettingsController@showform');
	Route::post('/admin/settings', ['as'=>'admin.settings','uses'=>'Admin\SettingsController@editsettings']);
	
	/* end settings */
	
	
	/* media settings */
	
	Route::get('/admin/media-settings','Admin\MediasettingsController@showform');
	Route::post('/admin/media-settings', ['as'=>'admin.media-settings','uses'=>'Admin\MediasettingsController@editsettings']);
	
	Route::get('/admin/verify-purchase-code','Admin\VerifyController@showform');
	Route::post('/admin/verify-purchase-code', ['as'=>'admin.verify-purchase-code','uses'=>'Admin\VerifyController@settings']);
	
	
	/* end media settings */
	
	
	/* cookies settings */
	
	Route::get('/admin/cookies-settings','Admin\CookiesController@showform');
	Route::post('/admin/cookies-settings', ['as'=>'admin.cookies-settings','uses'=>'Admin\CookiesController@editsettings']);
	
	
	
	/* cookies settings */
	
	
	
	
	/* email settings */
	Route::get('/admin/email-settings','Admin\EmailsettingsController@showform');
	Route::post('/admin/email-settings', ['as'=>'admin.email-settings','uses'=>'Admin\EmailsettingsController@editsettings']);
	
	/* end email settings */
	
	
	
	/* badges settings */
	Route::get('/admin/badges-settings','Admin\BadgesettingsController@showform');
	Route::post('/admin/badges-settings', ['as'=>'admin.badges-settings','uses'=>'Admin\BadgesettingsController@editsettings']);
	
	/*  badges settings */
	
	
	
	
	/* payment settings */
	Route::post('/admin/payment-settings', ['as'=>'admin.payment-settings','uses'=>'Admin\PaymentsettingsController@editsettings']);
	Route::get('/admin/payment-settings','Admin\PaymentsettingsController@showform');
	
	/* end payment settings */
	
	
	
	
	
	/* color settings */
	
	Route::get('/admin/color-settings','Admin\ColorsettingsController@showform');
	Route::post('/admin/color-settings', ['as'=>'admin.color-settings','uses'=>'Admin\ColorsettingsController@editsettings']);
	
	/* end color settings */
	
	
	
	
	
	/* start language */
	
	
	Route::get('/admin/language','Admin\LanguageController@index');
	Route::get('/admin/add-language','Admin\AddlanguageController@formview');
	Route::get('/admin/language/{action}/{id}/{sid}','Admin\LanguageController@status');
	Route::post('/admin/add-language', ['as'=>'admin.add-language','uses'=>'Admin\AddlanguageController@addlanguagedata']);
	Route::get('/admin/language/{id}','Admin\LanguageController@destroy');
	Route::get('/admin/edit-language/{id}','Admin\EditlanguageController@showform');
	Route::post('/admin/edit-language', ['as'=>'admin.edit-language','uses'=>'Admin\EditlanguageController@languagedata']);
	Route::get('/admin/language/{id}/{sid}','Admin\LanguageController@asdefault');
	
	/* end language */
	
	
	/* translate */
	Route::get('/admin/translate','Admin\TranslateController@index');
	Route::get('/admin/addtranslate','Admin\AddtranslateController@formview');
	Route::post('/admin/addtranslate', ['as'=>'admin.addtranslate','uses'=>'Admin\AddtranslateController@addtranslatedata']);
	Route::get('/admin/edittranslate/{id}','Admin\EdittranslateController@showform');
	Route::post('/admin/edittranslate', ['as'=>'admin.edittranslate','uses'=>'Admin\EdittranslateController@edittranslatedata']);
	/* end translate */
	
	
	
	
   
});



/****************************
  Blog Controller

*****************************/
Route::get('/blog/{id}', 'BlogController@avigher_singlepost')->name('single_blog');
Route::get('/{user_slug}','IndexController@view_user');




