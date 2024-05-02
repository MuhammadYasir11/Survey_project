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
        Schema::table('option',function (blueprint $table)
        {
            $table->integer('min')->nullable()->after('question_id');
            $table->integer('max')->nullable()->after('min');;
            $table->integer('mid')->nullable()->after('max');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('option', function (Blueprint $table) {
            $table->dropColumn('min');
            $table->dropColumn('max');
            $table->dropColumn('mid');
        });
    }
};
