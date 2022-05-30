<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{    
    protected $fillable = [
        'extension',
        'url',
        'committee_id',
    ];
}
