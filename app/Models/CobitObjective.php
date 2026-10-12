<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CobitObjective extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'domain',
        'name',
        'description',
        'purpose',
        'sort_order',
    ];

    public function activities(): HasMany
    {
        return $this->hasMany(CobitActivity::class)->orderBy('sort_order');
    }

    public function diagnostics(): HasMany
    {
        return $this->hasMany(ScopeDiagnostic::class);
    }

    public function capabilityResults(): HasMany
    {
        return $this->hasMany(CapabilityResult::class);
    }
}
