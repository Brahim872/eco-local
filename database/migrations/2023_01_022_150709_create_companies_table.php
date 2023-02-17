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
        Schema::create('bs_companies', function (Blueprint $table) {

            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name');
            $table->string('address')->nullable();
//            $table->string('email');
//            $table->string('password');
//            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('profile')->nullable();
            $table->string('slug'); // Field name same as your `saveSlugsTo`
            $table->timestamp('deactivated_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bs_companies');
    }
};
