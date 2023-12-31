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

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand');
    }

    public function validator(){
        return $this->belongsTo(User::class, 'validator');
    }

    public function approver(){
        return $this->belongsTo(User::class, 'approver');
    }

    public function encoder(){
        return $this->belongsTo(User::class, 'encoder');
    }
}
