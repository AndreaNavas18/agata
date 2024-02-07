
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

            .logo {
                width: 100%;
                display: block;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 50px;
            }
            .img-fondo{
                background-image: url("{{asset('assets/images/login.jpg')}}");
                background-repeat: no-repeat;
                background-size: cover;
                height: 100vh;
            }
           /* Estilos para centrar contenido en dispositivos móviles */
            @media (max-width: 767px) {
                .form-content {
                    margin-top: 50%;
                }
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
			<img src="{{ asset('assets/images/icons/loader.svg')}}" alt="loader">
		</div>
        <section class="vh-100">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-8 col-lg-6 img-fondo d-none d-sm-none d-md-block">
                    </div>

                    <div class="form-content col-sm-12 col-md-7 col-lg-4 offset-lg-1 align-self-center">

                        <div class="col-12 mb-4">
                            <img src="https://stratecsa.com/assets/images/logov3.png"
                                class="img-fluid logo">
                        </div>

                        @include('componentes.alerts')

                        <form method="POST" action="{{ route('authenticate') }}" class="formLoading">
                            @csrf

                            <!-- email input -->
                            <div class="form-outline mb-4">

                                @component('componentes.label', [
                                    'title' => 'Email',
                                    'id' => 'email',
                                    'required' => true])
                                @endcomponent

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">

                               @component('componentes.label', [
                                    'title' => 'Contraseña',
                                    'id' => 'password',
                                    'required' => true])
                                @endcomponent

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" required>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row mb-0">
                                <div class="col-12">
                                    <button type="submit"
                                        class="btn btn-primary btn-lg w-100">
                                        <i class="fas fa-sign-in-alt"></i>
                                        Ingresar
                                    </button>

                                    {{-- @if (Route::has('password.request'))
                                        <a class="btn btn-link text-center" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif --}}
                                </div>
                            </div>
                            <!-- Submit button -->

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>

