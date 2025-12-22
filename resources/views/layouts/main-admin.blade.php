<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/main1.css') }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        a,
        a:hover {
            text-decoration: none;
        }

        #menu {
            font-family: 'Montserrat', serif !important;
            font-size: 18px;
            color: white;
            background-color: #002244;
            height: 50px;
            text-align: right;
            display: flex;
            flex-wrap: nowrap;
            flex-direction: row;
            align-items: center;
            justify-content: space-evenly
        }

        #menu a {
            color: white;
            padding: 5px;
            text-decoration: none;
            text-align: center;
            right: 5px;
            font-size: 16.5px;
            font-family: var(--font-family);
        }

        .hd-logo a:hover {
            text-decoration: none
        }

        :root {
            --font-family: 'Montserrat', serif;
        }

        body {
            font-family: var(--font-family);
        }

        .spacing {
            margin: 2px 0;
        }

        button {
            text-decoration: none
        }
    </style>
</head>

<body>
    <!-- Header cố định -->
    <header>
        @include('layouts.headeradmin')
    </header>

    <!-- Phần nội dung thay đổi -->
    <main style="min-height: 680px;">
        @yield('content')
    </main>

    <!-- Footer cố định -->
    <footer class="mt-12">
        @include('layouts.footer')
    </footer>
</body>

</html>