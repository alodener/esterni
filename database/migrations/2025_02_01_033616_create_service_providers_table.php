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
        Schema::create('service_providers', function (Blueprint $table) {
            $table->id(); // Chave primária
            $table->string('company_name');
            $table->string('provider_cnpj')->unique(); // CNPJ único
            $table->text('social_purpose')->nullable(); // Objeto social (texto longo)
            $table->string('company_type')->nullable(); // Tipo de sociedade
            $table->date('company_opening_date')->nullable(); // Data de abertura
            $table->decimal('share_capital', 15, 2)->nullable(); // Capital social (valor monetário)
            $table->string('managing_partner_1')->nullable();
            $table->string('managing_partner_2')->nullable();
            $table->string('managing_partner_3')->nullable();
            $table->string('managing_partner_4')->nullable();
            $table->string('risk_level')->nullable(); // Grau de risco
            $table->text('service_provided')->nullable(); // Serviço prestado
            $table->string('relationship_contact')->nullable(); // Contato
            $table->date('contract_start_date')->nullable(); // Início do contrato
            $table->date('contract_end_date')->nullable(); // Término do contrato
            $table->decimal('monthly_base_value', 15, 2)->nullable(); // Valor base mensal
            $table->string('retention_clause')->nullable(); // Cláusula de retenção
            $table->integer('number_of_contracted_employees')->nullable(); // Nº de empregados
            $table->unsignedBigInteger('client_id'); // Chave estrangeira para clientes
            $table->foreign('client_id')->references('id')->on('clients'); // Vincula à tabela clients
            $table->timestamps(); //created_at e updated_at
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_providers');
    }
};
