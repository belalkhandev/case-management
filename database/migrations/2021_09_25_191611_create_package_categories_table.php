<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_id');
            $table->string('name');
            $table->double('price', 8, 2);
            $table->double('discount', 8, 2)->default(0);
            $table->double('discount_price', 8, 2)->default(0);
            $table->integer('validity')->nullable()->comment('30, 180, 365');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_categories');
    }
}
