<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('status')->default(0)->after('remember_token');
            $table->string('api_token', 255)->nullable()->after('remember_token');
            $table->unsignedBigInteger('role_id')->default(1)->after('remember_token');
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
            $table->string('first_name')->nullable()->after('remember_token');
            $table->string('last_name')->nullable()->after('remember_token');
            $table->softDeletes()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn($table->softDeletes());
            $table->dropColumn('last_name');
            $table->dropColumn('first_name');
            $table->dropColumn('api_token');
            $table->dropColumn('role_id');
            $table->dropColumn('status');
        });
    }
}
