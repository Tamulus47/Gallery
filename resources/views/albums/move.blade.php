<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pictures transfer</title>
</head>
<body>
    <form enctype="multipart/form-data" method="POST" action="{{ route('albums.transfer', $id) }}">
        @csrf
        <lable>Move Pictures To</lable>
        <select name="transfer_to" required>
            @foreach ($albums as $album)
                <option value="{{ $album->id }}">{{ $album->name }}</option>
            @endforeach
        </select><br>
        <button>Transfer</button>
    </form>
</body>
</html>