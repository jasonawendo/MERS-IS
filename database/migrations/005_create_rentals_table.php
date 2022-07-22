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
        Schema::create('rentals', function (Blueprint $table) {
        $table->id('rentalID');
        $table->unsignedBigInteger('equipmentID');
        $table->foreign('equipmentID')->references('equipmentID')->on('equipmentlistings');
        $table->unsignedBigInteger('customerID');
        $table->foreign('customerID')->references('id')->on('users');
        $table->unsignedBigInteger('orderID')->nullable();
        $table->foreign('orderID')->references('orderID')->on('orders');

        // $table->foreignId('equipmentID')->constrained('equipmentlistings');
        // $table->foreignId('userID')->constrained('users');
        // $table->foreignId('orderID')->nullable()->constrained('orders');
		$table->integer('quantity');
		$table->datetime('dateTimeStart');
		$table->datetime('dateTimeEnd');
        $table->double('totalPrice');
		$table->string('insurance');
		$table->enum('inspectionStatus',['accepted','pending','rejected'])->default('pending');
		$table->enum('ownerStatus',['accepted','pending','rejected'])->default('pending');
        $table->timestamp('created_at')->useCurrent();
        $$table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
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
        Schema::dropIfExists('rentals');
    }
};
