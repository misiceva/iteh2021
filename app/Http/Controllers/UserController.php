<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * User auth
     *
     * @return \Illuminate\Http\Response
     */
    public function auth()
    {
        $data = json_decode(\request()->getContent());
        if(!property_exists($data,'username') || !property_exists($data,'password')) {
            return ['error'=> false, 'code'=>101, 'message'=>'Both username and password are required!'];
        }

        $user = User::where('username', $data->username)
                    ->where('password', md5($data->password))
                    ->get();
        
        if($user->isEmpty()){
            return ['error'=> false, 'code'=>101, 'message'=>'Username or password are wrong!'];
        } 

        $random_token = Str::random(40);

        $token = new Token();
        $token->token = $random_token;
        $token->save();

        return $token;


        
    }

}
