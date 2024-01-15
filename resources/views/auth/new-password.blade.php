@extends('layouts.layout')
@section('title', 'New password')
@section('content')
<section class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <form method="post">
                @csrf
                    <div class="card-header text-center">
                        <h2>Create your new password</h2>
                    </div>
                    <div class="card-body">
                    @if(!$errors->isEmpty())
                        <ul class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    @endif
                        <div class="control-group d-grid gap-3">
                            <label class="col-12">Password
                                <input type="password" name="password" class="form-control">
                                @if($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </label>
                        </div>
                        <div class="control-group d-grid gap-3">
                            <label class="col-12">Confirm password
                                <input type="password" name="password_confirmation" class="form-control">
                            </label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Reset password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection