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
        Schema::create('rrowners', function (Blueprint $table) {
        $table->id('ORID');
        $table->unsignedBigInteger('customerID');
        $table->foreign('customerID')->references('id')->on('users');
        $table->unsignedBigInteger('ownerID');
        $table->foreign('ownerID')->references('id')->on('users');//->onDelete('cascade');
        $table->unsignedBigInteger('rentalID');
        $table->foreign('rentalID')->references('rentalID')->on('rentals');
        // $table->foreignId('customerID')->constrained('users');
        // $table->foreignId('ownerID')->constrained('users');
        // $table->foreignId('rentalID')->constrained('rentals');
		$table->integer('rating');
		$table->text('review');
        $table->timestamp('created_at')->useCurrent();
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
        Schema::dropIfExists('rrowners');
    }
};
