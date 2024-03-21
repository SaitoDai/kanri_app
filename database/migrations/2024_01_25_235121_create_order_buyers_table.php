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
        Schema::create('order_buyers', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->integer('postal');
            $table->text('prefecture');
            $table->text('address');
            $table->text('email');
            $table->integer('phone');
            $table->text('remark');
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('order_detail_buyers');
    }
};
