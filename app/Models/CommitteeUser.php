<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommitteeUser extends Model
{
    protected $fillable = [
        'user_id',
        'committee_id',
    ];

    protected $table = 'committee_users';


    use HasFactory;

    public function committee(): BelongsTo {
        return $this->belongsTo(Committee::class);
    }}
