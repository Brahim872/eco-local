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
        Schema::create('bs_products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->nullable();
            $table->text('description')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

        });


        Schema::create('bs_products_clients', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->dateTime('deactivated_at')->nullable();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('bs_clients')
                ->onDelete('cascade');

            $table->foreign('product_id')->references('id')->on('bs_products')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bs_products');
        Schema::dropIfExists('bs_products_clients');
    }
};
