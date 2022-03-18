<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('grupo_modulos', function (Blueprint $table) {
            $table->id();
            $table->integer('grupo_id');
            $table->integer('modulo_id');
            $table->unique(['modulo_id', 'grupo_id']);
            $table->foreign('grupo_id')->references('id')->on('grupos');
            $table->foreign('modulo_id')->references('id')->on('modulos');           
            $table->softDeletes();  
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('grupo_modulos');
    }
};
