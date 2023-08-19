<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandModel;
use App\Models\Customer;
use App\Models\EvaluationDetails;
use App\Models\EvaluationForm;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // dd($request);
        $validator = Validator::make($request->all(), [
            'number' => 'required',
            'control_number' => 'required',
            'sq_number' => 'required',
            'name' => 'required',
            'area' => 'required',
            'address' => 'required',
            'brand' => 'required',
            'address' => 'required',
            'model' => 'required',
            'serial_number' => 'required',
            'fsrr_number' => 'required',
            'date_received' => 'required',
            'technician' => 'required',
            'working_environment' => 'required',
            'part_number_1' => 'required',
            'description_1' => 'required',
            'quantity_1' => 'required',
            'price_1' => 'required',
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
            $new_customer->name = strtoupper($name);
            $new_customer->address = strtoupper($address);
            $new_customer->area = strtoupper($area);
            $new_customer->key = Str::uuid();
            $new_customer->save();
        }
        $counter = $request->counter;
        $number = $request->number;
        $control_number = $request->control_number;
        $sq_number = $request->sq_number;
        $customer_id = $new_customer->id;
        $brand = $request->brand;
        $model = $request->model;
        $serial_number = $request->serial_number;
        $fsrr_number = $request->fsrr_number;
        $date_received = $request->date_received;
        $technician = $request->technician;
        $hm = $request->hm;
        $disc = $request->disc;
        $working_environment = $request->working_environment;
        $status = $request->status;
        $remarks = $request->remarks;

        $new_evaluation = new EvaluationForm();
        $new_evaluation->number = $number;
        $new_evaluation->control_number = $control_number;
        $new_evaluation->customer_id = $customer_id;
        $new_evaluation->fsrr_number = $fsrr_number;
        $new_evaluation->brand = $brand;
        $new_evaluation->model = $model;
        $new_evaluation->serial_number = $serial_number;
        $new_evaluation->hm = $hm;
        $new_evaluation->technician = $technician;
        $new_evaluation->working_environment = $working_environment;
        $new_evaluation->status = $status;
        $new_evaluation->disc = $disc;
        $new_evaluation->remarks = $remarks;
        $new_evaluation->sq_number = $sq_number;
        $new_evaluation->encoder = Auth::user()->name;
        $new_evaluation->date_received = $date_received;
        $new_evaluation->key = Str::uuid();
        $new_evaluation->save();

        $x = 1;
        for($i = 1; $i <= $counter; $i++){
            $part_number = 'part_number_'.$i;
            $description = 'description_'.$i;
            $quantity = 'quantity_'.$i;
            $price = 'price_'.$i;

            if($request->$description != null || $request->$description != ''){
                $details = new EvaluationDetails();
                $details->evaluation_id = $new_evaluation->id;
                $details->part_number = $request->$part_number;
                $details->description = $request->$description;
                $details->quantity = $request->$quantity;
                $details->unit_price = $request->$price;
                $details->save();
            }
        }

        return redirect()->route('form.index')->with('success', 'Success');
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
