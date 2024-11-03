<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class VaccineCandidate extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'nid',
        'vaccine_center_id',
        'status',
        'schedule_date'
    ];

    public function vaccineCenter(): BelongsTo
    {
        return $this->belongsTo(VaccineCandidate::class);
    }
}
