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
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("id_menu");
            $table->foreign("id_menu")->references("id")->on("menus")->cascadeOnDelete();

            $table->unsignedBigInteger('id_type_item');
            $table->foreign("id_type_item")->references("id")->on("type_item")->cascadeOnDelete();

            $table->unsignedBigInteger('id_sale')->nullable();
            $table->foreign('id_sale')->references('id')->on("sales");

            $table->string('name');
            $table->string('description');
            $table->string('img_item');
            $table->float('unit_price');

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
        Schema::dropIfExists('items');
    }
};
