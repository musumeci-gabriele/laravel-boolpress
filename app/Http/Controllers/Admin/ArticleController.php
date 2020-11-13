<?php
// *inseriamo il file nella sotto cartella Admin e modifichiamo il namespace
namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;



class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $articles = Article::where('user_id', $user_id)->get();

        return view('admin.posts.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // * l'utente verra' reindirizzato al form di creazione
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // * validazione dei campi di inserimento "obligatori" del form
        $request->validate([
            "title" => "required",
            "slug" => "required|unique:articles",
            "content" => "required",
            "image" => "image"
        ]);

        $id = Auth::id();

        // * PATH restituisce il percorso da dove viene salvata l'img e lo inserisce nella nostra colonna dedicata in db recuperata dal form tramite il metodo PUT
        $path = Storage::disk('public')->put('images/$id', $data['image']);

        $newArticle = new Article;
        $newArticle->user_id = Auth::id();
        $newArticle->title = $data["title"];
        $newArticle->slug = $data["slug"];
        $newArticle->content = $data["content"];
        $newArticle->image = $path;

        $newArticle->save();

        // * Inviamo i dati via email
        Mail::to($newArticle->user->email)->send(new SendNewMail($newArticle));
        
        // * l'utente verra' reindirizzato alla pagina show di ricapitolazione
        return redirect()->route("admin.posts.show", $newArticle->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->first();
        return view('admin.posts.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
