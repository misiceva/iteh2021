<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::with('brand', 'type')->get();
        return $cars;
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return $id;
        $car = Car::destroy($id);
        if($car) {
            return ['error'=> false, 'code'=>101, 'message'=>'Car deleted!'];
        } else {
            return ['error'=> true, 'code'=>101, 'message'=>'Error while deleting car!'];
        }
    }
}
