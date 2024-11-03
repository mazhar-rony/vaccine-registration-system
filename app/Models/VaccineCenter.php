<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VaccineCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'daily_limit',
    ];

    public function vaccineCandidates(): HasMany
    {
        return $this->hasMany(VaccineCandidate::class);
    }
}
