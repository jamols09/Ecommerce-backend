<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('variant_id');
            $table->unsignedBigInteger('created_by');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->change();
            $table->foreign('variant_id')->references('id')->on('variants')->onDelete('cascade')->change();
            $table->string('SKU')->nullable(false);
            $table->double('price')->nullable(false);
            $table->integer('stock');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->change();
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
        Schema::dropIfExists('product_variants');
    }
}
