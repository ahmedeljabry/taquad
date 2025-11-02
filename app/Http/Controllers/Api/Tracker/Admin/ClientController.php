<?php

namespace App\Http\Controllers\Api\Tracker\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tracker\StoreClientRequest;
use App\Http\Requests\Tracker\UpdateClientRequest;
use App\Http\Resources\Tracker\ClientResource;
use App\Models\TrackerClient;
use App\Services\Tracker\ClientService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct(private readonly ClientService $service)
    {
        $this->middleware(['auth:sanctum', 'abilities:tracker:manage']);
    }

    public function index(Request $request): JsonResponse
    {
        $clients = TrackerClient::withCount('projects')
            ->latest()
            ->paginate($request->integer('per_page', 25));

        return ClientResource::collection($clients)->response();
    }

    public function store(StoreClientRequest $request): JsonResponse
    {
        $client = $this->service->create($request->validated());

        return (new ClientResource($client->loadCount('projects')))
            ->response()
            ->setStatusCode(201);
    }

    public function show(TrackerClient $client): ClientResource
    {
        $client->loadCount('projects');

        return new ClientResource($client);
    }

    public function update(UpdateClientRequest $request, TrackerClient $client): ClientResource
    {
        $client = $this->service->update($client, $request->validated())->loadCount('projects');

        return new ClientResource($client);
    }

    public function destroy(TrackerClient $client): JsonResponse
    {
        $this->service->delete($client);

        return response()->json(['status' => 'deleted']);
    }
}
