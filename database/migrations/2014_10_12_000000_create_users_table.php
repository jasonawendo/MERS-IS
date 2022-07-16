<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->id('id');
            $table->string('nationalid');
            $table->string('fname');
            $table->string('lname');
            $table->string('mobilenumber')->unique();
            $table->string('email')->unique();
            $table->string('krapin')->unique();
            $table->string('address');
            $table->string('linkedin')->unique();
            $table->enum('role',['admin','qualityinspector','equipmentowner','customer'])->default('customer');
            $table->enum('usertype',['individual','organization'])->default('individual');
            $table->string('companyname')->nullable();
            $table->string('websitelink')->nullable();
            $table->string('profilepic')->nullable();
            $table->longText('bio')->nullable();


            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
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
        Schema::dropIfExists('users');
    }
};
