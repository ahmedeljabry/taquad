<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectBid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PDF as MPDF;
use Symfony\Component\HttpFoundation\Response;

class ProjectNdaController extends Controller
{
    /**
     * Download NDA as PDF.
     */
    public function downloadNda(Request $request, string $pid, string $slug, string $bid): Response
    {
        [$project, $projectBid] = $this->resolveProjectAndBid($pid, $slug, $bid);

        $this->authorizeView($project->user_id, $projectBid->user_id);

        if (!($project->requires_nda && $project->nda_path)) {
            abort(404);
        }

        if (!$projectBid->is_awarded || empty($projectBid->nda_signature)) {
            abort(403, __('messages.t_download_nda_locked'));
        }

        if (!Storage::disk('local')->exists($project->nda_path)) {
            abort(404);
        }

        $scope = $project->nda_scope ?: __('messages.t_project_nda_scope_default');
        $termLabel = trans_choice('messages.t_project_nda_term_value', $project->nda_term_months ?? 12, [
            'count' => $project->nda_term_months ?? 12,
        ]);

        $answers = collect($projectBid->compliance_answers ?? [])
            ->filter(fn ($entry) => filled($entry['question'] ?? null))
            ->values();

        $markdown = Storage::disk('local')->get($project->nda_path);
        $markdownHtml = method_exists(Str::class, 'markdown')
            ? Str::markdown($markdown ?? '')
            : nl2br(e($markdown ?? ''));

        $meta = $projectBid->nda_signature_meta ?? [];

        $pdf = MPDF::loadView('pdf.nda', [
            'project'      => $project,
            'bid'          => $projectBid,
            'answers'      => $answers,
            'scope'        => $scope,
            'termLabel'    => $termLabel,
            'markdownHtml' => $markdownHtml,
            'meta'         => $meta,
        ], [], [
            'format'        => 'A4',
            'default_font'  => 'dejavusans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled'      => true,
        ]);

        $filename = 'NDA-' . $project->pid . '-' . $projectBid->uid . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Download proposal (answers + bid summary) as PDF.
     */
    public function downloadProposal(Request $request, string $pid, string $slug, string $bid): Response
    {
        [$project, $projectBid] = $this->resolveProjectAndBid($pid, $slug, $bid);

        $this->authorizeView($project->user_id, $projectBid->user_id);

        $pdf = MPDF::loadView('pdf.proposal', [
            'project'      => $project,
            'bid'          => $projectBid,
            'client'       => $project->client,
            'freelancer'   => $projectBid->user,
            'answers'      => collect($projectBid->compliance_answers ?? [])->filter(fn ($x) => !empty($x['question'] ?? ''))->values(),
        ], [], [
            'format'        => 'A4',
            'default_font'  => 'dejavusans',
        ]);

        $filename = 'Proposal-' . $project->pid . '-' . $projectBid->uid . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Resolve project and bid from route params.
     */
    private function resolveProjectAndBid(string $pid, string $slug, string $bid): array
    {
        $project = Project::where('pid', $pid)->where('slug', $slug)->firstOrFail();

        $projectBid = ProjectBid::where('uid', $bid)
            ->where('project_id', $project->id)
            ->with(['user'])
            ->firstOrFail();

        return [$project, $projectBid];
    }

    /**
     * Ensure only project owner or bid freelancer can view.
     */
    private function authorizeView(int $projectOwnerId, int $freelancerId): void
    {
        if (!auth()->check()) {
            abort(403);
        }

        $userId = auth()->id();
        if ($userId !== $projectOwnerId && $userId !== $freelancerId && !auth('admin')->check()) {
            abort(403);
        }
    }
}


