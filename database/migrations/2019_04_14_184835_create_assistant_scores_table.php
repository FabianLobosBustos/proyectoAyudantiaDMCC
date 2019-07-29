<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssistantScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistant_scores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('score');
            $table->bigInteger('postulation_id')->unsigned();
            $table->foreign('postulation_id')->references('id')->on('postulations');
            $table->bigInteger('assistant_id')->unsigned();
            $table->foreign('assistant_id')->references('id')->on('assistants');
            $table->bigInteger('subject_id')->unsigned();
            $table->foreign('subject_id')->references('id')->on('subjects');
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
        Schema::dropIfExists('assistant_scores');
    }
}
