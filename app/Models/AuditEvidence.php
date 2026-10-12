<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditEvidence extends Model
{
    use HasFactory;

    protected $table = 'audit_evidences';

    protected $fillable = [
        'audit_project_id',
        'audit_assessment_id',
        'uploaded_by',
        'original_name',
        'stored_path',
        'disk',
        'mime_type',
        'size_bytes',
        'sha256',
        'page_reference',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'size_bytes' => 'integer',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(AuditProject::class, 'audit_project_id');
    }

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(AuditAssessment::class, 'audit_assessment_id');
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
