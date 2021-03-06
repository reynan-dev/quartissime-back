<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Association extends Model
{
    protected $table = "associations";
    protected $guarded =['id'];

   

    use HasFactory;

    public function committee(): BelongsTo {
        return $this->belongsTo(Committee::class);
    }

    public function photos(): HasMany {
        return $this->hasMany(AssociationPhoto::class);
    }

}
