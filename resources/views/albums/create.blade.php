<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>add album</title>
</head>
<body>
    <form enctype="multipart/form-data" method="POST" action="{{ route('albums.store') }}">
        @csrf
        <label>album name</label><br>
        <input type="text" name="name"><br>
        <input type="submit">
    </form>
</body>
</html>