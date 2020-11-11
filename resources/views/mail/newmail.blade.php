@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 claa="my-4">Il tuo nuovo post è stato creato: {{ $article->title }}</h1>
    </div>
    
@endsection
