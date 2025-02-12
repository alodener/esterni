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
        Schema::create('economic_certifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_provider_id')->constrained()->onDelete('cascade');
            $table->date('contract_start_end')->nullable(); // Início/Fim do Contrato
            $table->string('company_size')->nullable(); // Porte
            $table->string('calculation_memory')->nullable(); // Memória de Cálculo
            $table->string('bankruptcy_certificate')->nullable(); // Certidão Negativa de Falência e Protesto
            $table->string('dre_balance_sheet')->nullable(); // DRE/Balancete
            $table->string('issues_invoice')->nullable(); // Emite Nota Fiscal?
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
        Schema::dropIfExists('economic_certifications');
    }
};
