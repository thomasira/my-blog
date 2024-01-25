@extends('layouts.layout')
@section('title', 'Article')
@section('content')

<section class="container">
    <div class="mb-4">
      <a href="{{ route('blog.index') }}" class="btn btn-success">Back</a>
      <a href="{{ route('blog.show-pdf', $blog['id']) }}" class="btn btn-primary">get the pdf</a>
    </div>
    <div class="row">
        <header class="col-12 text-center pt-2">
            <h2 class="font-weight-bold text-primary">{{ $blog['title'] }}</h2>
            <p>Category: <strong>{{ $blog['category'] }}</strong> </p>
        </header>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <p>{{ $blog['body'] }}</p>
            <p>Author: <strong>{{ $blog['author'] }}</strong></p>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <a href="{{ route('blog.edit', $blog['id']) }}" class="btn btn-primary">Edit</a>
        </div>
        <div class="col-6">

            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Delete
            </button>
        </div>
    </div>

<div class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>

      </div>
    </div>
  </div>
</div>


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete post</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this post?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form method=post>
            @method('delete')
            @csrf
            <input class="btn btn-danger" type="submit" value="delete">
        </form>
      </div>
    </div>
  </div>
</div>
</section>
@endsection
