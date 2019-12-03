<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
           $table->bigIncrements('id');
            $table->string('site_name');
            $table->longText('site_desc');
            $table->longText('site_keyword');
            $table->longText('site_address');
            $table->string('site_phone');
            $table->string('site_email');
            $table->string('site_layout');
            $table->string('site_facebook');
            $table->string('site_twitter');
            $table->string('site_gplus');
            $table->string('site_pinterest');
            $table->string('site_instagram');
            $table->string('site_currency');
            $table->string('site_logo');
            $table->string('site_favicon');
            $table->string('site_banner');
            $table->longText('site_banner_heading');
            $table->longText('site_banner_subheading');
            $table->string('header_type');
            $table->string('site_copyright');
            $table->integer('site_post_per');
            $table->integer('site_comment_per');
            $table->integer('site_latest_item');
            $table->integer('site_latest_item_count');
            $table->string('paypal_id');
            $table->string('paypal_url');
            $table->string('site_map_api');
            $table->string('site_url');
            $table->integer('image_size');
            $table->integer('video_size');
            $table->string('image_type');
            $table->integer('mp3_size');
            $table->integer('zip_size');
            $table->integer('site_loading');
            $table->string('site_loading_url');
            $table->string('site_primary_color');
            $table->string('site_secondary_color');
            $table->string('site_button_color');
            $table->string('site_link_color');
            $table->integer('with_submit_product');
            $table->string('payment_option');
            $table->string('withdraw_option');
            $table->string('stripe_mode');
            $table->string('test_publish_key');
            $table->string('test_secret_key');
            $table->string('live_publish_key');
            $table->string('live_secret_key');
            $table->string('commission_mode');
            $table->float('commission_amt');
            $table->float('withdraw_amt');
            $table->float('processing_fee');
            $table->float('featured_price');
            $table->integer('featured_days');
            $table->integer('min_price_range');
            $table->integer('max_price_range');
            $table->string('promo_icon_1');
            $table->string('promo_title_1');
            $table->string('promo_desc_1');
            $table->string('promo_icon_2');
            $table->string('promo_title_2');
            $table->string('promo_desc_2');
            $table->string('promo_icon_3');
            $table->string('promo_title_3');
            $table->string('promo_desc_3');
            $table->string('promo_icon_4');
            $table->string('promo_title_4');
            $table->string('promo_desc_4');
            $table->string('site_footer_newsletter');
            $table->string('site_blog_visible');
            $table->string('site_blog_per');
            $table->string('refund_time_limit');
            $table->timestamps();
        });
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
