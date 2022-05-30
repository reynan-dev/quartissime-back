<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Committee extends Model
{
    protected $guarded =['id'];


    use HasFactory;

    public function photos(): HasMany {
        return $this->hasMany(CommitteePhoto::class);
    }

    public function users(): HasMany {
        return $this->hasMany(CommitteeUser::class);
    }

    public function associations(): HasMany {
        return $this->hasMany(Association::class);
    }
    
}
