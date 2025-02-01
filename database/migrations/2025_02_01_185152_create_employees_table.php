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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_provider_id')->constrained()->onDelete('cascade'); // Relação com ServiceProvider
            $table->string('photo')->nullable();
            $table->date('system_enable_date');
            $table->string('client_name');
            $table->string('provider_name');
            $table->string('provider_cnpj', 18);
            $table->string('employee_name');
            $table->date('admission_date');
            $table->date('dismissal_date')->nullable();
            $table->string('job_title');
            $table->decimal('salary', 10, 2);
            $table->boolean('insalubrity')->default(false);
            $table->boolean('dangerousness')->default(false);
            $table->string('work_schedule');
            $table->boolean('night_shift')->default(false);
            $table->string('department');
            $table->date('start_client_allocation');
            $table->date('end_client_allocation')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('employees');
    }
};
