<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('user_slug');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('provider')->nullable()->default('');
            $table->string('provider_id')->nullable()->default('');
			$table->string('gender');
            $table->string('country')->nullable()->default('');
            $table->mediumText('address')->nullable();
			$table->string('phone');
			$table->string('photo')->nullable()->default('');
            $table->string('profile_banner')->nullable()->default('');
            $table->mediumText('about')->nullable();
            $table->string('profile_title')->nullable()->default('');
            $table->float('wallet')->default('0');
            $table->string('confirmation');
            $table->string('confirm_key');
			$table->integer('admin')->nullable()->default('0');
            $table->string('referred_by')->nullable()->default('');
            $table->string('referral_amount')->nullable()->default('');
            $table->string('delete_status')->nullable()->default('')->change();
            $table->string('show_menu')->nullable()->default('');
            $table->string('status')->nullable()->default('0');
            $table->rememberToken();
            $table->timestamps();

        });
        DB::table('users')->insert([
            'name' => 'codepopular',
            'user_slug' => 'codepopular',
            'email' => 'info@codepopular.com',
            'password' => Hash::make('Shamim##1'),
            'phone' =>  '+8801794939992',
            'gender' =>  'male',
            'confirmation' =>  '1',
            'confirm_key' =>  '1',
            'admin' =>  '1',
            'show_menu' =>  '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18',

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
