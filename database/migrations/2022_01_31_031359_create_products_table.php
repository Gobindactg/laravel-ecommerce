<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->unsigned();;
            $table->integer('brand_id')->unsigned();;
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('slug')->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('price')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('publish_category')->nullable();
            $table->integer('offer_price')->nullable();
            $table->integer('admin_id')->nullable();
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
        Schema::dropIfExists('products');
    }
}
