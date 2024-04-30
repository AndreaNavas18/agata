<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />

    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />

    <style>
        body {
            background-color: #f8f8f8;
        }

        /* .logo {
            width: 100%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 50px;
        } */

        /* .img-fondo {
            background-image: url("{{ asset('assets/images/login.jpg') }}");
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
        } */

        /* Estilos para centrar contenido en dispositivos móviles */
        @media (max-width: 767px) {
            .form-content {
                margin-top: 50%;
            }
        }


        body {
            margin: 0;
            padding: 0;
            background: url('assets/images/fondo_login.png') no-repeat;
            height: 100vh;
            font-family: sans-serif;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            overflow: hidden
        }

        @media screen and (max-width: 600px; ) {
            body {
                background-size: cover;
                : fixed
            }
        }

        #particles-js {
            height: 100%
        }

        .loginBox {

            display: flex;
            flex-direction: column;
            width: 350px;
            position: relative;
            top: 50%;
            left: 50%;
            border-radius: 10px;
            min-height: 200px;
            box-sizing: border-box;
            /* padding: 40px; */
            /* border: black solid; */
            transform: translate(-50%, -50%);
            /* border: none; */

        }

        /* .user {
            margin: 0 auto;
            display: block;
            margin-bottom: 20px
        } */

        .loginBox input {
            width: 100%;
            margin-bottom: 20px
        }

        .loginBox input[type="email"],
        .loginBox input[type="password"] {
            border: none;
            border-bottom: 2px solid #262626;
            outline: none;
            height: 40px;
            /* color: #fff; */
            background: transparent;
            font-size: 16px;
            padding-left: 20px;
            box-sizing: border-box
        }

        .loginBox input[type="email"]:hover,
        .loginBox input[type="password"]:hover {
            color: #1c2938;
            border: 1px solid #069bd7;
            box-shadow: 0 0 5px #069bd7, 0 0 10px , 0 0 15px rgba(196, 216, 13, 0.1)
        }

        .loginBox input[type="email"]:focus,
        .loginBox input[type="password"]:focus {
            border-bottom: 2px solid #069bd7
        }

        .inputBox {
            position: relative
        }

        .inputBox span {
            position: absolute;
            top: 10px;
            color: #262626
        }

        .loginBox button[type="submit"] {
            border: none;
            outline: none;
            height: 40px;
            font-size: 16px;
            background: #1c2938;
            /* color: #fff; */
            border-radius: 20px;
            cursor: pointer
        }

        .loginBox a {
            color: #262626;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            text-align: center;
            display: block
        }

        a:hover {
            color: #1c2938
        }

        p {
            color: #0000ff
        }
    </style>
    <script src="https://kit.fontawesome.com/f2b23d5285.js" crossorigin="anonymous"></script>
    <!-- Jquery js-->
    <script src="{{ asset('assets/js/vendors/jquery-3.2.1.min.js')}}"></script>

    <!--Bootstrap.min js-->
    <script src="{{ asset('assets/plugins/bootstrap/popper.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

    <script>
        $(window).on("load", function(e) {
            $("#global-loader").fadeOut("slow");
        })
        $(document).ready(function() {
            $('.loading').click(function() {
                $('#global-loader').show()
            });
            function openLoader() {
                $('#global-loader').show();
            }

            function closeLoader() {
                $('#global-loader').hide();
            }

            $('form.formLoading').submit(function(e) {
                e.preventDefault();
                var $form = $('form')[0];
                if ($form.checkValidity()) {
                    openLoader();
                    $form.submit();
                }
                else {
                    closeLoader();
                }
            });
        });



    </script>
</head>
<body>
    <!--Global-Loader-->
    <div id="global-loader">
        <img src="{{ asset('assets/images/icons/loader.svg') }}" alt="loader">
    </div>

    {{-- Ventana Login --}}
    <div class="loginBox">
        <div style="
                background-color: #1c2938;
                padding: 40px;
                border-radius: 10px 10px 0 0;">
            {{-- <h3>Agata</h3> --}}
            {{-- <img class="user" src=" {{ asset('assets/images/agata.png') }}"> --}}
            <img class="user" src=" {{ asset('assets/images/agatby-02.png') }}">
        </div>

        <div style="
                background-color: white;
                padding: 40px;
                border-radius: 0 0 10px 10px;">

                        <div class="col-12 mb-4">
                            <img 
                                src="{{ asset('assets/images/logo_stratecsa.png')}}"
                                class="img-fluid logo">
                        </div>

            <form method="POST" action="{{ route('authenticate') }}" class="formLoading">
                @csrf
                <div class="inputBox">

                    <!-- email input -->
                    @component('componentes.label', [
                        'title' => 'Email',
                        'id' => 'email',
                        'required' => true,
                    ])
                    @endcomponent

                    <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus required>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror


                    <!-- Password input -->
                    <div class="form-outline mb-4">

                        @component('componentes.label', [
                            'title' => 'Contraseña',
                            'id' => 'password',
                            'required' => true,
                        ])
                        @endcomponent

                        <input id="password" type="password"
                            class=" @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password" required>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                        <!-- Submit button -->
                {{-- <input type="submit" name="" value="Login"> --}}
                <button type="submit"
                    class="btn btn-primary btn-lg w-100">
                    <i class="fas fa-sign-in-alt"></i>
                    Login
                </button>
                {{-- @if (Route::has('password.request'))
                    <a class="btn btn-link text-center" href="{{ route('password.request') }}">
                         {{ __('Forgot Your Password?') }}
                     </a>
                 @endif --}}
            </form>
        </div>
    </div>
</body>

</html>
