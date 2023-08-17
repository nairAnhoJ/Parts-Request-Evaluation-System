<?php

namespace App\Http\Controllers;

use App\Models\EvaluationForm;
use Illuminate\Http\Request;

class EvaluationFormController extends Controller
{
    public function index(){
        $forms = EvaluationForm::where('is_deleted', 0)->get();

        return view('user.evaluation-forms.index', compact('forms'));
    }
    public function add(){
        return view('user.evaluation-forms.add');
    }
}
