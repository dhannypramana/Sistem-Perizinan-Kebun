<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $service }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .pdf {
            width: 100%;
            height: 100vh;
        }
    </style>
</head>

<body>
    <iframe class="pdf" src="{{ asset($path) }}" frameborder="0"></iframe>
</body>

</html>
