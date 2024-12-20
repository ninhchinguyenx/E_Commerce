<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-3">
        <div class="row border shadow-sm rounded">
            <div class="col-md-12 col-lg-6 overflow-hidden">
                <img src="https://4kwallpapers.com/images/walls/thumbs_3t/20230.jpg" alt="img" class="object-fit-cover ">
            </div>
            <div class="col-md-12 col-lg-6 p-3 d-flex flex-column justify-content-center">
                @yield('content')                   
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>