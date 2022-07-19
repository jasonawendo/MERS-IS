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
        Schema::create('orders', function (Blueprint $table) {
        $table->id('orderID');
        $table->unsignedBigInteger('customerID');
        $table->foreign('customerID')->references('id')->on('users');
        $table->double('amount');
		$table->enum('paymentMethod',['Mpesa','Visa'])->default('Mpesa');
		$table->boolean('paymentStatus')->default('0');
		$table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
