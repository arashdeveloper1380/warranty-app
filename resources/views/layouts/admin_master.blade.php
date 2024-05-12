@include('layouts._partials.header')
    @include('layouts._partials.sidebar')
    
    <main class="main">
        <div class="container-fluid">
            @yield('content')
        </div>
    </main>
@include('layouts._partials.footer')
