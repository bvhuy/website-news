<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTblNewCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_new_category', function (Blueprint $table) {
            $table->foreign('new_id')->references('id')->on('tbl_new')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('tbl_type')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('tbl_category')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_new_category', function (Blueprint $table) {
            //
        });
    }
}
