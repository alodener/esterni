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
        Schema::create('occupational_trainings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_provider_id')
                ->constrained('service_providers')
                ->onDelete('cascade'); // Relacionamento 1:1 com ServiceProvider

            $table->string('nr_01_general_safety')->comment('NR 01 - Orientações de segurança em Geral');
            $table->string('nr_04_epi')->comment('NR 04 - EPI');
            $table->string('nr_18_construction')->comment('NR 18 - Construção Civil');
            $table->string('nr_35_work_at_height')->comment('NR 35 - Trabalho em Altura');
            $table->string('nr_10_electricity')->comment('NR 10 - Eletricidade');
            $table->string('nr_11_transport_handling')->comment('NR 11 - Transporte, Movimentação, Armazenagem e Manuseio de equipamentos');
            $table->string('nr_14_furnaces')->comment('NR 14 - Fornos');
            $table->string('nr_17_ergonomics')->comment('NR 17 - Ergonomia');
            $table->string('nr_19_explosives')->comment('NR 19 - Explosivos');

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
        Schema::dropIfExists('occupational_trainings');
    }
};
