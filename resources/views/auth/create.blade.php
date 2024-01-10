@extends('layouts.layout')
@section('title', 'Create User')
@section('content')
<section class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <form method="post">
                @csrf
                    <div class="card-header text-center">
                        <h2>@lang('lang.text_user-add-title')</h2>
                    </div>
                    <div class="card-body">
                        <div class="control-group d-grid gap-3">
                            <label class="col-12">@lang('lang.form_user-name')
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </label>
                            <label class="col-12">@lang('lang.form_user-email')
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </label>
                            <label class="col-12">@lang('lang.form_user-password')
                                <input type="password" name="password" class="form-control">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">@lang('lang.form_user-submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
