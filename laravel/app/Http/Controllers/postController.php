<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use Carbon\Carbon;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Validator;
use Auth;
use DD;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //cria um objeto da classe post.
        $post = new Post();
        //pega as informações do usuário logado
        $user = Auth::user();

        //valida o arquivo de entrada para que seja de fato uma imagem.
        $validator = Validator::make($request->all(), [
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        //verifica se existe um arquivo de entrada.
        if($request->hasfile('photo')){           
            
            //verifica se há uma pasta chamada 'localPhotos'e caso não haja, cria uma para melhor organizar o repositório.
            if(!Storage::exists('localPhotos/post')){
                Storage::makeDirectory('localPhotos/post',0775,true);
            }
            //guarda a foto em uma variável como tipo 'file'.
            $file = $request->file('photo');
            //salva o nome com o qual foi feito o upload da foto.
            $filename = $file->getClientOriginalName();
            //salva a foto na pasta 'localPhotos/post'.
            $path = $file->storeAs('localPhotos/post',$filename);
            //adiciona a imagem de entrada a este novo post.

            $post->photo = $path;

        }

        //adiciona o título de entrada a este novo post.
        $post->title = $request->title;
        //adiciona o texto de entrada a este novo post.
        $post->text = $request->text;
        //adiciona a tag de entrada a este novo post(categoria do post).
        $post->tag = $request->tag;
        //atribui o id do usuário logado ao post que ele está criando.
        $post->user_id = $user->id;
        //atribui o nome do usuário logado ao post que ele está criando.
        $post->user_name = $user->name;
        //$user->posts()->attach($post->id);
        $post->save();

        return response()->json([$post]);
        
        //Está dando erro

        //coleta a data e a hora do exato momento de execução.
        // $dt = Carbon::now();
        // //seta para o fuso horário de São Paulo.
        // $dt->timezone = 'America/Sao_Paulo';
        // //adiciona a data/hora da postagem a este novo post.
        // $post->time = $dt->formatLocalized('%A, %d de %B de %Y - %H:%M');
        //salva este novo post no banco de dados.

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getPosts(){
        
        return Post::all();
    
    } 

    public function downloadPhoto($id)
    {
        $post = Post::findOrFail($id);
        $path = storage_path().'\app/'.$post->photo;
        return response()->download($path);
    }

    public function postUser($id){
        $post = Post::find($id);
        $user = $post->postUser();
        return response()->json([$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if($request->title){
            $post->title = $request->title;
        }
        if($request->text){
            $post->text = $request->text;
        }
        if($request->tag){
            $post->tag = $request->tag;
        }
        if($request->photo){

            //verifica se existe um arquivo(foto) de entrada.
            if($request->hasfile('photo')){  

                Storage::delete($post->photo);
                
                //valida os dados de entrada.
                $validator = Validator::make($request -> all(), [
                    'photo' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
                ]);

                //caso os dados de entrada não estejam como o esperado retorn um erro.
                if ($validator->fails()){
                    return response() -> json(['error' => $validator -> errors()], 401);
                }
                
                //verifica se há uma pasta chamada 'localPhotos/post'e caso não haja, cria uma para melhor organizar o repositório.
                if(!Storage::exists('localPhotos/post')){
                    Storage::makeDirectory('localPhotos/post',0775,true);
                }
                //guarda a foto em uma variável como tipo 'file'.
                $file = $request->file('photo');
                //salva o nome com o qual foi feito o upload da foto.
                $filename = $file->getClientOriginalName();
                //salva a foto na pasta 'localPhotos/post'.
                $path = $file->storeAs('localPhotos/post',$filename);
                //adiciona a imagem de entrada a este novo post.
                $post->photo = $path;
            }
        }

        $post->save();

        return response()->json([$post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
