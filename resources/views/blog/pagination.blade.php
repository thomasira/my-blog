@extends('layouts.layout')
@section('title', 'Pagination')
@section('content')
<div class="col-12 card p-3 mb-2">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
        </tr>
        </thead>
        <tbody>
        @foreach($blog as $article)
            <tr>
                <th scope="row">{{ $article->id }}</th>
                <td>{{ $article->title }}</td>
                <td>{{ $article->blogHasUser?->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!-- only works for paginate method->put object after paginate list -->
{{ $blog }}
@endsection
