<!DOCTYPE html>
<html lang="en" class="layout-navbar-fixed layout-compact layout-menu-fixed" data-template="horizontal-menu-template">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiNIPOS PRO</title>
    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->
    <link rel="stylesheet" href="{{ url ('assets/vendor/libs/pickr/pickr-themes.css') }}">
    <link rel="stylesheet" href="{{ url ('assets/vendor/css/core.css') }}">
    <link rel="stylesheet" href="{{ url ('assets/css/demo.css') }}">

    <link rel="stylesheet" href="{{ url ('assets/vendor/fonts/iconify-icons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/font_lao.css') }}">

    <!-- endbuild -->

    <link rel="stylesheet" href="{{ url ('assets/vendor/libs/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ url ('assets/vendor/libs/tagify/tagify.css') }}">
    <link rel="stylesheet" href="{{ url ('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ url ('assets/vendor/libs/typeahead-js/typeahead.css') }}">

    <!-- Vendors CSS -->
    <script src="{{ url('assets/vendor/js/template-customizer.js') }}"></script>
    <!-- Helpers -->
    <script src="{{ url('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ url('assets/js/config.js') }}"></script>

    @vite('resources/css/app.css')
</head>
<body>

    <div id="app-vue"></div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/theme.js  -->
    <script src="{{ url ('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ url ('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ url ('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ url ('assets/vendor/libs/%40algolia/autocomplete-js.js') }}"></script>  
    <script src="{{ url ('assets/vendor/libs/pickr/pickr.js') }}"></script>
    <script src="{{ url ('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>     
    <script src="{{ url ('assets/vendor/libs/hammer/hammer.js') }}"></script>      
    <script src="{{ url ('assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ url ('assets/vendor/js/menu.js') }}"></script>

    <!-- Vendors JS -->
    <script src="{{ url ('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ url ('assets/vendor/libs/tagify/tagify.js') }}"></script>
    <script src="{{ url ('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ url ('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ url ('assets/vendor/libs/bloodhound/bloodhound.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ url('assets/js/main.js') }}"></script>

     @vite('resources/js/app.js')
</body>
</html>