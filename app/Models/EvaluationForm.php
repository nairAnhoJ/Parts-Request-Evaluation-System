<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationForm extends Model
{
    use HasFactory;
    
    protected $table = 'pres_evaluation_forms';

    public function details(){
        return $this->hasMany(EvaluationDetails::class, 'evaluation_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
