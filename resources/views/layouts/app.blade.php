<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', config('app.name'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/5b408a851a.js" crossorigin="anonymous"></script>

    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        .login-container {
            width: 100%;
            height: 100vh;
            background: linear-gradient(90deg, #CAF9DC, #96BCFB);
            mix-blend-mode: darken;
        }

        .c-custom {
            width: 22rem;
            margin-top: 5rem;
            background: #69ABA2;
            border: none;
        }

        .c-custom button {
            color: #fff;
            padding: 0px 12px;
            background: #2FE71D;
        }

        .bg-container-right {
            height: 100vh;
            background: linear-gradient(90deg, #CAF9DC, #96BCFB);
            mix-blend-mode: darken;

        }

        .bg-container-right-top {
            background: #0E4FCD;
            padding: 15px;
            text-align: center;
            color: #fff;
        }

        #menu a {
            color: #333;
        }

        .dropdown-toggle::after {
            display: none !important;
        }

        .dropdown-toggle i {
            font-weight: bold !important;
        }
    </style>
</head>

<body>
    @auth
        <div class="container-fluid">

            <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-xl-2  bg-container-right">
                    @include('layouts.sidebar')
                </div>
                <div class="col py-3">
                    @yield('content')
                </div>
            </div>
        </div>
    @endauth

    @guest
        @yield('content')
    @endguest

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function alertSwift(icon, position, title) {
            const Toast = Swal.mixin({
                toast: true,
                position: position,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: icon,
                title: title
            })
        }

        document.addEventListener('livewire:init', () => {
            Livewire.on('messageModal', (event) => {
                alertSwift(event.status, event.position, event.message);
            });

            Livewire.on('destroyModal', (event) => {
                alertSwift(event.status, event.position, event.message);
                const modal = document.querySelector(event.modal);
                const x = bootstrap.Modal.getInstance(modal);
                x.hide();
            });

        });
    </script>
</body>

</html>
