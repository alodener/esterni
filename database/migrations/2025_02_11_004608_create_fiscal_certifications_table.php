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
        Schema::create('fiscal_certifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_provider_id')->constrained()->onDelete('cascade');
            $table->string('federal_tax_certification')->nullable(); // Certidão de Regularidade de Tributos Federais
            $table->string('state_tax_certification')->nullable(); // Certidão de Regularidade de Tributos Estaduais
            $table->string('municipal_tax_certification')->nullable(); // Certidão de Regularidade de Tributos Municipais
            $table->string('cnd_federal_debt')->nullable(); // CND - Certidão Negativa de Débitos Relativos aos Tributos Federais e à Dívida Ativa da União
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
        Schema::dropIfExists('fiscal_certifications');
    }
};
