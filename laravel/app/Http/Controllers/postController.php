<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use Carbon\Carbon;
use App\Post;
use Illuminate\Support\Facades\Validator;

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
            if(!Storage::exists('localPhotos/')){
                Storage::makeDirectory('localPhotos/',0775,true);
            }
            //guarda a foto em uma variável como tipo 'file'.
            $file = $request->file('photo');
            //salva a foto na pasta 'localPhotos'.
            $path = $file->store('localPhotos');
            //adiciona a imagem de entrada a este novo post.
            $post->photo = $file;
        }

        //adiciona o título de entrada a este novo post.
        $post->title = $request->title;
        //adiciona o texto de entrada a este novo post.
        $post->text = $request->text;
        //adiciona a tag de entrada a este novo post(categoria do post).
        $post->tag = $request->tag;
        
        
        //Está dando erro

        //coleta a data e a hora do exato momento de execução.
        // $dt = Carbon::now();
        // //seta para o fuso horário de São Paulo.
        // $dt->timezone = 'America/Sao_Paulo';
        // //adiciona a data/hora da postagem a este novo post.
        // $post->time = $dt->formatLocalized('%A, %d de %B de %Y - %H:%M');
        //salva este novo post no banco de dados.
        $post->save();

        return response()->json([$post]);
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

    public function show($id)
    {
        //
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
        //
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
