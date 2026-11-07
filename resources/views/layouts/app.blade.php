<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Social Development Council | International Charity & Community Support')</title>
    <meta name="description" content="@yield('meta_description', 'Social Development Council (SDC) is a premier humanitarian organization dedicated to poverty alleviation, education, healthcare, emergency relief, and sustainable community empowerment.')">

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo-sdc.jpg') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Custom Modern Charity Design System -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/darkmode.css') }}">

    <!-- Immediate Theme Initialization (Prevents FOUC) -->
    <script>
        (function() {
            var t = localStorage.getItem('sdc_theme') || (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', t);
        })();
    </script>

    @stack('styles')
</head>
<body>

    <!-- Header Navigation Partial -->
    @include('partials.header')

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 shadow-sm rounded-3" role="alert">
                <i class="fa-solid fa-circle-check fs-5 text-success"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 shadow-sm rounded-3" role="alert">
                <i class="fa-solid fa-circle-exclamation fs-5 text-danger"></i>
                <div>{{ session('error') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if(isset($errors) && $errors->any())
        <div class="container mt-3">
            <div class="alert alert-warning alert-dismissible fade show shadow-sm rounded-3" role="alert">
                <div class="fw-bold mb-1"><i class="fa-solid fa-triangle-exclamation me-1"></i> Please check the form errors below:</div>
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <!-- Main Dynamic Content -->
    <main id="main-content" tabindex="-1">
        @yield('content')
    </main>

    <!-- Footer Partial -->
    @include('partials.footer')

    <!-- Bootstrap 5.3.3 Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Custom Main JS -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Dark Mode & Multi-Language Translation Manager -->
    <script src="{{ asset('js/theme-lang.js') }}"></script>

    @stack('scripts')
</body>
</html>
