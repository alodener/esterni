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
        Schema::create('audit_compliances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_provider_id')->constrained('service_providers')->onDelete('cascade')->comment('Relacionamento com o prestador de serviço');
            $table->year('year')->comment('Ano da auditoria');
            // $table->tinyInteger('month')->comment('Mês da auditoria');

            // Folha 13º
            $table->string('payroll_thirteenth_launches')->nullable()->comment('Os lançamentos foram efetuados e pagos corretamente?');
            $table->string('payroll_thirteenth_fgts')->nullable()->comment('Conformidade nos lançamentos e pagamento do FGTS');
            $table->string('payroll_thirteenth_inss')->nullable()->comment('Conformidade nos lançamentos e pagamento do INSS');
            $table->string('payroll_thirteenth_ir')->nullable()->comment('Conformidade nos lançamentos e pagamento do IR');

            // Férias
            $table->string('vacation_granted_on_time')->nullable()->comment('As férias foram concedidas dentro do prazo legal?');
            $table->string('vacation_paid_on_time')->nullable()->comment('As férias foram pagas dentro do prazo legal?');
            $table->string('vacation_planning')->nullable()->comment('Existe planejamento de férias?');
            $table->string('vacation_documentation')->nullable()->comment('A documentação de férias foi elaborada e assinada?');

            // Saúde e Segurança no Trabalho
            $table->string('occupational_exams')->nullable()->comment('Exames periódicos realizados?');
            $table->string('occupational_programs')->nullable()->comment('Programas Ocupacionais vigentes?');
            $table->string('occupational_trainings')->nullable()->comment('Treinamentos ocupacionais realizados?');
            $table->string('esocial_events')->nullable()->comment('Eventos do eSocial enviados em conformidade?');

            // CCT/ACT e FGTS
            $table->string('salary_cct_act')->nullable()->comment('Salário pago com base na CCT/ACT?');
            $table->string('special_work_shifts_cct_act')->nullable()->comment('Jornadas de trabalho especiais realizadas conforme CCT/ACT?');
            $table->string('benefits_cct_act')->nullable()->comment('Pagamento dos benefícios e adicionais conforme CCT/ACT?');
            $table->string('fgts_balance_deposited')->nullable()->comment('Saldo de FGTS depositado corretamente?');

            $table->timestamps();


            $table->unique(['year', 'service_provider_id'], 'unique_audit_compliance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_compliances');
    }
};
