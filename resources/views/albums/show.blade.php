<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Album</title>
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
</head>
<body>
    <form enctype="multipart/form-data" method="POST" action="{{ route('albums.upload', $album->id) }}">
        @csrf
        <lable>Pictures</lable>
        <input type="file" name="images[]" multiple><br>
        <button>Upload</button>
    </form>

    <table>
        <tr>
            @foreach ($photos as $photo)
                <td><p>{{ $photo->name }}</p>{{ $photo }}</td>
            @endforeach
        </tr>
    </table>
</body>
</html>