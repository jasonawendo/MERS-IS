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
            $table->string('nationalID')->unique();
            $table->string('fname');
            $table->string('lname');
            $table->string('mobilenumber')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('krapin')->unique();
            $table->string('address');
            $table->string('linkedin')->nullable();
            $table->enum('role',['Admin','Quality Inspector','Equipment Owner','Customer'])->default('Customer');
            $table->enum('usertype',['individual','organization'])->default('individual');
            $table->string('companyname')->nullable();
            $table->string('websitelink')->nullable();
            $table->string('profilepic')->nullable();
            $table->longText('bio')->nullable();
            $table->integer('averageRating')->default(4);
            $table->enum('status',['accepted','pending','rejected'])->default('pending');

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->boolean('isDeleted')->default('0');
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
