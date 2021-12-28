<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        @include('includes.head')

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background: #2b1954;
                background: linear-gradient(45deg, #161334 0%, #181438 36%, #201643 70%, #2b1954 100%);
                font-family: Avenir, Helvetica, Arial, sans-serif;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            #app {
                z-index: 5;
                min-height: 100vh;
            }

            #app::before {
                content: '';
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                /* background: url('https://azuriom.com/assets/svg/install.svg') no-repeat center / cover; */
                background: linear-gradient(to bottom right, #403f44, #1e1b32);
                z-index: -10;
            }

            .row {
                min-height: 100%;
            }

            .content {
                box-shadow: 0 15px 15px rgba(0, 0, 0, 0.2), 0 6px 3px rgba(0, 0, 0, 0.25);
                background: #eee;
                z-index: 15;
            }

            h1 {
                position: relative;
                padding-bottom: 0.5rem;
                margin-bottom: 1rem;
            }

            /* h1::after {
                content: '';
                width: 80px;
                height: 3px;
                bottom: 0;
                right: calc(50% - 40px);
                position: absolute;
                background: #034ce2;
            } */

            .logo {
                width: 100%;
                max-width: 350px;
            }

            .btn:not(.btn-link) {
                border-radius: 50rem;
            }

            .btn:not(.btn-link) .spinner-border {
                vertical-align: middle;
            }
        </style>
        @stack('styles')
    </head>

    <body>
        <div id="app">
            <div class="container">
                <div class="row justify-content-center align-items-center py-3 py-md-5">
                    <div class="content col-xl-8 col-lg-10 col-12 p-3 px-md-5 py-md-4 rounded">
                        <div class="text-center" style="font-size: 5rem">
                            DEOKONAI
                        </div>

                        <h1 class="text-center">Installation</h1>

                        <hr class="my-4">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle"></i>
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="{{ trans('messages.actions.close') }}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle"></i>
                                {!! session('error') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-label="{{ trans('messages.actions.close') }}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @yield('content')

                        <!-- <hr> -->

                    </div>
                </div>
            </div>
        </div>

        <script>
            function updateToggleSelect(selector, el) {
                const value = el.value !== '' ? el.value : 'undefined';

                document.querySelectorAll('[' + selector + ']').forEach(function (el) {
                    el.classList.add('d-none');
                });
                document.querySelectorAll('[' + selector + '~="' + value + '"]').forEach(function (el) {
                    el.classList.remove('d-none');
                });
            }

            document.querySelectorAll('[data-toggle-select]').forEach(function (el) {
                const selector = 'data-' + el.dataset['toggleSelect'];

                updateToggleSelect(selector, el);

                el.addEventListener('change', function () {
                    updateToggleSelect(selector, el);
                });
            });
        </script>

    </body>
</html>
