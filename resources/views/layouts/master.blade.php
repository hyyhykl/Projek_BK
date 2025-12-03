<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('flat/assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('flat/assets/css/style.css') }}">
</head>
<body>
   @include('layouts.sidebar')

   @include('layouts.header')

   <div class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span>&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span>&times;</span>
                                </button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Periksa kembali input Anda:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span>&times;</span>
                                </button>
                            </div>
                        @endif
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
   </div>

    <!-- Required Js -->
    <script src="{{ asset('flat/assets/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('flat/assets/js/plugins/bootstrap.min.js') }}"></script>
    <!-- Apex Chart -->
    <script src="{{ asset('flat/assets/js/plugins/apexcharts.min.js') }}"></script>
    <!-- custom-chart js -->
    <script src="{{ asset('flat/assets/js/pages/dashboard-main.js') }}"></script>
</body>

</html>

