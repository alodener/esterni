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
        Schema::create('payroll_audits', function (Blueprint $table) {
            $table->id();
            $table->integer('month')->comment('Mês de referência');
            $table->integer('year')->comment('Ano de referência');
            $table->foreignId('service_provider_id')->constrained('service_providers')->onDelete('cascade');

            // Folha de Pagamento
            $table->string('payroll_entries_correct')->nullable()->comment('Os lançamentos realizados na folha/férias/rescisão estão corretos?');
            $table->string('payroll_compliance')->nullable()->comment('Folha/Férias/Rescisões foram pagas em conformidade?');
            $table->string('benefits_paid_correctly')->nullable()->comment('Os benefícios foram pagos corretamente?');
            $table->string('leave_records_correct')->nullable()->comment('Os afastamentos foram feitos corretamente?');

            // Jornada de Trabalho
            $table->string('work_schedules_presented')->nullable()->comment('Espelhos de Ponto Apresentados');
            $table->string('work_records_compliant')->nullable()->comment('Registros realizados em conformidade');
            $table->string('overtime_compliant')->nullable()->comment('Horas extras realizadas em conformidade com a CLT');
            $table->string('rest_periods_complied')->nullable()->comment('Cumprimento intrajornada e interjornada');

            // Encargos Trabalhistas
            $table->string('tax_guides_presented')->nullable()->comment('Guias e detalhamentos/relatórios apresentados (FGTS/INSS/IR)?');
            $table->string('fgts_compliance')->nullable()->comment('Conformidade nos lançamentos e pagamento do FGTS');
            $table->string('inss_compliance')->nullable()->comment('Conformidade nos lançamentos e pagamento do INSS');
            $table->string('ir_compliance')->nullable()->comment('Conformidade nos lançamentos e pagamento do IR');

            // Saúde e Segurança no Trabalho
            $table->string('cat_submitted_on_time')->nullable()->comment('CAT emitida e enviada ao eSocial dentro do prazo legal');
            $table->string('cipa_training')->nullable()->comment('CIPA/treinamentos');
            $table->string('medical_certificates_presented')->nullable()->comment('Atestados apresentados (doença relacionada às atividades laborais)');
            $table->string('accident_investigation_presented')->nullable()->comment('Investigação de Acidente - apresentado');

            $table->timestamps();

            $table->unique(['month', 'year', 'service_provider_id'], 'unique_payroll_audit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payroll_audits');
    }
};
