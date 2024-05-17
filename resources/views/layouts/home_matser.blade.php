<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ثبت نام</title>
    <link rel="stylesheet" href="{{ asset('home/home.css') }}">
    @livewireStyles
</head>
<body dir="rtl">
    
    @yield('content')

    <script src="{{ asset('admin/js/libs/jquery.min.js') }}"></script>
    <script>
      jQuery(document).ready(function($) {
      tab = $('.tabs h3 a');

      tab.on('click', function(event) {
        event.preventDefault();
        tab.removeClass('active');
        $(this).addClass('active');

        tab_content = $(this).attr('href');
        $('div[id$="tab-content"]').removeClass('active');
        $(tab_content).addClass('active');
      });
    });
    </script>
    @livewireScripts
    <script src="{{ asset('admin/js/sweetalert2.js') }}"></script>
    <x-livewire-alert::scripts />
</body>
</html>