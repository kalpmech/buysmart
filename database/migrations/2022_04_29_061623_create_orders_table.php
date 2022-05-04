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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('seller_id')->unsigned()->nullable();
            $table->string('status');
            $table->enum('type', ['cart', 'wishlist', 'order', 'later', 'freeproduct']);
            $table->longText('description')->nullable();
            $table->dateTime('end_date')->nullable(); //cancelled or paid
            $table->integer('rate')->nullable();
            $table->string('rate_comment')->nullable();
            $table->boolean('rate_mail_sent')->default(false);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
