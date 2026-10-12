<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuditProject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'organization_name',
        'period_label',
        'period_start',
        'period_end',
        'auditor_id',
        'previous_project_id',
        'status',
        'scope_locked_at',
        'assessment_locked_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'status' => ProjectStatus::class,
            'period_start' => 'date',
            'period_end' => 'date',
            'scope_locked_at' => 'datetime',
            'assessment_locked_at' => 'datetime',
        ];
    }

    public function auditor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'auditor_id');
    }

    public function previousProject(): BelongsTo
    {
        return $this->belongsTo(self::class, 'previous_project_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'audit_project_user')
            ->withPivot('project_role')
            ->withTimestamps();
    }

    public function diagnostics(): HasMany
    {
        return $this->hasMany(ScopeDiagnostic::class);
    }

    public function scopeDiagnostics(): HasMany
    {
        return $this->hasMany(ScopeDiagnostic::class);
    }

    public function assessments(): HasMany
    {
        return $this->hasMany(AuditAssessment::class);
    }

    public function evidences(): HasMany
    {
        return $this->hasMany(AuditEvidence::class);
    }

    public function capabilityResults(): HasMany
    {
        return $this->hasMany(CapabilityResult::class);
    }

    public function isScopeLocked(): bool
    {
        return $this->scope_locked_at !== null;
    }

    public function isAssessmentLocked(): bool
    {
        return $this->assessment_locked_at !== null;
    }

    public function isArchived(): bool
    {
        return $this->status === ProjectStatus::Archived;
    }
}
