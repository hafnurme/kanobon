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
        Schema::create('logs', function (Blueprint $table) {
            $table->id('id');
            $table->uuid('user_id')->nullable()->default('0');
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('set null')->onUpdate('cascade');
            $table->datetime('datetime');
            $table->string('activity', 50);
            $table->string('detail', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
};
