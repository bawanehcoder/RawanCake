<meta content="{{ csrf_token() }}" name="csrf-token">
<title>Rawan Cake</title>
<meta name="viewport" content="width=device-width, initial-scale=1">


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css"
    integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
    rel="stylesheet">

<script>
    nav #header - container {
        z - index: 999999;
    }
</script>
@if (\Config::get('app.locale') == 'ar')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&display=swap" rel="stylesheet">
    @if (isset($home))
    @else
    @endif
    <link rel="stylesheet" href="{{ asset('assets/css/styles-rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles-inner-rtl.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/custom-rtl.css?v=' . now()) }}">
@else
    @if (isset($home))
    @else
    @endif

    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles-inner.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/custom.css?v=' . now()) }}">
@endif


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
    integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="{{ asset('js/clipboard.js?v=2') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@include('components.cart.head-script')
@include('flatpickr::components.style')
@include('flatpickr::components.script')
@include('sweetalert::alert')
@stack('css')

{{-- <style>
    /* Keyframes for animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes slideIn {
        from {
            transform: translateY(30px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }

    /* Applying animations */
    .section-name {
        animation: fadeIn 2s ease-in-out;
    }

    .joy-section .btn-primary {
        animation: pulse 2s infinite;
    }

    .joy-section img {
        animation: slideIn 2s ease-in-out;
    }



    .home-header {
        animation: fadeIn 2s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }


    .header-body h1,
    .header-body h2 {
        animation: slideIn 1s ease-out;
    }

    @keyframes slideIn {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }


    .navbar-nav .nav-link {
        position: relative;
        transition: color 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
        color: #FFD700;
        /* Change to any desired color */
    }

    .navbar-nav .nav-link::after {
        content: '';
        position: absolute;
        width: 100%;
        transform: scaleX(0);
        height: 2px;
        bottom: 0;
        left: 0;
        background-color: #FFD700;
        transform-origin: bottom right;
        transition: transform 0.3s ease-out;
    }

    .navbar-nav .nav-link:hover::after {
        transform: scaleX(1);
        transform-origin: bottom left;
    }


    .icon img {
        animation: bounce 2s infinite;
    }

    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-10px);
        }

        60% {
            transform: translateY(-5px);
        }
    }


    .btn-transparent-outline:hover {
        box-shadow: 0 0 10px #FFD700;
        transition: box-shadow 0.3s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes scaleUp {
        from {
            transform: scale(0.9);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .animated-image {
        animation: fadeIn 1s ease-in-out, scaleUp 1s ease-in-out;
    }

    .animated-container {
        animation: fadeIn 1s ease-in-out;
    }

    /* Footer link animation */
    .footer-links {
        overflow: hidden;
        position: relative;
    }

    .footer-links ul li {
        animation: slideUp 0.5s ease-out forwards;
        transform: translateY(100%);
    }

    @keyframes slideUp {
        to {
            transform: translateY(0);
        }
    }
</style> --}}
