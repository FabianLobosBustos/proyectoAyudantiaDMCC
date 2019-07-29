<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssistantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('lastNameMom');
            $table->string('lastNameDad');
            $table->integer('level');
            $table->integer('fone');
            $table->integer('rut');
            $table->string('verificatorDigit');
            $table->string('address');
            $table->string('email');
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
        Schema::dropIfExists('assistant');
    }
}
