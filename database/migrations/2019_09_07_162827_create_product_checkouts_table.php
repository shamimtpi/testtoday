<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_checkouts', function (Blueprint $table) {
            $table->bigIncrements('cid');
            $table->string('purchase_token');
            $table->string('token');
            $table->string('ord_id');
            $table->string('item_prices');
            $table->string('item_user_id');
            $table->integer('user_id');
            $table->integer('total');
            $table->float('vendor_amount');
            $table->float('admin_amount');
            $table->string('payment_type');
            $table->string('payment_token')->default('');
            $table->date('payment_date');
            $table->integer('payment_approval')->default('0');
            $table->string('bill_firstname');
            $table->string('bill_lastname');
            $table->string('bill_companyname');
            $table->string('bill_email');
            $table->string('bill_phone');
            $table->string('bill_country');
            $table->string('bill_address');
            $table->string('bill_city');
            $table->string('bill_state');
            $table->string('bill_postcode');
            $table->string('enable_ship')->nullable();
            $table->string('ship_firstname');
            $table->string('ship_lastname');
            $table->string('ship_companyname');
            $table->string('ship_email');
            $table->string('ship_phone');
            $table->string('ship_country');
            $table->mediumText('ship_address');
            $table->string('ship_city');
            $table->string('ship_state');
            $table->string('ship_postcode');
            $table->mediumText('other_notes');
            $table->string('payment_status');
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
        Schema::dropIfExists('product_checkouts');
    }
}
