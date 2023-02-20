<?php

namespace App\Http\Controllers;

use App\Models\CarPark;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
            "title" => "Input Plate Info"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarParkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'plate' => ['required','unique:car_parks'],
        ]);
        $validated['code'] = Str::random(15);

        CarPark::create($validated);
        $request->session()->flash('code', $validated['code']);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarPark  $carPark
     * @return \Illuminate\Http\Response
     */
    public function cost(Request $request)
    {
        $car_log = CarPark::where('code', $request->code)->firstOrFail();
        $start_time = Carbon::parse($car_log->created_at);
        $end_time = Carbon::now();
        $cost = $end_time->diffInHours($start_time) * 3000;

        $return = [
            'code' => $request->code,
            'cost' => $cost
        ];
        
        
        $request->session()->flash('return_info', $return);
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarPark  $carPark
     * @return \Illuminate\Http\Response
     */
    public function edit(CarPark $carPark)
    {
        //
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
