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
                    <ul>
                    @forelse($user->userHasBlog as $article)
                        <li><a href="{{route('blog.show', $article->id)}}">{{ $article->title }}</a></li>
                    @empty
                        <li> aucun articles</li>
                    @endforelse
                    </ul>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{ $users }}
@endsection
