<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\HasCompositePrimaryKeyTrait;

class CandidateStack extends Model
{
    use HasCompositePrimaryKeyTrait;
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'stack_id',
    ];

	protected $primaryKey = ['candidate_id','stack_id'];
    public $incrementing = false;

}
