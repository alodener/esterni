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

Route::middleware(['auth'])->group(function () {
    Route::get('/client', [ClientController::class, 'index'])->name('client.index');
    Route::get('/client/create', [ClientController::class, 'create'])->name('client.create');
    Route::get('/client/{id}', [ClientController::class, 'show'])->name('client.show');
    Route::post('/client', [ClientController::class, 'store'])->name('client.store');
    Route::get('/client/{id}/edit', [ClientController::class, 'edit'])->name('client.edit');
    Route::put('/client/{id}', [ClientController::class, 'update'])->name('client.update');
    Route::delete('/client', [ClientController::class, 'destroy'])->name('client.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/service-provider', [ServiceProviderController::class, 'index'])->name('service-provider.index');
    Route::get('/service-provider/create', [ServiceProviderController::class, 'create'])->name('service-provider.create');
    Route::get('/service-provider/{id}', [ServiceProviderController::class, 'show'])->name('service-provider.show');
    Route::post('/service-provider', [ServiceProviderController::class, 'store'])->name('service-provider.store');
    Route::get('/service-provider/{id}/edit', [ServiceProviderController::class, 'edit'])->name('service-provider.edit');
    Route::put('/service-provider/{serviceProvider}', [ServiceProviderController::class, 'update'])->name('service-provider.update');
    Route::delete('/service-provider', [ServiceProviderController::class, 'destroy'])->name('service-provider.destroy');
});

Route::prefix('employees')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('employees.index'); // Listar funcionários
    Route::get('/create/{employee}', [EmployeeController::class, 'create'])->name('employees.create'); // Formulário de criação
    Route::post('/', [EmployeeController::class, 'store'])->name('employees.store'); // Criar funcionário
    Route::get('/{employee}', [EmployeeController::class, 'show'])->name('employees.show'); // Ver detalhes
    Route::get('/{employee}/edit/{serviceProviderId}', [EmployeeController::class, 'edit'])->name('employees.edit'); // Formulário de edição
    Route::put('/{employee}', [EmployeeController::class, 'update'])->name('employees.update'); // Atualizar funcionário
    Route::delete('/{employee}/{serviceProvider}', [EmployeeController::class, 'destroy'])->name('employees.destroy'); // Excluir funcionário
});


Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify');
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('billing', function () {
		return view('pages.billing');
	})->name('billing');
	Route::get('tables', function () {
		return view('pages.tables');
	})->name('tables');
	Route::get('rtl', function () {
		return view('pages.rtl');
	})->name('rtl');
	Route::get('virtual-reality', function () {
		return view('pages.virtual-reality');
	})->name('virtual-reality');
	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	Route::get('user-management', function () {
		return view('pages.laravel-examples.user-management');
	})->name('user-management');
	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');
});
