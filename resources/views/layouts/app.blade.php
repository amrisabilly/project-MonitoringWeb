{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Root')</title>

    {{-- Menggunakan asset() untuk path CSS yang dinamis --}}
    <link rel="stylesheet" href="{{ asset('css/root.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>



    {{-- Side Navigation --}}
    <x-side-nav :folders="$folders" />

    <div class="main-content">
        {{-- Main Content --}}
        @yield('content')

        {{-- Footer --}}
        <div style="margin-top: 3em; width: 1050px;">
            <hr>
            <div style="display: flex; justify-content: space-between;">
                <p style="opacity: 0.5">
                    Sistem Monitoring Jaringan PT Jamu dan Farmaasi Sido Muncul
                </p>
                <p style="opacity: 0.25">
                    Copyright © 2025 Sidomuncul - All Right Reserved
                </p>
            </div>
        </div>
    </div>

    {{-- Menggunakan asset() untuk path JS yang dinamis --}}
    <script src="{{ asset('js/index.js') }}"></script>
</body>

</html>
