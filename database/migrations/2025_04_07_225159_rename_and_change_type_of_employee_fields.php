<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            // Remover os campos antigos
            $table->dropColumn(['insalubrity', 'dangerousness', 'night_shift']);

            // Adicionar os novos campos
            $table->string('intervalo')->nullable()->comment('Substitui insalubridade');
            $table->string('adicionais')->nullable()->comment('Substitui periculosidade');
            $table->string('treinamentos')->nullable()->comment('Substitui adicional noturno');
        });
    }

    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            // Remover os novos campos
            $table->dropColumn(['intervalo', 'adicionais', 'treinamentos']);

            // Restaurar os campos antigos
            $table->boolean('insalubrity')->default(false);
            $table->boolean('dangerousness')->default(false);
            $table->boolean('night_shift')->default(false);
        });
    }
};
