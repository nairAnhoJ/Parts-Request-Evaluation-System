<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandModel;
use App\Models\Customer;
use App\Models\EvaluationDetails;
use App\Models\EvaluationForm;
use App\Models\Log;
use App\Models\Part;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EvaluationFormController extends Controller
{
    public function index(Request $request){
        $perPage = 50;
        $page = $request->input('page', 1);
        $search = $request->input('search');

        $forms = EvaluationForm::with('details', 'customer')
            ->where('is_deleted', 0)
            ->where(function ($query) use ($search) {
                $query->whereRaw("CONCAT_WS(' ', number, control_number, fsrr_number, brand, model, serial_number, hm, technician, sq_number, encoder, date_received) LIKE ?", ['%' . $search . '%'])
                      ->orWhereHas('details', function ($query) use ($search) {
                          $query->whereRaw("CONCAT_WS(' ', part_number, description) LIKE ?", ['%' . $search . '%']);
                      })
                      ->orWhereHas('customer', function ($query) use ($search) {
                            $query->whereRaw("CONCAT_WS(' ', name, address, area) LIKE ?", ['%' . $search . '%']);
                      });
            })
            ->paginate($perPage, ['*'], 'page', $page);

        return view('user.evaluation-forms.index', compact('forms', 'search'));
    }

    public function add(){
        // dd(Str::uuid() . '  ' . date('Y-m-d H:i:s'));
        $customers = Customer::where('is_deleted', 0)->get();
        $brands = Brand::where('is_deleted', 0)->get();
        $models = BrandModel::where('brand_id', 1)->where('is_deleted', 0)->get();
        $parts = Part::paginate(50);

        return view('user.evaluation-forms.add', compact('customers', 'brands', 'models', 'parts'));
    }

    public function store(Request $request){
        // dd($request);
        $validator = Validator::make($request->all(), [
            'number' => 'required',
            'control_number' => 'required',
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
            $customer->name = strtoupper($name);
            $customer->address = strtoupper($address);
            $customer->area = strtoupper($area);
            $customer->save();
        }else{
            $customer = new Customer();
            $customer->name = strtoupper($name);
            $customer->address = strtoupper($address);
            $customer->area = strtoupper($area);
            $customer->key = Str::uuid();
            $customer->save();
        }
        $counter = $request->counter;
        $number = $request->number;
        $control_number = $request->control_number;
        $customer_id = $customer->id;
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
        $new_evaluation->originator = Auth::user()->name;
        $new_evaluation->datetime_originated = date('Y-m-d H:i:s');
        $new_evaluation->date_received = $date_received;
        $new_evaluation->key = Str::uuid();
        $new_evaluation->save();

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

    public function edit(Request $request){
        $customers = Customer::where('is_deleted', 0)->get();
        $brands = Brand::where('is_deleted', 0)->get();
        $models = BrandModel::where('brand_id', 1)->where('is_deleted', 0)->get();
        $form = EvaluationForm::with('details', 'customer')->where('key', $request->key)->first();
        $parts = Part::paginate(50);

        return view('user.evaluation-forms.edit', compact('customers', 'brands', 'models', 'form', 'parts'));
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'number' => 'required',
            'control_number' => 'required',
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
            $customer->name = strtoupper($name);
            $customer->address = strtoupper($address);
            $customer->area = strtoupper($area);
            $customer->save();
        }else{
            $customer = new Customer();
            $customer->name = strtoupper($name);
            $customer->address = strtoupper($address);
            $customer->area = strtoupper($area);
            $customer->key = Str::uuid();
            $customer->save();
        }
        $counter = $request->counter;
        $number = $request->number;
        $control_number = $request->control_number;
        $customer_id = $customer->id;
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

        $evaluation = EvaluationForm::where('key', $request->key)->first();
        $evaluation->number = $number;
        $evaluation->control_number = $control_number;
        $evaluation->customer_id = $customer_id;
        $evaluation->fsrr_number = $fsrr_number;
        $evaluation->brand = $brand;
        $evaluation->model = $model;
        $evaluation->serial_number = $serial_number;
        $evaluation->hm = $hm;
        $evaluation->technician = $technician;
        $evaluation->working_environment = $working_environment;
        $evaluation->status = $status;
        $evaluation->disc = $disc;
        $evaluation->remarks = $remarks;
        $evaluation->date_received = $date_received;

        $dirtyAttributes = $evaluation->getDirty();

        foreach($dirtyAttributes as $attribute => $newValue){
            $oldValue = $evaluation->getOriginal($attribute);

            $field = ucwords(str_replace('_', ' ', $attribute));

            $newLog = new Log();
            $newLog->table = 'FORMS';
            $newLog->table_key = $request->key;
            $newLog->action = 'UPDATE';
            $newLog->description = $evaluation->number;
            $newLog->field = $field;
            $newLog->before = $oldValue;
            $newLog->after = $newValue;
            $newLog->user_id = Auth::user()->id;
            $newLog->save();
        }
        $evaluation->save();

        EvaluationDetails::where('evaluation_id', $evaluation->id)->delete();

        for($i = 1; $i <= $counter; $i++){
            $part_number = 'part_number_'.$i;
            $description = 'description_'.$i;
            $quantity = 'quantity_'.$i;
            $price = 'price_'.$i;

            if($request->$description != null || $request->$description != ''){
                $details = new EvaluationDetails();
                $details->evaluation_id = $evaluation->id;
                $details->part_number = $request->$part_number;
                $details->description = $request->$description;
                $details->quantity = $request->$quantity;
                $details->unit_price = $request->$price;
                $details->save();
            }
        }

        return redirect()->route('form.index')->with('success', 'Success');
    }

    public function getForm(Request $request){
        $key = $request->key;
        $form = EvaluationForm::with('details', 'customer', 'brand')->where('key', $key)->first();
        $logs = Log::with('user')->where('table_key', $key)->get();

        $logRes = '';

        foreach($logs as $log){
            $logRes .= '
                <div class="text-sm mt-2">
                    <div class="flex justify-between bg-gray-200 px-1.5 py-0.5">
                        <p class="font-semibold">'.$log->created_at.'</p>
                        <p>'.$log->user->name.'</p>
                    </div>
                    <div id="logsDiv" class="pl-7">
                        <div>
                            • <span>'.ucfirst(strtolower($log->action)).'</span> <span>'.ucwords(strtolower($log->field)).'</span>: <span></span><span>'.$log->before.'</span> ⇒ <span>'.$log->after.'</span>
                        </div>
                    </div>
                </div>
            ';
        }

        $response = [
            "form" => $form,
            "logRes" => $logRes
        ];

        echo json_encode($response);
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

    public function searchParts(Request $request){
        $parts = Part::whereRaw("CONCAT_WS(' ', partno, partname, brand) LIKE '%{$request->searchValue}%'")->paginate(50);
        $partsTotal = $parts->total();

        $partsUl = '';

        foreach($parts as $part){
            $partsUl .= '
                <li data-partno="'.$part->partno.'" data-partname="'.$part->partname.'" data-price="'.$part->price.'" class="pl-2 py-2 pr-5 first:border-0 border-t border-gray-300 hover:bg-gray-200 cursor-pointer">
                '.$part->partno.' - '.$part->partname.'
                </li>
            ';
        }

        $response = [
            "partsUl" => $partsUl,
            "partsTotal" => $partsTotal,
        ];

        echo json_encode($response);
    }
}
