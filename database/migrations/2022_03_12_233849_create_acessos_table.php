<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('acessos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('sistema_id');
            $table->unique(['user_id', 'sistema_id']);
            $table->foreign('sistema_id')->references('id')->on('sistemas');
            $table->foreign('user_id')->references('id')->on('users');
            $table->softDeletes();  
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('acessos');
    }
};
