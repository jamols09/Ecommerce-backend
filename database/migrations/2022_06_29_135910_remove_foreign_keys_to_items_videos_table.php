<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveForeignKeysToItemsVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items_videos', function (Blueprint $table) {
            $table->dropForeign('items_videos_items_id_foreign');
            $table->dropColumn('items_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items_videos', function (Blueprint $table) {
            $table->unsignedBigInteger('items_id');
            $table->foreign('items_id')->references('id')->on('items')->onDelete('cascade');
        });
    }
}
