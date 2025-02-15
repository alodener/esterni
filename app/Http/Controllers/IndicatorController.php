<?php

namespace App\Http\Controllers;

use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndicatorController extends Controller
{
    protected $guard;
    protected $user;
    public function __construct()
    {
        // Aplica o middleware primeiro para garantir autenticação
        $this->middleware('auth:client,web');

        // Adia a validação de permissões para depois que o middleware rodar
        $this->middleware(function ($request, $next) {
            $this->checkPermissions($request);
            return $next($request);
        });
    }

    /**
     * Verifica se o usuário autenticado tem permissão para acessar o método.
     */
    private function checkPermissions($request)
    {
        // Permissões por nome de método
        $permissions = [
            'client' => ['show'], // Clientes só podem acessar index
            'web' => ['show', 'updateOrCreateLegalCertification', 'updateOrCreateLaborCertification', 'updateOrCreateFiscalCertification', 'updateOrCreateEconomicCertification'], // Web tem acesso total pois é admin
        ];

        // Descobre o nome do método sendo chamado
        $currentAction = $request->route()->getActionMethod();

        // Identifica qual guard está autenticado
        foreach ($permissions as $guard => $allowedMethods) {
            if (Auth::guard($guard)->check()) {
                $this->guard = $guard;
                $this->user = Auth::guard($guard)->user();
                break;
            }
        }

        // Bloqueia acesso caso nenhum guard esteja autenticado
        if (!$this->guard) {
            abort(403, 'Acesso não autorizado.');
        }

        // Verifica se o método chamado está permitido para o usuário autenticado
        if (!in_array($currentAction, $permissions[$this->guard])) {
            abort(403, "O guard '{$this->guard}' não tem permissão para acessar '{$currentAction}'.");
        }
    }

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
