<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Committee extends Model
{
    protected $fillable = [
        'name',
        'adress',
        'adress_public',
        'website',
        'facebook',
        'president_name',
        'email',
        'tel',
        'description',
    ];

    use HasFactory;

    public function photos(): HasMany {
        return $this->hasMany(CommitteePhoto::class);
    }

    public function users(): HasMany {
        return $this->hasMany(CommitteeUser::class);
    }

}
