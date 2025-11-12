<?php

namespace App\Services\Tracker;

use App\Enums\ContractStatus;
use App\Models\Contract;
use Illuminate\Support\Facades\Cache;

class ContractService
{
    /**
     * Create a new contract
     *
     * @param  array  $data
     * @return Contract
     */
    public function create(array $data): Contract
    {
        $contract = Contract::create($data);
        
        // Clear cache for contract queries
        $this->clearContractCache($contract);
        
        return $contract;
    }

    /**
     * Get active contracts for a user (with caching)
     *
     * @param  int  $userId
     * @param  string  $role  'client' or 'freelancer'
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getActiveContracts(int $userId, string $role = 'freelancer')
    {
        $cacheKey = "contracts:active:{$role}:{$userId}";
        
        return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($userId, $role) {
            $column = $role === 'client' ? 'client_id' : 'freelancer_id';
            
            return Contract::query()
                ->where($column, $userId)
                ->where('status', ContractStatus::Active)
                ->with(['project', 'trackerProject'])
                ->orderBy('created_at', 'desc')
                ->get();
        });
    }

    /**
     * Check if a user has an active contract for a project
     *
     * @param  int  $projectId
     * @param  int  $freelancerId
     * @return bool
     */
    public function hasActiveContract(int $projectId, int $freelancerId): bool
    {
        $cacheKey = "contract:active:project:{$projectId}:freelancer:{$freelancerId}";
        
        return Cache::remember($cacheKey, now()->addMinutes(5), function () use ($projectId, $freelancerId) {
            return Contract::query()
                ->where('project_id', $projectId)
                ->where('freelancer_id', $freelancerId)
                ->whereIn('status', [ContractStatus::Active, ContractStatus::OfferSent])
                ->exists();
        });
    }

    /**
     * Validate weekly hours limit
     *
     * @param  Contract  $contract
     * @param  int  $additionalMinutes
     * @param  \Carbon\CarbonImmutable  $weekStart
     * @return array{valid: bool, current_hours: float, limit: float, available: float}
     */
    public function validateWeeklyLimit(Contract $contract, int $additionalMinutes, \Carbon\CarbonImmutable $weekStart): array
    {
        $weekEnd = $weekStart->endOfWeek();
        
        $currentMinutes = $contract->time_entries()
            ->whereBetween('started_at', [$weekStart, $weekEnd])
            ->sum('duration_minutes');
        
        $currentHours = $currentMinutes / 60;
        $additionalHours = $additionalMinutes / 60;
        $limit = (float) $contract->weekly_limit_hours;
        $totalHours = $currentHours + $additionalHours;
        
        return [
            'valid' => $totalHours <= $limit,
            'current_hours' => round($currentHours, 2),
            'limit' => $limit,
            'available' => round(max(0, $limit - $currentHours), 2),
            'exceeds_by' => $totalHours > $limit ? round($totalHours - $limit, 2) : 0,
        ];
    }

    /**
     * Clear contract-related caches
     *
     * @param  Contract  $contract
     * @return void
     */
    protected function clearContractCache(Contract $contract): void
    {
        Cache::forget("contracts:active:client:{$contract->client_id}");
        Cache::forget("contracts:active:freelancer:{$contract->freelancer_id}");
        Cache::forget("contract:active:project:{$contract->project_id}:freelancer:{$contract->freelancer_id}");
    }
}
