<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventFile extends Model
{
    protected $fillable = [
        'extension',
        'url',
        'event_id',
    ];

    protected $table = 'event_files';


    use HasFactory;

    public function event(): BelongsTo {
        return $this->belongsTo(Event::class);
    }
}
