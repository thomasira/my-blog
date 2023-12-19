@extends('layouts.layout')
@section('title', 'Edit')
@section('content')
<section class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-4">
            <div class="card" >
                <form method="post">
                    @method('put')
                    @csrf
                    <div class="card-header text-center">
                        <h2>Modifier l'article:</h2>
                        <p>{{ $blogPost->title }}</p>
                    </div>
                    <div class="card-body col-12 ">
                        <div class="control-group d-flex flex-column">
                            <label>Title
                                <input type="text" id="title" name="title" class="form-control" value="{{ $blogPost->title }}">
                            </label>
                            <label>Content
                                <textarea name="body" id="body" cols="30" rows="10" placeholder="your message here..." class="form-control">{{ $blogPost->body }}"</textarea>
                            </label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <a href="{{ route('blog.show', $blogPost->id) }}" class="btn btn-primary">Back</a>
        </div>
    </div>
   
</section>
@endsection
