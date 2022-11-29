<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_discounts', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->foreign('product_id', 'product_id_fk_1001484')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedInteger('qty');                  
            $table->decimal('special_price', 8, 2)->nullable();
            $table->integer('combo_product_id')->nullable();
            $table->boolean('status')->default(1);  
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
        Schema::dropIfExists('product_discounts');
    }
}
