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
        Schema::create('response', function (Blueprint $table) {
            $table->id();
            $table->string('text_respone');
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->bigInteger('survey_id')->unsigned()->index()->nullable();
            $table->bigInteger('question_id')->unsigned()->index()->nullable();
            $table->bigInteger('option_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); //Foreign Key
            $table->foreign('survey_id')->references('id')->on('survey')->onDelete('cascade'); //Foreign Key
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade'); //Foreign Key
            $table->foreign('option_id')->references('id')->on('option')->onDelete('cascade'); //Foreign Key
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
        Schema::dropIfExists('response');
    }
};
