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
        Schema::create('turma_salas', function (Blueprint $table) {
        $table->id();

        $table->unsignedBigInteger('turma_id');
        $table->unsignedBigInteger('sala_id');

        $table->boolean('seg')->default(false);
        $table->boolean('ter')->default(false);
        $table->boolean('quar')->default(false);
        $table->boolean('quin')->default(false);
        $table->boolean('sex')->default(false);


        $table->string('professor', 100)->nullable();
        $table->string('materia', 100)->nullable();
        $table->timestamps();

        $table->foreign('turma_id')->references('id')->on('turmas')->onDelete('cascade');
        $table->foreign('sala_id')->references('id')->on('salas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TurmaSala');
    }
};
