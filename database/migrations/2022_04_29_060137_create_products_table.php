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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->unsigned();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->string('name', 100);
            $table->string('description', 500)->default(null);
            $table->double('price', 10, 2)->default(0);
            $table->string('brand', 30)->nullable();
            $table->longText('tags')->nullable();
            $table->longText('features')->nullable();
            $table->double('rate_val', 10, 2)->nullable()->default(0);
            $table->integer('rate_count')->nullable()->default(0);
            $table->integer('sale_counts')->unsigned()->default(0);
            $table->integer('view_counts')->unsigned()->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
