@php $locale = session()->get('locale') @endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" defer></script>
    <title>{{ config('app.name') }} | @yield('title')</title>
    <link rel="icon" type="image/gif" href="/favicon.ico"/>
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css"
    rel="stylesheet"
    />
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">@lang('lang.text_hello') {{ Auth::user() ? Auth::user()->name : "Guest" }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="{{route('blog.index')}}">Blog</a>
                @guest
                    <a class="nav-link" href="{{route('auth.create')}}">@lang('lang.text_registration')</a>
                    <a class="nav-link" href="{{route('login')}}">@lang('lang.text_login')</a>
                @else
                    @can('edit-users')<a class="nav-link" href="{{route('user.list')}}">@lang('lang.text_user-list')</a>@endcan
                    <a class="nav-link" href="{{route('logout')}}">@lang('lang.text_logout')</a>
                @endguest
            </div>
        </div>
        @if($locale == 'fr')
            <a class="nav-link" href="{{ route('lang', 'en') }}"><i class="flag flag-united-kingdom"></i> EN</a>     
        @else
            <a class="nav-link" href="{{ route('lang', 'fr') }}"><i class="flag flag-france"></i> FR</a>
        @endif

        </div>
    </nav>
    <div class="container">
        <div class="row">
            <header class="col-12 text-center pt-2">
                <h1 class="display-4">{{ config('app.name') }}</h1>
            </header>
        </div>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <hr>
        @yield('content')
    </div>
</body>
</html>