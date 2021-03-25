<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
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

    function stacks() {
        return $this->belongsToMany('App\Models\Stack', 'candidate_stacks');
    }
}
