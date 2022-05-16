<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscriber extends Model
{
    protected $fillable = [
        'name',
        'email',
        'adress',
    ];

    use HasFactory;

    public function subscription(): BelongsTo {
        return $this->belongsTo(Subscription::class);
    }
}
