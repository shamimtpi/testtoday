<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_comments', function (Blueprint $table) {
            $table->bigIncrements('comm_id');
            $table->integer('item_id');
            $table->string('item_token');
            $table->integer('comm_user_id');
            $table->integer('item_user_id');
            $table->mediumText('comm_text');
            $table->datetime('comm_date');
            $table->string('comm_group_id');
            $table->integer('comm_parent');
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
        Schema::dropIfExists('product_comments');
    }
}
