@extends('layouts.layout')
@section('title', 'Index')
@section('content')
    <div class="row">
        <div class="col-8">
            <p>@lang('lang.text_add-title')</p>
        </div>
        <div class="col-4">
            <a href="{{ route('blog.create') }}" class="btn btn-primary">@lang('lang.text_add-button')</a>      
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <section class="card">
                <header class="card-header">
                    <h4>Lister les articles</h4>
                </header>
                <div class="card-body">
                    <ul>
                    @forelse($blog as $article)
                        <li><a href="{{ route('blog.show', $article['id']) }}">{{ $article['title'] }}</a></li>
                    @empty
                        <li><h4 class="text-danger">Aucun article disponible</h4></li>
                    @endforelse
                    </ul>
                </div>
            </section>
        </div>
    </div>
@endsection
