<?php

namespace App\Models;

use App\Enums\Rating;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AuditAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'audit_project_id',
        'cobit_activity_id',
        'rating',
        'finding_note',
        'ai_recommendation',
        'ai_model',
        'ai_generated_at',
        'final_recommendation',
        'recommendation_status',
        'assessed_by',
        'assessed_at',
    ];

    protected function casts(): array
    {
        return [
            'rating' => Rating::class,
            'ai_generated_at' => 'datetime',
            'assessed_at' => 'datetime',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(AuditProject::class, 'audit_project_id');
    }

    public function activity(): BelongsTo
    {
        return $this->belongsTo(CobitActivity::class, 'cobit_activity_id');
    }

    public function assessor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assessed_by');
    }

    public function evidences(): HasMany
    {
        return $this->hasMany(AuditEvidence::class);
    }
}
