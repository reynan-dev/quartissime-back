<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssociationPhoto extends Model
{
    protected $fillable = [
        'extension',
        'url',
        'association_id',
    ];

    protected $table = 'association_photos';

    use HasFactory;

    public function association(): BelongsTo {
        return $this->belongsTo(Association::class);
    }
}
