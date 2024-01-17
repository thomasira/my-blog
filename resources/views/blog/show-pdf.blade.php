<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pdf file</title>
</head>
<body>
    <style>
        body{
            background-color: #c0d6e4;
            margin: 0;
            padding: 20px;
            font-family: sans-serif;
        }
    </style>
    <header>
        <h2>{{ $blogPost->title }}</h2>
        <p>Category: <strong>{{ $blogPost->blogHasCategory ? $blogPost->blogHasCategory->category : 'no category' }}</strong> </p>
    </header>
    <hr>
    <p>
        {!! $blogPost->body !!}
    </p>
    <p>Author: <strong>{{ $blogPost->blogHasUser->name }}</strong></p>
</body>
</html>
