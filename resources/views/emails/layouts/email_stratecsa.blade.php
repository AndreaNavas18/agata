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
    </head>

    <body style="margin: 0; padding: 0;">
        <table role="presentation" style="width: 100%; border-collapse: collapse; border: 0; border-spacing: 0; background: #ffffff;">
            <tr>
                <td align="center" style="padding: 0;">
                    <table role="presentation" style="width: 600px; border-collapse: collapse; border-spacing: 0; text-align: left;">
                        <tr>
                            <td align="center" style="padding: 0;">
                                <a href="https://creditos.somosziro.com/users/login" target="_blank">
                                    <img src="https://creditos.somosziro.com/img/email/mailBienvenida/img/Header.png" alt="" width="600" style="height: auto; display: block;" />
                                </a>
                            </td>
                        </tr>
                        {{-- contenido de la vista --}}
                        @yield('content')
                        {{-- fin contenido de la vista --}}
                        <tr>
                            <td align="center" style="padding: 0;">
                                <a href="https://creditos.somosziro.com/users/login" target="_blank">
                                    <img src="https://creditos.somosziro.com/img/email/mailBienvenida/img/Footer_01.jpg" alt="" width="600" style="height: auto; display: block;" />
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" style="padding: 0; background: #144755;">
                                <p style="height: 60px; color: #fff; font-size: 12.2px; margin: 0;">
                                    <br />
                                    Stratecsa. Tecnologia que conecta.
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
