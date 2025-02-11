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
        Schema::create('labor_certifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_provider_id')->constrained()->onDelete('cascade');
            $table->integer('risk_level')->nullable(); // Grau de Risco
            $table->decimal('share_capital', 15, 2)->nullable(); // Capital Social
            $table->integer('employees_number')->nullable(); // Nº de Empregados
            $table->decimal('capital_per_employee', 15, 2)->nullable(); // Proporção Capital/empregados
            $table->string('retention_clause')->nullable(); // Cláusula de retenção
            $table->string('fgts_certificate')->nullable(); // Certidão de FGTS
            $table->string('labor_certificate')->nullable(); // Certidão Trabalhista
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
        Schema::dropIfExists('labor_certifications');
    }
};
