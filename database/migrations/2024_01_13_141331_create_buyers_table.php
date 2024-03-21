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
        Schema::create('buyers', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->integer('postal');
            $table->text('prefecture');
            $table->text('address');
            $table->text('email');
            $table->integer('phone');
            $table->text('remark');
            $table->text('created_by');
            $table->text('updated_by');
            $table->integer('count');
            $table->timestamp('deleted_at')->useCurrent()->nullable();
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
        Schema::dropIfExists('buyers');
    }
};
