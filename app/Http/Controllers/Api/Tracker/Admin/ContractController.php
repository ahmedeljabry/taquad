
<?php

namespace App\Http\Controllers\Api\Tracker\Admin;

use App\Enums\ContractStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tracker\StoreContractRequest;
use App\Http\Requests\Tracker\UpdateContractRequest;
use App\Http\Resources\Tracker\ContractResource;
use App\Models\Contract;
use App\Services\Tracker\ContractService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function __construct(private readonly ContractService $service)
    {
        $this->middleware(['auth:sanctum', 'abilities:tracker:manage']);
    }

    public function index(Request $request): JsonResponse
    {
        $query = Contract::with(['project.client', 'freelancer', 'client']);

        if ($projectId = $request->query('project_id')) {
            $query->where('tracker_project_id', $projectId);
        }

        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        $contracts = $query->latest()->paginate($request->integer('per_page', 25));

        return ContractResource::collection($contracts)->response();
    }

    public function store(StoreContractRequest $request): JsonResponse
    {
        $attributes = array_merge(
            $request->validated(),
            [
                'created_by' => $request->user()->id ?? null,
                'currency_code' => $request->input('currency_code', $this->resolveCurrencyCode()),
            ]
        );

        $contract = $this->service
            ->create($attributes)
            ->load(['project.client', 'freelancer', 'client']);

        return (new ContractResource($contract))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Contract $contract): ContractResource
    {
        $contract->load(['project.client', 'freelancer', 'client']);

        return new ContractResource($contract);
    }

    public function update(UpdateContractRequest $request, Contract $contract): ContractResource
    {
        $attributes = $request->validated();
        if (! array_key_exists('currency_code', $attributes)) {
            $attributes['currency_code'] = $contract->currency_code ?? $this->resolveCurrencyCode();
        }
        $attributes['updated_by'] = $request->user()->id ?? null;

        $contract = $this->service
            ->update($contract, $attributes)
            ->load(['project.client', 'freelancer', 'client']);

        return new ContractResource($contract);
    }

    public function changeStatus(Request $request, Contract $contract): ContractResource
    {
        $validated = $request->validate([
            'status' => ['required', 'in:offer_sent,active,paused,ended'],
        ]);

        $contract = $this->service
            ->changeStatus($contract, ContractStatus::from($validated['status']))
            ->load(['project.client', 'freelancer', 'client']);

        return new ContractResource($contract);
    }

    private function resolveCurrencyCode(): string
    {
        try {
            $settings = settings('currency');
            if ($settings && $settings->code) {
                return (string) $settings->code;
            }
        } catch (\Throwable) {
            // ignore, fallback below
        }

        return config('app.currency', 'USD');
    }
}
