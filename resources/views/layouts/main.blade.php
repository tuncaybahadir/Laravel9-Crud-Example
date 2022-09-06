<!DOCTYPE html>
<html lang="tr">
<head>

    <title>Laravel 9 Crud Example</title>

    <!-- META TAGS -->
    <meta charset="utf-8">

    <!-- PREFECT & PRECONNECT -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//apis.google.com">

    <!-- HEADER CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <!-- OTHER HEAD META -->
    @yield('header')




</head>

<body>

@yield('container')

    <!-- FOOTER JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        const modulUrl = window.location.pathname;

        $(function () {
            toastr.options.closeButton = true;
            toastr.options.progressBar = true;
        });
    </script>

    <!-- OTHER FOOTER SCRIPTS -->
    @yield('footer')

    @if ($toastr = session('toastr'))
        <script>
            $(function() {
                toastr.{{ $toastr[0] }}("{!! $toastr[1] !!}")
            });
        </script>
    @endif

</body>
</html>
