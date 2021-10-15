<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_user', function (Blueprint $table) {
            $table->unsignedBigInteger('subscription_id')->unsigned();
            $table->unsignedBigInteger('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['subscription_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_user');
    }
}
