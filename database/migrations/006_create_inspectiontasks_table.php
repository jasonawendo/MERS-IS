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
        Schema::create('inspectiontasks', function (Blueprint $table) {
        $table->id('ITID');
        $table->unsignedBigInteger('IJID')->nullable();
        $table->foreign('IJID')->references('IJID')->on('inspectionjobs');

        // $table->foreignId('IJID')->nullable()->constrained('inspectionjobs');
		$table->string('taskDescription',50);
		$table->string('address',60);
        $table->unsignedBigInteger('equipmentID')->nullable();
        $table->foreign('equipmentID')->references('equipmentID')->on('equipmentlistings');
        $table->unsignedBigInteger('rentalID')->nullable();
        $table->foreign('rentalID')->references('rentalID')->on('rentals');
        // $table->foreignId('equipmentID')->nullable()->constrained('equipmentlistings');
        // $table->foreignId('rentalID')->nullable()->constrained('rentals');
        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->nullable();
        $table->boolean('isCompleted')->default('0');
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
        Schema::dropIfExists('inspectiontasks');
    }
};
