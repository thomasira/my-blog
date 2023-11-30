@extends('layouts.layout')
@section('title', 'Article')
@section('content')
<section class="container">
    <div class="row">
        <header class="col-12 text-center pt-2">
            <h2 class="font-weight-bold text-primary">{{ $blogPost->title }}</h2>
        </header>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <p>{{ $blogPost->body }}</p>
            <p>Author: <strong>{{ $blogPost->user_id }}</strong></p>
        </div>
    </div>
    <div>
        <a href="{{ route('blog.index') }}" class="btn btn-success">Back</a>
    </div>
</section>
@endsection
