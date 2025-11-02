
<?php

namespace App\Http\Controllers\Api\Tracker\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tracker\StoreProjectMemberRequest;
use App\Http\Requests\Tracker\StoreProjectRequest;
use App\Http\Requests\Tracker\UpdateProjectRequest;
use App\Http\Resources\Tracker\ProjectMemberResource;
use App\Http\Resources\Tracker\ProjectResource;
use App\Models\TrackerProject;
use App\Models\TrackerProjectMember;
use App\Services\Tracker\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(private readonly ProjectService $service)
    {
        $this->middleware(['auth:sanctum', 'abilities:tracker:manage']);
    }

    public function index(Request $request): JsonResponse
    {
        $query = TrackerProject::with(['client', 'members.user']);

        if ($clientId = $request->query('client_id')) {
            $query->where('tracker_client_id', $clientId);
        }

        if ($request->boolean('active_only')) {
            $query->where('is_active', true)->whereNull('archived_at');
        }

        $projects = $query->latest()->paginate($request->integer('per_page', 25));

        return ProjectResource::collection($projects)->response();
    }

    public function store(StoreProjectRequest $request): JsonResponse
    {
        $project = $this->service->create(
            array_merge(
                $request->validated(),
                ['created_by' => $request->user()->id ?? null]
            ),
            $request->input('members', [])
        );

        return (new ProjectResource($project->load(['client', 'members.user'])))
            ->response()
            ->setStatusCode(201);
    }

    public function show(TrackerProject $project): ProjectResource
    {
        $project->load(['client', 'members.user']);

        return new ProjectResource($project);
    }

    public function update(UpdateProjectRequest $request, TrackerProject $project): ProjectResource
    {
        $project = $this->service
            ->update($project, $request->validated())
            ->load(['client', 'members.user']);

        return new ProjectResource($project);
    }

    public function destroy(TrackerProject $project): JsonResponse
    {
        $project->update([
            'is_active' => false,
            'archived_at' => now(),
        ]);

        return response()->json(['status' => 'archived']);
    }

    public function storeMember(StoreProjectMemberRequest $request, TrackerProject $project): JsonResponse
    {
        $member = $this->service->storeMember($project, array_merge(
            $request->validated(),
            ['added_by' => $request->user()->id ?? null]
        ));

        return (new ProjectMemberResource($member))
            ->response()
            ->setStatusCode(201);
    }

    public function destroyMember(TrackerProject $project, TrackerProjectMember $member): JsonResponse
    {
        abort_unless($member->tracker_project_id === $project->id, 404);

        $this->service->removeMember($member);

        return response()->json(['status' => 'removed']);
    }
}
