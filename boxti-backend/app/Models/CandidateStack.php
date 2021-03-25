<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateStack extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'stack_id',
    ];
}
