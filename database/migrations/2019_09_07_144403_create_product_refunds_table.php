<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_refunds', function (Blueprint $table) {
            $table->bigIncrements('dispute_id');
            $table->integer('purchase_token');
            $table->date('request_date');
            $table->integer('order_id');
            $table->integer('item_id');
            $table->date('payment_date');
            $table->integer('buyer_id');
            $table->integer('vendor_id');
            $table->float('payment');
            $table->string('payment_type');
            $table->string('subject');
            $table->string('message');
            $table->string('delete_status');
            $table->string('dispute_status');
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
        Schema::dropIfExists('product_refunds');
    }
}
