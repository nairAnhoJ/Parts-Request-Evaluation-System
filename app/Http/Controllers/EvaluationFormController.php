<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandModel;
use App\Models\Customer;
use App\Models\EvaluationForm;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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


    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'area' => 'required',
            'address' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->with('error', "Oops! It seems like you missed a few required fields.")->withInput();
        }

        $name = $request->name;
        $address = $request->address;
        $area = $request->area;
        $customer = Customer::where('name', $name)->first();
        if($customer){
            $customer_id = $customer->id;
        }else{
            $new_customer = new Customer();
            $new_customer->name = $name;
            $new_customer->address = $address;
            $new_customer->area = $area;
            $new_customer->save();
        }
        dd($request);
    }


    public function getCustomer(Request $request){
        $customer = Customer::where('id', $request->id)->where('is_deleted', 0)->first();

        $result = array(
            'address' => $customer->address,
            'area' => $customer->area,
        );

        echo json_encode($result);
    }


    public function getModel(Request $request){
        $models = BrandModel::where('brand_id', $request->id)->where('is_deleted', 0)->get();

        $result = '';

        foreach($models as $model){
            $result .= '
                <li class="p-2 first:border-0 border-t border-gray-300 hover:bg-gray-200 cursor-pointer">'.$model->name.'</li>
            ';
        }

        echo $result;
    }
}
