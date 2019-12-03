<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodepopularLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codepopular_langs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lang_name');
            $table->string('lang_code');
            $table->string('lang_flag');
            $table->integer('lang_default')->default(1);
            $table->integer('lang_status');
            $table->timestamps();
        });
         DB::table('codepopular_langs')->insert([
            'lang_name' => 'English',
            'lang_code' => 'en',
            'lang_flag' => '1546674637.png',
            'lang_default' => '1',
            'lang_status' => '1'

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codepopular_langs');
    }
}
