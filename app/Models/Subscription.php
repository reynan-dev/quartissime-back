<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    protected $fillable = [
        'subscriber_id',
        'committee_id',
    ];

    use HasFactory;

    public function subscriber(): BelongsTo {
        return $this->belongsTo(Subscriber::class);
    }}
