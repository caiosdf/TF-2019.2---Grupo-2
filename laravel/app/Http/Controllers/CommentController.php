<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Comment;

class CommentController extends Controller
{
    
    public function store(Request $request){
        $comment = new Comment();
        $comment->text = $request->text;
        //coleta a data e a hora do exato momento de execução.
        //$dt = Carbon::now();
        //seta para o fuso horário de São Paulo.
        //$dt->timezone = 'America/Sao_Paulo';
        //adiciona a data/hora da postagem a este novo post.
        //$comment->time = $dt->formatLocalized('%A, %d de %B de %Y - %H:%M');
        $comment->save();
        
    }
}
