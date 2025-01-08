<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- DataTables CSS and JQuery --}}
    @if(!empty($datatables))
        <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}">
        <script src="{{ asset('assets/datatables/jquery/jquery.min.js') }}"></script>
    @endif
</head>
<body>
    @include('nav')
    @yield('content')
    @include('footer')
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
    {{-- DataTables JS --}}
    @if(!empty($datatables))
        <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
    @endif
</body>
</html>