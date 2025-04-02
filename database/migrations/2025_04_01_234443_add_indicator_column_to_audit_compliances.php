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
        Schema::table('audit_compliances', function (Blueprint $table) {
            // Folha 13º
            $table->text('payroll_notes')->nullable()->comment('Notas sobre Folha de Pagamento');

            // Férias
            $table->text('work_schedule_notes')->nullable()->comment('Notas sobre Férias');

            // Notas para // Saúde e Segurança no Trabalho
            $table->text('tax_obligations_notes')->nullable()->comment('Notas sobre Saúde e Segurança no Trabalho');

            // Notas para CCT/ACT e FGTS
            $table->text('health_safety_notes')->nullable()->comment('Notas sobre CCT/ACT e FGTS');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('audit_compliances', function (Blueprint $table) {
            $table->dropColumn([
                'payroll_notes',
                'work_schedule_notes',
                'tax_obligations_notes',
                'health_safety_notes',
            ]);
        });
    }
};
