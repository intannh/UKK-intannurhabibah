<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/build.css')}}" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat&family=Pacifico&display=swap" rel="stylesheet">
<style>
    @media(max-width:768px) {
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
<title>i-gallery | index</title>
</head>
<body>
<!--nav-->
@include('layout.navbar1')
<!--section gambar-->
@yield('content')
<!--end section gambar-->
<script src="/node_modules/flowbite/dist/flowbite.min.js"></script>
</body>
</html>
