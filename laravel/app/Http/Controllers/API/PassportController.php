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
            'password' => 'required'
        ]);

        //caso os dados de entrada não estejam como o esperado retorn um erro.
        if ($validator->fails()){
            return response() -> json(['error' => $validator -> errors()], 401);
        }

        $newUser = new User; //cria um novo objeto da classe User.
        $newUser->name = $request->name; //'seta' o nome deste novo usuário como o nome de entrada.
        $newUser->email = $request->email; //'seta' o e-mail deste novo usuário como o -email de entrada.
        $newUser->password = bcrypt($request->password); // 'seta' a senha deste novo usuário como a senha de entrada encriptada.

        //'seta' a imagem padrão de usuário.
        $imgName = 'userDefault.png';

        //atribui ao atributo 'photo' de user, o nome desta imagem.
        $newUser->photo = $imgName;

        $newUser->save(); //salva os dados deste usuário no banco de dados.
       
        $success['token'] = $newUser->createToken('MyApp')->accessToken; //cria e concede um token de acesso a este novo usuário.
        $success['name'] = $newUser->name; //'seta' o nome associado a este token como  o nome deste usuário.
        

        
        return response() ->json([
            'message' => 'Bem-vindo ao Blogroll, '.$newUser->name.'.',
            'data' => $success
        ], $this -> successStatus);


    }

    public function downloadPhoto($id)
    {
        $user = User::findOrFail($id);
        $path = storage_path().'\app/localPhotos/user/'.$user->photo;
        return response()->download($path);
    }

    public function update(Request $request){
        $user = Auth::user();
        
        if($request->name){
            $user->name = $request->name;
        }
        if($request->email){
            $user->email = $request->email;
        }
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        if($request->photo){

            Storage::delete('/app/localPhotos/user/'.$user->photo);
                
            //verifica se há uma pasta chamada 'localPhotos'e caso não haja, cria uma para melhor organizar o repositório.
            if(!Storage::exists('localPhotos/user')){
                Storage::makeDirectory('localPhotos/user',0775,true);
            }
            //guarda a foto em uma variável já decodificada.
            $image = base64_decode($request->photo);
            //salva em uma variável um nome único com extensão .png para esta foto.
            $imgName = uniqid() . '.png';
            //salva o caminho 'localPhotos/user' na variável '$path'.
            $path = storage_path('/app/localPhotos/user/' . $imgName);
            //adiciona a imagem ao diretório referenciado por '$path'.
            file_put_contents($path, $image);
            //atribui ao atributo 'photo' de user, o nome desta imagem de entrada.
            $user->photo = $imgName;
        }
        $user->save();
        return response()->json([$user]);

    }

    public function myPosts(){
        $user = Auth::user();
        $posts = $user->Posts();
        return response()->json([$posts]);
    }

    public function getDetails() {
        $user = Auth::user();
        return response() -> json([$user]); //retorna as informações do usuário logado
        
    }

    public function logout(){

        $accessToken = Auth::user()->token();

        DB::table('oauth_refresh_tokens')->where('access_token_id', $accessToken->id)->update([
        'revoked' => true
        ]);

        $accessToken->revoke();
        return response()->json( null, 204);
    }
}
