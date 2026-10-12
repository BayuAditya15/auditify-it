<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CapabilityResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'audit_project_id',
        'cobit_objective_id',
        'current_level',
        'target_level',
        'gap',
        'level_achievements',
        'activities_total',
        'activities_assessed',
        'is_stale',
        'calculated_at',
    ];

    protected function casts(): array
    {
        return [
            'current_level' => 'integer',
            'target_level' => 'integer',
            'gap' => 'integer',
            'level_achievements' => 'array',
            'activities_total' => 'integer',
            'activities_assessed' => 'integer',
            'is_stale' => 'boolean',
            'calculated_at' => 'datetime',
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
