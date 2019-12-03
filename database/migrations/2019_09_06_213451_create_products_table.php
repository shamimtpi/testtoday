<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('item_id');
            $table->string('item_token');
            $table->integer('user_id');
            $table->string('item_title');
            $table->string('item_slug');
            $table->mediumText('item_short_desc');
            $table->longText('item_desc');
            $table->float('regular_price_six_month');
            $table->float('regular_price_one_year');
            $table->float('extended_price_six_month');
            $table->float('extended_price_one_year');
            $table->string('high_resolution');
            $table->string('compatible_browser');
            $table->string('file_included');
            $table->string('demo_url')->nullable();
            $table->string('support_item');
            $table->string('future_update');
            $table->string('unlimited_download')->nullable();
            $table->string('category');
            $table->string('framework_category');
            $table->date('first_update');
            $table->date('last_update');
            $table->integer('sales')->default(0);
            $table->string('item_thumbnail');
            $table->string('preview_image');
            $table->string('main_file');
            $table->longText('item_tags')->nullable();
            $table->integer('item_featured')->default('0');
            $table->date('featured_startdate')->nullable();
            $table->date('featured_enddate')->nullable();
            $table->integer('featured_days')->default('0');
            $table->float('featured_price')->default('0');
            $table->string('featured_payment_type')->default('');
            $table->string('featured_payment_status')->default('');
            $table->string('featured_payment_key')->default('');
            $table->integer('downloaded')->default('0');
            $table->string('item_type');
            $table->string('item_script_type');
            $table->string('item_layered');
            $table->string('graphics_files')->default('');
            $table->string('adobe_cs_version');
            $table->string('pixel_dimensions');
            $table->string('print_dimensions');
            $table->integer('liked')->default('0');
            $table->string('delete_status')->default('');
            $table->string('token');
            $table->string('lang_code');
            $table->integer('parent');
            $table->integer('view_count')->default(0);
            $table->integer('item_status');
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
        Schema::dropIfExists('products');
    }
}
