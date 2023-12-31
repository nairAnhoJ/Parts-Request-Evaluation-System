<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    protected $table = 'customers';

    public function form(){
        return $this->hasMany(EvaluationForm::class, 'customer_id');
    }
}
