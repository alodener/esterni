<?php

namespace App\Http\Controllers;

use App\Models\ServiceProvider;
use Illuminate\Http\Request;

class IndicatorController extends Controller
{
    public function show($id)
    {
        $serviceProvider = ServiceProvider::find($id);
        if (!$serviceProvider) {
            return redirect()->route('service-provider.show', $id)->with('error', 'Cliente não encontrado');
        }
        return view('indicator_empresa.index', compact('serviceProvider'));
    }

    /**
     * Atualiza ou cria a Habilitação Jurídica
     */
    public function updateOrCreateLegalCertification(Request $request)
    {
        $serviceProvider = ServiceProvider::findOrFail($request->service_provider_id);

        $serviceProvider->legalCertification()->updateOrCreate(
            ['service_provider_id' => $request->service_provider_id],
            $request->all()
        );

        return redirect()->route('service-provider.show', $request->service_provider_id)->with('success', 'Indicador alterado com sucesso');
    }

    /**
     * Atualiza ou cria a Habilitação Trabalhista
     */
    public function updateOrCreateLaborCertification(Request $request)
    {
        $serviceProvider = ServiceProvider::findOrFail($request->service_provider_id);

        $serviceProvider->laborCertification()->updateOrCreate(
            ['service_provider_id' => $request->service_provider_id],
            $request->all()
        );

        return redirect()->route('service-provider.show', $request->service_provider_id)->with('success', 'Indicador alterado com sucesso');
    }

    /**
     * Atualiza ou cria a Habilitação Fiscal
     */
    public function updateOrCreateFiscalCertification(Request $request)
    {
        $serviceProvider = ServiceProvider::findOrFail($request->service_provider_id);

        $serviceProvider->fiscalCertification()->updateOrCreate(
            ['service_provider_id' => $request->service_provider_id],
            $request->all()
        );

        return redirect()->route('service-provider.show', $request->service_provider_id)->with('success', 'Indicador alterado com sucesso');
    }

    /**
     * Atualiza ou cria a Habilitação Econômica
     */
    public function updateOrCreateEconomicCertification(Request $request)
    {
        $serviceProvider = ServiceProvider::findOrFail($request->service_provider_id);

        $serviceProvider->economicCertification()->updateOrCreate(
            ['service_provider_id' => $request->service_provider_id],
            $request->all()
        );

        return redirect()->route('service-provider.show', $request->service_provider_id)->with('success', 'Indicador alterado com sucesso');
    }
}
