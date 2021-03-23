<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelsCandidate extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'email',
        'cpf',
        'date_birth',
    ];

    protected $dates = ['deleted_at'];
}
