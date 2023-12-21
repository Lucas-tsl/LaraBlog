<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(User $user) // récupération de l'utilisateur 
    {
        // On récupère les articles publiés de l'utilisateur
        $articles = Article::where('user_id', $user->id)->where('draft', 0)->get();

        // On retourne la vue
        return view('public.index', [
            'articles' => $articles,
            'user' => $user
        ]);
    }
    public function show(User $user, Article $article)
    {
        // On vérifie que l'article est publié
        if ($article->draft == 0) {
            // On retourne la vue
            return view('public.show', [
                'article' => $article,
                'user' => $user
            ]);
        } else {
        // Si l'article n'est pas publié, on affiche une erreur 404
        abort(403);
        }
    }

}
