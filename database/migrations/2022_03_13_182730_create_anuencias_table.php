<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('anuencias', function (Blueprint $table) {
            $table->id();
            $table->integer('acesso_grupo_id');
            $table->integer('action_id');
            $table->integer('grupo_modulo_id');
            $table->foreign('acesso_grupo_id')->references('id')->on('acesso_grupos');
            $table->foreign('grupo_modulo_id')->references('id')->on('grupo_modulos');          
            $table->foreign('action_id')->references('id')->on('actions');
            $table->softDeletes();              
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anuencias');
    }
};
