<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\User;
use DB;

class PassportController extends Controller
{
    public $successStatus = 200;

    public function login( Request $request){

        $fields = [
    		'email' => $request->email,
    		'password' => $request->password,
        ];
        
        $access = Auth::attempt( $fields );

        //verifica se o usuário está cadastrado no banco de dados. Se sim, o concede um token de acesso.
        if ( $access ){
        
            $user = Auth::user(); 
            $success['token'] = $user -> createToken('MyApp') -> accessToken;
            return response() -> json([
                'message' => 'Usuário '.$user->name.' logado com sucesso!',
                'data' => $success
            ], $this -> successStatus);
        }

        else {

            return response() -> json (['error' => 'Unauthorized'], 401); // retorna um erro caso o usuário não esteja cadastrado. 
        }
    }




}
