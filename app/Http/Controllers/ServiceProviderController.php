<?php

namespace App\Http\Controllers;

use App\Models\ServiceProvider;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class ServiceProviderController extends Controller
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
            'client' => ['index', 'show'], // Clientes só podem acessar index
            'web' => ['index', 'show', 'edit','create', 'store', 'update', 'destroy'], // Web tem acesso total pois é admin
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
            return redirect()->route('login')->with('error', 'Sua sessão expirou. Faça login novamente.');
        }

        // Verifica se o método chamado está permitido para o usuário autenticado
        if (!in_array($currentAction, $permissions[$this->guard])) {
            abort(403, "O guard '{$this->guard}' não tem permissão para acessar '{$currentAction}'.");
        }
    }
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            // Admin vê todos
            $serviceProviders = ServiceProvider::with('client')->paginate(10);
        } elseif (Gate::allows('isClient')) {
            // Client vê apenas os seus
            $client = Auth::guard('client')->user();
            $serviceProviders = $client->serviceProviders()->with('client')->paginate(10);
//            $serviceProviders = ServiceProvider::with('client')->where('client_id', '=', $client)->paginate(1);
        } else {
            abort(403, 'Acesso não autorizado.');
        }

        return view('service_provider.index', compact('serviceProviders'));
    }

    public function show($id)
    {
        $serviceProviders = ServiceProvider::with('client')->find($id); // Ou use paginação: ServiceProvider::paginate(10);
        if(!$serviceProviders){
            return redirect()->route('client.index')->with('error', 'Prestador não encontrado');
        }
        return view('service_provider.show', compact('serviceProviders'));
    }

    public function create()
    {
        $clients = Client::all();

        return view('service_provider.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'provider_cnpj' => 'required|string|max:255|unique:service_providers', // Validação única
            'social_purpose' => 'nullable|string',
            'company_type' => 'nullable|string|max:255',
            'company_opening_date' => 'nullable|date',
            'share_capital' => 'nullable',
            'managing_partner_1' => 'nullable|string|max:255',
            'managing_partner_2' => 'nullable|string|max:255',
            'managing_partner_3' => 'nullable|string|max:255',
            'managing_partner_4' => 'nullable|string|max:255',
            'risk_level' => 'nullable|string|max:255',
            'service_provided' => 'nullable|string',
            'relationship_contact' => 'nullable|string|max:255',
            'contract_start_date' => 'nullable|date',
            'contract_end_date' => 'nullable|date',
            'monthly_base_value' => 'nullable',
            'retention_clause' => 'nullable|string|max:255',
            'number_of_contracted_employees' => 'nullable|integer',
            'client_id' => 'required|exists:clients,id', // Validação de chave estrangeira
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['share_capital'] = floatval($this->formatMoney($request->input('share_capital')));
        $data['monthly_base_value'] = floatval($this->formatMoney($request->input('monthly_base_value')));

        ServiceProvider::create($data);


        ServiceProvider::create($request->all()); // Mass assignment (cuidado com campos sensíveis)

        return redirect()->route('service-provider.index')->with('success', 'Prestador de serviço criado com sucesso!');
    }

    public function edit($id) // Route model binding
    {
        $serviceProvider = ServiceProvider::find($id);

        if (!$serviceProvider) {
            return redirect()->route('client.index')->with('error', 'Cliente não encontrado');
        }

        $clients = Client::all();

        return view('service_provider.edit', compact('serviceProvider', 'clients'));
    }

    public function update(Request $request, ServiceProvider $serviceProvider) // Route model binding
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'provider_cnpj' => 'required|string|max:255|unique:service_providers,provider_cnpj,' . $serviceProvider->id, // Validação única (ignora o registro atual)
            'social_purpose' => 'nullable|string',
            'company_type' => 'nullable|string|max:255',
            'company_opening_date' => 'nullable|date',
            'share_capital' => 'nullable',
            'managing_partner_1' => 'nullable|string|max:255',
            'managing_partner_2' => 'nullable|string|max:255',
            'managing_partner_3' => 'nullable|string|max:255',
            'managing_partner_4' => 'nullable|string|max:255',
            'risk_level' => 'nullable|string|max:255',
            'service_provided' => 'nullable|string',
            'relationship_contact' => 'nullable|string|max:255',
            'contract_start_date' => 'nullable|date',
            'contract_end_date' => 'nullable|date',
            'monthly_base_value' => 'nullable',
            'retention_clause' => 'nullable|string|max:255',
            'number_of_contracted_employees' => 'nullable|integer',
            'client_id' => 'required|exists:clients,id', // Validação de chave estrangeira
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        $data['share_capital'] = floatval($this->formatMoney($request->input('share_capital')));
        $data['monthly_base_value'] = floatval($this->formatMoney($request->input('monthly_base_value')));


        $serviceProvider->update($data); // Mass assignment (cuidado com campos sensíveis)

        return redirect()->route('service-provider.index')->with('success', 'Prestador de serviço atualizado com sucesso!');
    }

    private function formatMoney($value)
    {
        if (!$value) return null; // Retorna null se não houver valor

        // Remove "R$ " e espaços extras
        $value = str_replace(['R$ ', ' '], '', $value);

        return (float) $value; // Converte para float
    }

    public function destroy($id) // Route model binding
    {
        $serviceProvider = ServiceProvider::find($id);

        if (!$serviceProvider) {
            return redirect()->route('client.index')->with('error', 'Prestador não encontrado');
        }

        $serviceProvider->delete(); // Soft delete

        return redirect()->route('service-provider.index')->with('success', 'Prestador de serviço excluído com sucesso!');
    }
}
