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
        Schema::create('occupational_health_safety', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_provider_id')
                ->constrained('service_providers')
                ->onDelete('cascade'); // Relacionamento 1:1 com ServiceProvider

            $table->string('aso')->comment('ASO');
            $table->string('complementary_exams')->comment('Exames Complementares');
            $table->string('work_order')->comment('Ordem de Serviço');
            $table->string('epi_uniform_record')->comment('Ficha de EPI/Fardamento');
            $table->string('esocial_events_submission')->comment('Envio dos eventos do eSocial (S-2220, S-2240, S-2210, S-2221)');

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
        Schema::dropIfExists('occupational_health_safety');
    }
};
