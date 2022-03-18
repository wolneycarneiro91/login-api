<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('acesso_grupos', function (Blueprint $table) {
            $table->id();
            $table->integer('acesso_id');
            $table->integer('grupo_id');
            $table->foreign('grupo_id')->references('id')->on('grupos');
            $table->foreign('acesso_id')->references('id')->on('acessos');  
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('acesso_grupos');
    }
};
