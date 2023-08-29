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
        Schema::create('items_purchases', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_item');
            $table->foreign('id_item')->references('id')->on('items');

            $table->unsignedBigInteger('id_purchase');
            $table
                ->foreign('id_purchase')
                ->references('id')
                ->on('purchases')
                ->cascadeOnDelete();

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
        Schema::dropIfExists('item_purchase');
    }
};
