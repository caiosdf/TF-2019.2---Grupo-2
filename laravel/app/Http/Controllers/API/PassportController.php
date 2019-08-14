<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Auth;
use DB;
use App\User;

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

    public function register(Request $request){

        //valida os dados de entrada.
        $validator = Validator::make($request -> all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ]);

        //caso os dados de entrada não estejam como o esperado retorn um erro.
        if ($validator->fails()){
            return response() -> json(['error' => $validator -> errors()], 401);
        }

        $newUser = new User; //cria um novo objeto da classe User.
        $newUser->name = $request->name; //'seta' o nome deste novo usuário como o nome de entrada.
        $newUser->email = $request->email; //'seta' o e-mail deste novo usuário como o -email de entrada.
        $newUser->password = bcrypt($request->password); // 'seta' a senha deste novo usuário como a senha de entrada encriptada.

        //verifica se existe um arquivo(foto) de entrada.
        if($request->hasfile('photo')){           
            
            //verifica se há uma pasta chamada 'localPhotos'e caso não haja, cria uma para melhor organizar o repositório.
            if(!Storage::exists('localPhotos/user')){
                Storage::makeDirectory('localPhotos/user',0775,true);
            }
            //guarda a foto em uma variável como tipo 'file'.
            $file = $request->file('photo');
            //salva o nome com o qual foi feito o upload da foto.
            $filename = $file->getClientOriginalName();
            //salva a foto na pasta 'localPhotos'.
            $path = $file->storeAs('localPhotos/user',$filename);
            //adiciona a imagem de entrada a este novo post.

            $newUser->photo = $path;

        }

       
        $success['token'] = $newUser->createToken('MyApp')->accessToken; //cria e concede um token de acesso a este novo usuário.
        $success['name'] = $newUser->name; //'seta' o nome associado a este token como  o nome deste usuário.
        
        $newUser->save(); //salva os dados deste usuário no banco de dados. 
        
        return response() ->json([
            'message' => 'Bem-vindo ao Blogroll, '.$newUser->name.'.',
            'data' => $success
        ], $this -> successStatus);
    }

    public function downloadPhoto($id)
    {
        $user = User::findOrFail($id);
        $path = storage_path().'\app/'.$user->photo;
        return response()->download($path);
    }
}
