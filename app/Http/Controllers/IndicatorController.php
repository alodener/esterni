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
    public function updateOrCreateLegalCertification(Request $request, $serviceProviderId)
    {
        $serviceProvider = ServiceProvider::findOrFail($serviceProviderId);

        $serviceProvider->legalCertification()->updateOrCreate(
            ['service_provider_id' => $serviceProvider->id],
            $request->all()
        );

        return response()->json(['message' => 'Legal Certification updated successfully']);
    }

    /**
     * Atualiza ou cria a Habilitação Trabalhista
     */
    public function updateOrCreateLaborCertification(Request $request, $serviceProviderId)
    {
        $serviceProvider = ServiceProvider::findOrFail($serviceProviderId);

        $serviceProvider->laborCertification()->updateOrCreate(
            ['service_provider_id' => $serviceProvider->id],
            $request->all()
        );

        return response()->json(['message' => 'Labor Certification updated successfully']);
    }

    /**
     * Atualiza ou cria a Habilitação Fiscal
     */
    public function updateOrCreateFiscalCertification(Request $request, $serviceProviderId)
    {
        $serviceProvider = ServiceProvider::findOrFail($serviceProviderId);

        $serviceProvider->fiscalCertification()->updateOrCreate(
            ['service_provider_id' => $serviceProvider->id],
            $request->all()
        );

        return response()->json(['message' => 'Fiscal Certification updated successfully']);
    }

    /**
     * Atualiza ou cria a Habilitação Econômica
     */
    public function updateOrCreateEconomicCertification(Request $request, $serviceProviderId)
    {
        $serviceProvider = ServiceProvider::findOrFail($serviceProviderId);

        $serviceProvider->economicCertification()->updateOrCreate(
            ['service_provider_id' => $serviceProvider->id],
            $request->all()
        );

        return response()->json(['message' => 'Economic Certification updated successfully']);
    }
}
