<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSubcatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_subcats', function (Blueprint $table) {
            $table->bigIncrements('subid');
            $table->string('subcat_name');
            $table->string('post_slug');
            $table->string('cat_id');
            $table->string('subimage')->nullable()->default('');
            $table->string('subcat_type');
            $table->string('delete_status')->nullable()->default('');
            $table->string('token')->nullable()->default('');
            $table->string('lang_code');
            $table->string('parent');
            $table->string('status');
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
        Schema::dropIfExists('product_subcats');
    }
}
