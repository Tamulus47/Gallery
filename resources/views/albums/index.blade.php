<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Albums</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>

    a{
        text-decoration: none;
    }

    .btn{
        text-decoration: none;
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .popup {
        display: none;
        position: fixed;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 5px;
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
        padding: 20px;
        max-width: 300px;
        text-align: center;
    }

    .popup-buttons {
        margin-top: 20px;
    }

    .popup-button {
        cursor: pointer;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 3px;
        padding: 10px 20px;
        margin: 0 10px;
        transition: background-color 0.3s;
    }

    .popup-button:hover {
        background-color: #0056b3;
    }

    .close-popup-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        background-color: transparent;
        border: none;
        color: #555;
        font-size: 20px;
    }

    .close-popup-btn:hover {
        color: #333;
    }

    .show-popup-btn {
        cursor: pointer;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 3px;
        padding: 10px 20px;
        margin-top: 20px;
        transition: background-color 0.3s;
    }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="popup" class="popup">
        <button onclick="hidePopup()" class="close-popup-btn">&times;</button>
        <p>This album is not empty.</p>
        <div class="popup-buttons">
            <a onclick="chooseOption()" class="popup-button">remove</a>
            <a id="move" class="popup-button">move</a>
        </div>
    </div>
    <a href="{{ route('albums.create') }}" class="btn">create</a>
    <table>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>actions</th>
        </tr>
        @foreach ($albums as $album)
            <tr>
                <td>{{ $album->id }}</td>
                <td><a href="{{ route('albums.show', $album->id) }}">{{ $album->name }}</a></td>
                <td>
                    <a href="{{ route('albums.edit', $album->id) }} " class="show-popup-btn">Edit</a>
                    <button onclick="showPopup({{ $album->id }})" class="show-popup-btn">Delete</button>
                </td>
            </tr>
        @endforeach
    </table>

    <script>
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var album_id = 0;

    function showPopup(id) {
        var popup = $("#popup");

        $.ajax({
        url: '/albums/album',
        method: 'POST',
        data: { id: id },
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function(result){
            if(result.data.length === 0){
                $.ajax({
                    url: '/albums/destroy',
                    method: 'POST',
                    data: { id: id },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(result){
                        window.location.reload();
                    }
                })
            }else{
                popup.css("display", "block");
                $("#move").attr("href", "{{ route('albums.move', '') }}/" + id);
            }
        }});
        album_id = id;
    }

    function hidePopup() {
        var popup = document.getElementById("popup");
        popup.style.display = "none";
    }

    function chooseOption() {
        $.ajax({
            url: '/albums/destroy',
            method: 'POST',
            data: { id: album_id },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(result){
                window.location.reload();
            }
        })
        hidePopup();
    }
    </script>
</body>
</html>