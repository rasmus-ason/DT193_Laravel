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
        Schema::create('amount_change_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('article_number');
            $table->integer('old_amount');
            $table->integer('new_amount');
            $table->integer('modified_with');
            $table->integer('product_id');
            //$table->bigInteger('product_id')->unsigned();
            //Addera eventuell modified_by_user
            $table->timestamps();
            //$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amount_change_logs');
    }
};
