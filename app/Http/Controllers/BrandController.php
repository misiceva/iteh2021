<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return $brands;
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = json_decode(\request()->getContent());
        if(!property_exists($data, 'name')) {
            return ['error'=> false, 'code'=>101, 'message'=>'Name does not exist!'];
        }

        $brand = new Brand();
        $brand->name = $data->name;
        $brand->save();

        return $brand;
    }

}
