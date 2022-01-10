<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        return $types;
    }

    public function create()
    {
        $data = json_decode(\request()->getContent());
        if(!property_exists($data, 'name')) {
            return ['error'=> false, 'code'=>101, 'message'=>'Name does not exist!'];
        }

        $type = new Type();
        $type->name = $data->name;
        $type->save();

        return $type;
    }


   
}
