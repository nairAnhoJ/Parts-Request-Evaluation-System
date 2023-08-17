<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationForm extends Model
{
    use HasFactory;
    
    protected $table = 'pres_evaluation_forms';

    public function evaluationDetails(){
        return $this->hasMany(EvaluationDetails::class);
    }
}
