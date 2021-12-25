<!DOCTYPE html>
<html lang="en">
    
    <head>

        @include('includes.head')

    </head>

    <body>

        <!-- Content -->
        <main class="row mx-0">
            @include('includes.admin_sidebar')
            <div class="col p-4">
                @yield('content')
            </div>
        </main>

        <!-- Custom Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')
        
        <!-- Footer -->

    </body>

</html>