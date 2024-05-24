<footer class="footer">
    <span class="text-left">
        <a href="http://www.google.com">َArash Narimani</a> &copy; 2023
    </span>
    <span class="pull-right">
        Powered by <a href="tel:09030613817">آرش نریمانی</a>
    </span>
</footer>
<script src="{{ asset('admin/js/libs/jquery.min.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/js/app.js') }}"></script>
<script src="{{ asset('admin/js/views/main.js') }}"></script>
@livewireScripts
<script src="{{ asset('admin/js/sweetalert2.js') }}"></script>
<x-livewire-alert::scripts />
    @yield('footer')
</body>
</html>