<?php

namespace App\Services\Tracker;

use App\Enums\ContractStatus;
use App\Models\Contract;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ContractService
{
    public function create(array $attributes): Contract
    {
        return DB::transaction(function () use ($attributes) {
            $contract = Contract::create($attributes);
            $this->ensureUniqueActiveContract($contract);

            return $contract->fresh();
        });
    }

    public function update(Contract $contract, array $attributes): Contract
    {
        return DB::transaction(function () use ($contract, $attributes) {
            $contract->fill($attributes);
            $contract->save();
            $this->ensureUniqueActiveContract($contract);

            return $contract->fresh();
        });
    }

    public function changeStatus(Contract $contract, ContractStatus $status): Contract
    {
        return DB::transaction(function () use ($contract, $status) {
            $contract->status = $status;
            if ($status === ContractStatus::Active && $contract->starts_at === null) {
                $contract->starts_at = now();
            }
            if ($status === ContractStatus::Ended) {
                $contract->ends_at = now();
            }
            $contract->save();

            return $contract->fresh();
        });
    }

    protected function ensureUniqueActiveContract(Contract $contract): void
    {
        if ($contract->status !== ContractStatus::Active) {
            return;
        }

        $duplicate = Contract::query()
            ->where('id', '!=', $contract->id)
            ->where('tracker_project_id', $contract->tracker_project_id)
            ->when($contract->project_id, function ($query) use ($contract) {
                $query->where('project_id', $contract->project_id);
            })
            ->where('freelancer_id', $contract->freelancer_id)
            ->where('status', ContractStatus::Active->value)
            ->exists();

        if ($duplicate) {
            throw ValidationException::withMessages([
                'freelancer_id' => __('messages.t_tracker_contract_unique_active'),
            ]);
        }
    }
}
