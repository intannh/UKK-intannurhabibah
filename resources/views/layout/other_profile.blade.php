<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/buildcss.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <style>
        @media (max-width: 768px) {
            .flex-container {
                flex-direction: column;
            }

            .fulwidth {
                width: 100%;
            }

            .fulheight {
                height: 100%;
            }
        }
    </style>
    @stack('cssjsexternal')
    <title>i - gallery | Other Profile</title>
</head>

<body>
    <!--nav-->
    @include('layout.navbar2')
    <!--end nav-->
    <!--nav-->
    @yield('content2')
    <!--end nav-->

    <script src="/node_modules/flowbite/dist/flowbite.min.js"></script>
</body>
@stack('footerjsexternal')
</html>