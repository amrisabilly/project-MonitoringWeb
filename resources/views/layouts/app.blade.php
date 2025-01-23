{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Root')</title>

    <link rel="stylesheet" href="{{ asset('css/root.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    {{-- xls & pdf export --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>



    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .main-content {
            flex: 1;
        }
    </style>
</head>

<body>



    {{-- Side Navigation --}}
    <x-side-nav :folders="$folders" />

    <div class="main-content">
        {{-- Main Content --}}
        @yield('content')
        <div style="margin-bottom: 3em"></div>

    </div>
    {{-- Footer --}}
    <div style=" margin-left: 342px; padding: 20px 60px 20px 60px;">
        <hr style="margin: 0px">
        <div style="display: flex; justify-content: space-between;">
            <p style="opacity: 0.5">
                Sistem Monitoring Jaringan PT Jamu dan Farmaasi Sido Muncul
            </p>
            <p style="opacity: 0.25">
                Copyright © 2025 Sidomuncul - All Right Reserved
            </p>
        </div>
    </div>

    {{-- Menggunakan asset() untuk path JS yang dinamis --}}
    <script src="{{ asset('js/index.js') }}"></script>
</body>

</html>
