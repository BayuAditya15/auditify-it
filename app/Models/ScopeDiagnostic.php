<?php

namespace App\Models;

use App\Enums\RiskLevel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScopeDiagnostic extends Model
{
    use HasFactory;

    protected $fillable = [
        'audit_project_id',
        'cobit_objective_id',
        'importance',
        'performance',
        'risk_score',
        'risk_level',
        'is_selected',
        'is_override',
        'override_reason',
        'selection_reason',
        'target_level',
    ];

    protected function casts(): array
    {
        return [
            'importance' => 'integer',
            'performance' => 'integer',
            'risk_score' => 'integer',
            'risk_level' => RiskLevel::class,
            'is_selected' => 'boolean',
            'is_override' => 'boolean',
            'target_level' => 'integer',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(AuditProject::class, 'audit_project_id');
    }

    public function objective(): BelongsTo
    {
        return $this->belongsTo(CobitObjective::class, 'cobit_objective_id');
    }
}
