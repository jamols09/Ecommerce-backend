<?php

use App\Models\Brand;
use App\Models\Department;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Department::class);
            $table->foreignIdFor(Brand::class);
            $table->boolean('is_discountable');
            $table->string('name');
            $table->string('description', 3000);
            $table->string('color');
            $table->string('size');
            $table->string('material');
            $table->string('weight_unit');
            $table->integer('weight_amount');
            $table->string('dimension_unit');
            $table->integer('length');
            $table->integer('width');
            $table->integer('height');
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
        Schema::dropIfExists('items');
    }
}
