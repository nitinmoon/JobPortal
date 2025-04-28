<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title> @yield('title') | {{ config('app.name') }} </title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->
    <link href="{{ asset('backend/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('backend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/custom-css.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/4.0.1/css/bootstrap-toaster.min.css" integrity="sha512-RLiJ5uLcu8jWxsJBevOZWLU0zWv51vwpha0Gh4jRKOqkcWbVR7+U8kKaiGsMhSua3fIkviCHRClSH+XZYKIoZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Template Main CSS File -->
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="preloader"></div>
    @yield('content')
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Load TinyMCE first -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>
    <script src="{{ asset('backend/assets/js/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/4.0.1/js/bootstrap-toaster.min.js" integrity="sha512-YmkrdAXo8RdHV1JFfepR7QWLDfF7vs8Mc/t+6qKIxrEFeWbi0u/lajryYSPK6GC5nupW5t6XfPdxQpIY79+USg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- jQuery validation -->
    <script src="{{ asset('backend/assets/js/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- Auth JS -->
    <script src="{{ asset('backend/assets/js/custom-js/auth-validate.js') }}"></script>
    <!-- Google recaptcha API library -->
    <script async src="https://www.google.com/recaptcha/api.js"></script>
</body>
</html>