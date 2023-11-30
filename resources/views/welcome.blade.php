@extends('layouts.layout')
@section('title', 'Home')
@section('content')
<div class="row">
    <h2>Bienvenue sur notre Blog</h2>
    <div>
        <a href="{{ route('blog.index') }}" class="btn btn-outline-primary">Visitez nos articles</a>
    </div>
</div>
@endsection
