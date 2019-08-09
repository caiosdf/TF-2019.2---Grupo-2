<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
use App\User;

class PassportController extends Controller
{

    public $successStatus = 200;

    public function register(Request $request){

        //valida os dados de entrada.
        $validator = Validator::make($request -> all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //caso os dados de entrada não estejam como o esperado retorn um erro.
        if ($validator->fails()){
            return response() -> json(['error' => $validator -> errors()], 400);
        }

        $newUser = new User; //cria um novo objeto da classe User.
        $newUser->name = $request->name; //'seta' o nome deste novo usuário como o nome de entrada.
        $newUser->email = $request->email; //'seta' o e-mail deste novo usuário como o -email de entrada.
        $newUser->password = bcrypt($request->password); // 'seta' a senha deste novo usuário como a senha de entrada encriptada.
        $success['token'] = $newUser->createToken('MyApp')->accessToken; //cria e concede um token de acesso a este novo usuário.
        $success['name'] = $newUser->name; //'seta' o nome associado a este token como  o nome deste usuário.
        $newUser->save(); //salva os dados deste usuário no banco de dados. 
        return response() ->json(['success' => $success], $this -> successStatus);
    }
}
