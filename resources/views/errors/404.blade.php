<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>404 - Page Not Found</title>

    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">

    <style>
        .container-fluid {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

</head>

<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <div class="text-center">
                        <div class="error mx-auto" data-text="404">404</div>
                        <p class="lead text-gray-800 mb-5">Page Not Found</p>
                        <p class="text-gray-500 mb-0">There's something wrong</p>
                        <p class="text-gray-500 mb-0">or, the page that you're looking for is not exist.</p>
                        <a href="javascript:history.back()" class="btn btn-secondary mt-3">
                            <img src="{{ asset('assets/images/svg/arrow_left.svg') }}">
                            <span>Kembali</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
</body>

</html>
