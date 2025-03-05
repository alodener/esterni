<?php

namespace App\Http\Controllers;

use App\Models\ServiceProvider;
use Illuminate\Http\Request;

class OnboardingController extends Controller
{
    public function show($id){
        $serviceProvider = ServiceProvider::with('client')->find($id); // Ou use paginação: ServiceProvider::paginate(10);
        if(!$serviceProvider){
            return redirect()->route('client.index')->with('error', 'Prestador não encontrado');
        }
        return view('onboarding.show', compact('serviceProvider'));
    }
}
