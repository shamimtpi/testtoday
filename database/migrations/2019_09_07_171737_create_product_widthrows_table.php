<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductWidthrowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_widthrows', function (Blueprint $table) {
            $table->bigIncrements('wid');
            $table->integer('user_id');
            $table->string('withdraw_amount');
            $table->string('withdraw_payment_type');
            $table->string('paypal_id');
            $table->string('stripe_id');
            $table->string('bank_account_no');
            $table->string('bank_info');
            $table->string('bank_ifsc');
            $table->string('paytm_no');
            $table->string('perfectmoney_id');
            $table->string('withdraw_status');
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
        Schema::dropIfExists('product_widthrows');
    }
}
