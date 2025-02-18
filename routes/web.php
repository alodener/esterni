<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\IndicatorController;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\IndicatorEmployeeController;
use App\Http\Controllers\PayrollAuditController;

Route::prefix('client-auth')->group(function () {
    Route::get('/login', [ClientAuthController::class, 'showLoginForm'])->name('client.login');
    Route::post('/login', [ClientAuthController::class, 'login'])->name('client.signin');;

    Route::middleware('auth:client')->group(function () {
        Route::post('/logout', [ClientAuthController::class, 'logout'])->name('client.logout');
    });
});

Route::middleware(['multi-auth'])->prefix('client')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('client.index');
    Route::get('/create', [ClientController::class, 'create'])->name('client.create');
    Route::get('/{id}', [ClientController::class, 'show'])->name('client.show');
    Route::post('/', [ClientController::class, 'store'])->name('client.store');
    Route::get('/{id}/edit', [ClientController::class, 'edit'])->name('client.edit');
    Route::put('/{id}', [ClientController::class, 'update'])->name('client.update');
    Route::delete('', [ClientController::class, 'destroy'])->name('client.destroy');
});

Route::middleware(['multi-auth'])->prefix('service-provider')->group(function () {
    Route::get('/', [ServiceProviderController::class, 'index'])->name('service-provider.index');
    Route::get('/create', [ServiceProviderController::class, 'create'])->name('service-provider.create');
    Route::get('/{id}', [ServiceProviderController::class, 'show'])->name('service-provider.show');
    Route::post('/', [ServiceProviderController::class, 'store'])->name('service-provider.store');
    Route::get('/{id}/edit', [ServiceProviderController::class, 'edit'])->name('service-provider.edit');
    Route::put('/{serviceProvider}', [ServiceProviderController::class, 'update'])->name('service-provider.update');
    Route::delete('/', [ServiceProviderController::class, 'destroy'])->name('service-provider.destroy');
});

Route::middleware(['multi-auth'])->prefix('employees')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('employees.index'); // Listar funcionários
    Route::get('/create/{employee}', [EmployeeController::class, 'create'])->name('employees.create'); // Formulário de criação
    Route::post('/', [EmployeeController::class, 'store'])->name('employees.store'); // Criar funcionário
    Route::get('/{employee}', [EmployeeController::class, 'show'])->name('employees.show'); // Ver detalhes
    Route::get('/{employee}/edit/{serviceProviderId}', [EmployeeController::class, 'edit'])->name('employees.edit'); // Formulário de edição
    Route::put('/{employee}', [EmployeeController::class, 'update'])->name('employees.update'); // Atualizar funcionário
    Route::delete('/{employee}/{serviceProvider}', [EmployeeController::class, 'destroy'])->name('employees.destroy'); // Excluir funcionário
});

Route::middleware(['multi-auth'])->prefix('indicator')->group(function () {
    Route::get('/{id}', [IndicatorController::class, 'show'])->name('indicator.show'); // indicator
    Route::post('legal-certification', [IndicatorController::class, 'updateOrCreateLegalCertification'])->name('indicator.updateOrCreateLegalCertification');
    Route::post('labor-certification', [IndicatorController::class, 'updateOrCreateLaborCertification'])->name('indicator.updateOrCreateLaborCertification');
    Route::post('fiscal-certification', [IndicatorController::class, 'updateOrCreateFiscalCertification'])->name('indicator.updateOrCreateFiscalCertification');
    Route::post('economic-certification', [IndicatorController::class, 'updateOrCreateEconomicCertification'])->name('indicator.updateOrCreateEconomicCertification');
});

Route::get('/indicator-employee/{id}', [IndicatorEmployeeController::class, 'show'])->name('indicatorEmployee.show');
Route::post('/employee-contractual-docs', [IndicatorEmployeeController::class, 'employeeContractualDocs'])->name('indicatorEmployee.employeeContractualDocs');
Route::post('/occupational-program', [IndicatorEmployeeController::class, 'occupationalProgram'])->name('indicatorEmployee.occupationalProgram');
Route::post('/occupational-health-safety', [IndicatorEmployeeController::class, 'occupationalHealthSafety'])->name('indicatorEmployee.occupationalHealthSafety');
Route::post('/occupational-training', [IndicatorEmployeeController::class, 'occupationalTraining'])->name('indicatorEmployee.occupationalTraining');

Route::get('/payroll-audit/{id}/visualizar', [PayrollAuditController::class, 'visualizar'])->name('payrollAudit.visualizar');
Route::get('/payroll-audit/{id}', [PayrollAuditController::class, 'show'])->name('payrollAudit.show');
Route::get('/payroll-audit/{id}/create', [PayrollAuditController::class, 'create'])->name('payrollAudit.create');
Route::get('/payroll-audit/{id}/edit', [PayrollAuditController::class, 'edit'])->name('payrollAudit.edit');
Route::put('/payroll-audit/{id}', [PayrollAuditController::class, 'update'])->name('payrollAudit.update');
Route::post('/payroll-audit', [PayrollAuditController::class, 'payrollAudit'])->name('payrollAudit.payrollAudit');
Route::delete('/payroll-audit/{id}/{serviceProviderId}', [PayrollAuditController::class, 'destroy'])->name('payrollAudit.destroy');

Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('multi-auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('multi-auth')->name('logout');
