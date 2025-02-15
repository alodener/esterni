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
        Schema::create('occupational_programs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_provider_id')
                ->constrained('service_providers')
                ->onDelete('cascade'); // Relacionamento 1:1 com ServiceProvider

            $table->string('ltcat')->comment('LTCAT');
            $table->string('pgr')->comment('PGR');
            $table->string('pcmso')->comment('PCMSO');
            $table->string('insalubrity_report')->comment('Laudo de Insalubridade');
            $table->string('danger_report')->comment('Laudo de Periculosidade');
            $table->string('aet')->comment('AET');

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
        Schema::dropIfExists('occupational_programs');
    }
};
