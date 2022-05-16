<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommitteePhoto extends Model
{
    protected $fillable = [
        'extension',
        'url',
        'association_id',
    ];

    protected $table = 'committee_photos';

    use HasFactory;

    public function committee(): BelongsTo {
        return $this->belongsTo(Committee::class);
    }
}
