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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description');
            $table->string('telephone');
            $table->string('img_restaurant')->nullable();

            $table->unsignedBigInteger('id_gastronomy');
            $table->foreign('id_gastronomy')->references('id')->on('gastronomies');

            $table->unsignedBigInteger('id_restaurant_type');
            $table->foreign('id_restaurant_type')->references('id')->on('restaurant_type');

            $table->unsignedBigInteger('id_owner');
            $table->foreign('id_owner')->references('id')->on('users');

            $table->unsignedBigInteger('id_address');
            $table->foreign('id_address')->references('id')->on('addresses');

            $table->unsignedBigInteger("id_location");
            $table->foreign("id_location")->references("id")->on("locations");

            $table->unsignedBigInteger("id_cupon");
            $table->foreign("id_cupon")->references("id")->on("cupons");

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
        Schema::dropIfExists('restaurants');
    }
};
