<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_contractual_docs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_provider_id')->constrained('service_providers')->onDelete('cascade'); // Relação 1:1 com service_providers

            $table->string('admission_protocol')->comment('Protocolo de Admissão: eSocial ou CTPS Digital');
            $table->string('employment_contract')->comment('Contrato de Trabalho');
            $table->string('ethics_code')->comment('Código de Ética e Conduta');
            $table->string('driver_license')->nullable()->comment('CNH - Para Motoristas');
            $table->string('federal_police_clearance')->nullable()->comment('Alvará da Polícia Federal - Serviço de Vigilância');
            $table->string('professional_council_certificate')->nullable()->comment('Certidão de Registro no Conselho de Classe');
            $table->string('electrical_course_certificate')->nullable()->comment('Certificado de curso de elétrica');
            $table->string('collective_agreement')->comment('CCT ou ACT');

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
        Schema::dropIfExists('employee_contractual_docs');
    }
};
