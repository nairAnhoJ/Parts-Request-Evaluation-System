<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandModel;
use App\Models\Customer;
use App\Models\EvaluationForm;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluationFormController extends Controller
{
    public function index(){
        $forms = EvaluationForm::where('is_deleted', 0)->get();

        return view('user.evaluation-forms.index', compact('forms'));
    }

    public function add(){
        // dd(Str::uuid() . '  ' . date('Y-m-d H:i:s'));
        $customers = Customer::where('is_deleted', 0)->get();
        $brands = Brand::where('is_deleted', 0)->get();
        $models = BrandModel::where('brand_id', 1)->where('is_deleted', 0)->get();


        return view('user.evaluation-forms.add', compact('customers', 'brands', 'models'));
    }


    public function getCustomer(Request $request){
        echo $request->id;
    }
}
