<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function getCreatedAtAttribute($date) {
        return Carbon::parse($date)->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtAttribute($date) {
        return Carbon::parse($date)->format('d/m/Y H:i:s');
    }

    public function getDeletedAtAttribute($date) {
        return Carbon::parse($date)->format('d/m/Y H:i:s');
    }
}
