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
        Schema::create('breaches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hash');
            $table->bigInteger('times_pwnd')->default(0);
            $table->timestamp('created_at');
            $table->timestamp('last_check')->nullable();
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('breaches');
    }
};
