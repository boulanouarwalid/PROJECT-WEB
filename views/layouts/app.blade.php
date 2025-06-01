<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AcademiQ - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Ton CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @auth
    {{-- Dynamic navbar based on current route prefix --}}
    @includeWhen(request()->is('coordinateur*'), 'coordinateur.partiels.navbar')
    @includeWhen(request()->is('prof*'), 'prof.partiels.navbar')
    @includeWhen(request()->is('vacataire*'), 'vacataire.partiels.navbar')

    <div class="container-fluid">
        <div class="row">
            {{-- Dynamic sidebar based on current route prefix --}}
            @includeWhen(request()->is('coordinateur*'), 'coordinateur.partiels.sidebar')
            @includeWhen(request()->is('prof*'), 'prof.partiels.sidebar')
            @includeWhen(request()->is('vacataire*'), 'vacataire.partiels.sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                @yield('content')
            </main>
        </div>
    </div>
@else
    @yield('content')
@endauth


    <!-- jQuery first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Then Bootstrap Bundle (only include once!) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Your custom script -->
<script src="{{ asset('js/script.js') }}?v={{ filemtime(public_path('js/script.js')) }}"></script>

<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/parallax-js@1.5.0/dist/parallax.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanilla-tilt@1.7.0/dist/vanilla-tilt.min.js"></script>
</body>
</html>
