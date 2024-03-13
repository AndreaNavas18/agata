@yield('title')
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <meta name="x-apple-disable-message-reformatting" />
        <title>@yield('title')</title>
        <style>
            table,
            td,
            div,
            h1,
            p {
                font-family: Arial, sans-serif;
            }
            .border {
                border: 1px solid #ccc;
            }
            .margin-20{
                margin: 20px;
            }
        </style>
		<link href="{{asset('assets/css/emails.css')}}" rel="stylesheet" />
    </head>

    <body style="margin: 0; padding: 0;">

           <div class="information"
        style="background-image: url(https://ci3.googleusercontent.com/meips/ADKq_NbS-L_aoxL63oKvGPFf9uh_oteE6TFtV0fpWGCpovv72ENC_IaZCq3FXGK7qySxEqbOSOt9hzqMqUvsJYg=s0-d-e1-ft#https://i.ibb.co/6mkLfKy/img-sfondo.png);
        background-repeat: no-repeat;
        margin: 0 auto;
        width: 640px;
        height: 468px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
        margin-top: -30px;
        text-align: left;">
        {{-- <table role="presentation" style="width: 100%; border-collapse: collapse; border: 0; border-spacing: 0; background: #ffffff;">
            <tr>
                <td align="center" style="padding: 0;">
                    <table role="presentation" style="width: 600px; border-collapse: collapse; border-spacing: 0; text-align: left;"> --}}
                        {{-- <tr>
                            <td align="center" style="padding: 0;">
                                <a href="https://creditos.somosziro.com/users/login" target="_blank">
                                    <img src="https://creditos.somosziro.com/img/email/mailBienvenida/img/Header.png" alt="" width="600" style="height: auto; display: block;" />
                                </a>
                            </td>
                        </tr> --}}
                        {{-- contenido de la vista --}}
                        @yield('content')
                        {{-- fin contenido de la vista --}}
                        {{-- <tr>
                            <td align="center" style="padding: 0;">
                                <a href="https://creditos.somosziro.com/users/login" target="_blank">
                                    <img src="https://creditos.somosziro.com/img/email/mailBienvenida/img/Footer_01.jpg" alt="" width="600" style="height: auto; display: block;" />
                                </a>
                            </td>
                        </tr> --}}
                        {{-- <tr>
                            <td align="center" style="padding: 0; background: #144755;">
                                <p style="height: 60px; color: #fff; font-size: 12.2px; margin: 0;">
                                    <br />
                                    Stratecsa. Tecnologia que conecta.
                                </p>
                            </td>
                        </tr> --}}
                    {{-- </table>
                </td>
            </tr>
        </table> --}}
    </body>
</html>
