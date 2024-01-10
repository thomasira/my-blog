@extends('layouts.layout')
@section('title', 'Create')
@section('content')
<section class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('blog.store') }}" method="post">
                    @csrf
                    <div class="card-header text-center">
                        <h2>Ajouter un article</h2>
                    </div>
                    <div class="card-body">
                        <div class="control-group col-12">
                            <label>Title
                                <input type="text" id="title" name="title" class="form-control">
                            </label>
                            <label>Content
                                <textarea name="body" id="body" cols="30" rows="10" placeholder="your message here..." class="form-control"></textarea>
                            </label>
                        </div>
                        <div class="control-group col-12">
                            <label>Category
                                <select name="category_id">
                                    <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->category }}</option>
                                @endforeach
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <a href="{{ route('blog.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
   
</section>
@endsection
