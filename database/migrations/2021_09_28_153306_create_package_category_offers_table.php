<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageCategoryOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_category_offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_category_id');
            $table->string('name')->nullable();
            $table->double('regular_price', 8, 2);
            $table->double('discount', 8, 2);
            $table->double('discount_price', 8, 2);
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->foreign('package_category_id')->references('id')->on('package_categories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('package_category_offers');
    }
}
