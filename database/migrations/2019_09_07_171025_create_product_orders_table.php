<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->bigIncrements('ord_id');
            $table->integer('user_id');
            $table->integer('item_id');
            $table->string('item_name')->default('');
            $table->integer('item_user_id');
            $table->string('item_token');
            $table->string('purchase_token')->default('');
            $table->string('purchase_code');
            $table->string('payment_token')->default('');
            $table->string('payment_type')->default('');
            $table->string('licence_type');
            $table->date('license_start_date')->nullable();
            $table->date('license_end_date')->nullable();
            $table->integer('downloaded_count')->default('0');
            $table->float('price');
            $table->float('vendor_amount')->default('0');
            $table->float('admin_amount')->default('0');
            $table->float('total');
            $table->string('status');
            $table->string('delete_status')->default('');
            $table->string('approval_status')->default('');
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
        Schema::dropIfExists('product_orders');
    }
}
