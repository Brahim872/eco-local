<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {

            $table->id();
            $table->bigInteger('company_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('content')->nullable();
            $table->string('email');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('bs_companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
};
