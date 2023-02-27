<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\CarPark;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreCarParkRequest;
use App\Http\Requests\UpdateCarParkRequest;

class CarParkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index', [
            "title" => "N Parking"
        ]);
    }

    public function store(Request $request)
    {
        if(Record::where('plate', $request->plate)->exists())
        {
            $request['status'] = Record::where('plate', $request->plate)->orderby('id','desc')->first()->is_parked;
            $validated = $request->validate([
                'plate' => ['required', 'regex:/^[A-Z]{1,2}\s{1}\d{1,4}\s{1}[A-Z]{1,3}$/'],
                'status' =>[
                    Rule::notIn(['Is Parked'])
                ]
            ]);
        }else
        {
            $validated = $request->validate([
                'plate' => ['required', 'regex:/^[A-Z]{1,2}\s{1}\d{1,4}\s{1}[A-Z]{1,3}$/'],
            ]);
        }

        do{
            $code = Str::random(15);
        }while(Record::where('code', $code)->first());
        $validated['code'] = $code;

        Record::create($validated);
        $request->session()->flash('code', $validated['code']);
        return redirect('/');
    }

    public function cost(Request $request)
    {
        $car_log = Record::where('code', $request->code)->first();
        if($car_log->is_parked == 'Has exited')
        {
            $request->session()->flash('code', 'Has exited');
            return redirect('/');
        }
        $start_time = Carbon::parse($car_log->created_at);
        $end_time = Carbon::now();
        
        $cost = ceil($end_time->diffInMinutes($start_time)/60) * 3000;

        $return = [
            'code' => $request->code,
            'cost' => $cost,
            'plate' => $car_log->plate
        ];
        
        $request->session()->flash('return_info', $return);
        return redirect('/');
    }

    public function record(Request $request)
    {
        $validated = $request->validate([
            'amount_paid' => ['required','gte:parking_cost'],
            'plate' => ['required'],
            'parking_cost' => ['required'],
            'code' => ['required']
        ]);
        $record = Record::where('code', $request->code)->firstOrFail();
        $record->exit_time = Carbon::now()->toDateTimeString();
        $record->amount_paid = $request->amount_paid;
        $record->parking_cost = $request->parking_cost;
        $record->is_parked = 'Has exited';

        $record->save();

        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarParkRequest  $request
     * @param  \App\Models\CarPark  $carPark
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarParkRequest $request, CarPark $carPark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarPark  $carPark
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarPark $carPark)
    {
        //
    }
}
