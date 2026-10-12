<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CobitActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'cobit_objective_id',
        'code',
        'practice_code',
        'practice_name',
        'description',
        'capability_level',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'capability_level' => 'integer',
            'sort_order' => 'integer',
        ];
    }

    public function objective(): BelongsTo
    {
        return $this->belongsTo(CobitObjective::class, 'cobit_objective_id');
    }

    public function assessments(): HasMany
    {
        return $this->hasMany(AuditAssessment::class);
    }
}
