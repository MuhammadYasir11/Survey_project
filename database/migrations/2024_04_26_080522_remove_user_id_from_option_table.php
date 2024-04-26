<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       // Drop foreign key constraint
       Schema::table('option', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
    });

    // Drop the user_id column
    Schema::table('option', function (Blueprint $table) {
        $table->dropColumn('user_id');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       // Add back the user_id column
       Schema::table('option', function (Blueprint $table) {
        $table->bigInteger('user_id')->unsigned()->index()->nullable()->after('question_id');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
    }
};
