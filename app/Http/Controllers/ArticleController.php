<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $articles = Article::all();

        return view('guest.posts.index', compact('articles'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $article = Article::where("slug", $slug)->first();

        return view('guest.posts.show', compact('article'));
    }
}
