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
        Schema::table('payroll_audits', function (Blueprint $table) {
            // Notas para Folha de Pagamento
            $table->text('payroll_notes')->nullable()->comment('Notas sobre Folha de Pagamento');

            // Notas para Jornada de Trabalho
            $table->text('work_schedule_notes')->nullable()->comment('Notas sobre Jornada de Trabalho');

            // Notas para Encargos Trabalhistas
            $table->text('tax_obligations_notes')->nullable()->comment('Notas sobre Encargos Trabalhistas');

            // Notas para Saúde e Segurança no Trabalho
            $table->text('health_safety_notes')->nullable()->comment('Notas sobre Saúde e Segurança no Trabalho');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payroll_audits', function (Blueprint $table) {
            $table->dropColumn([
                'payroll_notes',
                'work_schedule_notes',
                'tax_obligations_notes',
                'health_safety_notes'
            ]);
        });
    }
};
