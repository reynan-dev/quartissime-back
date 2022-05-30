<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{

    protected $guarded =['id'];


    use HasFactory;

    public function files(): HasMany {
        return $this->hasMany(EventFile::class);
    }
}
