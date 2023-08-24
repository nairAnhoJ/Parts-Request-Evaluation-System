<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationDetails extends Model
{
    use HasFactory;
    
    protected $table = 'pres_evaluation_details';

    public function form(){
        return $this->belongsTo(EvaluationForm::class, '');
    }
}
