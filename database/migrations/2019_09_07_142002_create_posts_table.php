<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('post_id');
            $table->string('post_title');
            $table->string('post_slug');
            $table->longText('post_desc');
            $table->longText('post_tags');
            $table->string('post_type');
            $table->integer('post_seat_space')->default('0');;
            $table->integer('post_parent')->default('0');;
            $table->string('post_comment_type')->default('');;
            $table->string('post_media_type');
            $table->string('post_image');
            $table->datetime('post_start_date')->nullable();
            $table->datetime('post_end_date')->nullable();
            $table->string('post_location')->default('');;
            $table->string('post_phone')->default('');;
            $table->string('post_website')->default('');;
            $table->string('post_email')->default('');;
            $table->integer('post_user_id')->default('0');
            $table->string('post_audio');
            $table->string('post_video');
            $table->datetime('post_date');
            $table->string('post_staff_type')->default('');;
            $table->string('post_facebook')->default('');;
            $table->string('post_twitter')->default('');;
            $table->string('post_gplus')->default('');;
            $table->string('post_youtube')->default('');;
            $table->string('token');
            $table->string('lang_code');
            $table->integer('parent')->default('0');
            $table->string('post_status');
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
        Schema::dropIfExists('posts');
    }
}
