@extends('layouts.layout')
@section('title', 'User List')
@section('content')
<div class="col-12 card p-3 mb-2">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Articles</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>
                @forelse($user->userHasBlog as $article)
                    <a href="{{route('blog.show', $article->id)}}">{{ $article->title }}</a>
                @empty
                    aucun articles
                @endforelse
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{ $users }}
@endsection
