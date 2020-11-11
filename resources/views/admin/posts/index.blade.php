@extends('layouts.app')

@section('content')
    <div class="container">
        
        <h1>{{ $article->title }}</h1>

        <div>
            <img src="{{ asset('storage/' . $article->image) }}" alt="">
        </div>

        <div>
            {{ $article->content }}
        </div>
    </div>
@endsection
