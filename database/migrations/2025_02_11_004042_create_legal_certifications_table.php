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
        Schema::create('legal_certifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_provider_id')->constrained()->onDelete('cascade');
            $table->string('cnpj_card')->nullable(); // Cartão de CNPJ
            $table->string('incorporation_act')->nullable(); // Ato Constitutivo, Estatuto ou Contrato Social
            $table->string('partners_identification')->nullable(); // RG, CPF dos Sócios e Administradores
            $table->string('operating_license')->nullable(); // Alvará de Funcionamento
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
        Schema::dropIfExists('legal_certifications');
    }
};
