<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->date('join_date')->default(Carbon::now());
            $table->date('date_of_birth')->nullable();
            $table->longText('address')->nullable();
            $table->bigInteger('zip_code')->nullable();
            $table->integer('status')->default(1);
            $table->integer('is_terms_accepted')->nullable();
            $table->string('avatar')->nullable();
            $table->string('user_type')->default('customer');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
