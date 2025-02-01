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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('street'); // Logradouro
            $table->string('number')->nullable(); // Número
            $table->string('complement')->nullable(); // Complemento
            $table->string('district'); // Bairro
            $table->string('city'); // Cidade
            $table->string('state'); // Estado
            $table->string('zip_code'); // CEP
            $table->string('country'); // País


            // Polimorfismo
            $table->morphs('addressable');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
