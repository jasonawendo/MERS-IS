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
        Schema::create('equipmentlistings', function (Blueprint $table) {
            $table->id('equipmentID');
            $table->unsignedBigInteger('ownerID');
            $table->foreign('ownerID')->references('id')->on('users');//->onDelete('cascade');
            $table->string('equipmentName',20);
		    $table->text('equipmentDescription');
            $table->string('equipmentImage',50);
		    $table->double('rentRate');
		    $table->string('address',20);
            $table->enum('status',['accepted','pending','rejected'])->default('pending');
            $table->boolean('equipmentAvailability')->default('1');
            $table->double('equipmentValue')->nullable();
            $table->enum('equipmentCondition',['Bad','Moderate','Good'])->nullable();
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
        Schema::dropIfExists('equipmentlistings');
    }
};
