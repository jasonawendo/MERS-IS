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
        Schema::create('inspectionjobs', function (Blueprint $table) {
        $table->id('IJID');
        $table->unsignedBigInteger('inspectorID');
        $table->foreign('inspectorID')->references('id')->on('users');
		$table->datetime('dateTimeInspection');
		$table->string('address',50);
        $table->boolean('isCompleted')->default('0');
        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
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
        Schema::dropIfExists('inspectionjobs');
    }
};
