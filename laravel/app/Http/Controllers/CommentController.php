<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Comment;
use Auth;


class CommentController extends Controller
{
    
    public function store(Request $request,$id)
    {
        $user = Auth::user();
        if($user){

            $comment = new Comment();
            $comment->text = $request->text;
            $comment->post_id = $id;
            $comment->user_id = $user->id;
            $comment->user_name = $user->name;
            // coleta a data e a hora do exato momento de execução.
            // $dt = Carbon::now();
            // seta para o fuso horário de São Paulo.
            // $dt->timezone = 'America/Sao_Paulo';
            // adiciona a data/hora da postagem a este novo post.
            // $comment->time = $dt->formatLocalized('%A, %d de %B de %Y - %H:%M');
            $comment->save();

            return response()->json([$comment]);
        }
        
    }

    public function update(Request $request, $id){
        
        $user = Auth::user();
        $comment = Comment::find($id);
      
        if($user->id == $comment->user_id){
            
            if($request->text){
                $comment->text = $request->text;
            }

            $comment->save();

            return response()->json([$comment]);

        }
      
        else{
      
            return response()->json(['Você está autorizado a alterar somente seus próprios comentários.']);
      
        }
    }

    public function delete(Request $request, $id){
        
        Comment::destroy($id);
        return response()->json(['Comentário deletado!']);

    }


}
