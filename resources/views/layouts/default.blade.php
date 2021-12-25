<!DOCTYPE html>
<html lang="en">
    
    <head>

        @include('includes.head')

    </head>

    <body>

        <!-- Content -->
        <main class="position-relative">
            @yield('content')
        </main>

        <!-- Custom Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')
        
        <!-- Footer -->

    </body>

</html>