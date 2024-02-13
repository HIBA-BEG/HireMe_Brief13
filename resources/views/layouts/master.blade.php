<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />

    <title>Document</title>
</head>

<body>
    @include('partials.nav')
    <main>
        @yield('home')
        @yield('jobOffers')
    </main>
    @include('partials.footer')
    {{-- <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>

</html>
