<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="x-apple-disable-message-reformatting" />
    <title></title>
    <!--[if mso]>
      <noscript>
        <xml>
          <o:OfficeDocumentSettings>
            <o:PixelsPerInch>96</o:PixelsPerInch>
          </o:OfficeDocumentSettings>
        </xml>
      </noscript>
    <![endif]-->
    {{-- <style>
		table,
		td,
		div,
		h1,
		p {
			font-family: Arial, sans-serif;
		}
	</style> --}}
    {{-- <link href="{{asset('assets/css/emails.css')}}" rel="stylesheet" /> --}}

    <style>
        .div-datos{
            padding-bottom: 10px;
            color: black;
    }
    </style>


</head>

<body style="margin: 0; padding: 0">
    <div>

        <table role="presentation"
            style="width: 100%; border-collapse: collapse; border: 0; border-spacing: 0; background: #ffffff;
		">
            <tr>
                <td align="center" style="padding: 0">
                    <table role="presentation"
                        style="width: 600px;
						border-collapse:collapse;
						border-spacing:0;
						text-align:left;
						background-image: url('https://i.ibb.co/x6WSxxk/correos-fondo.png');
						background-repeat: no-repeat;
						background-position: center;">
                        <tr>
                            <td align="center"
                                style="background-color:#009cda00;
							text-align: left;
    						padding-bottom: 0;
                            padding-top: 40px;"
                                colspan="2">
                                <h1
                                    style="
								height: 27px;
                                padding-left: 45px;
                                padding-bottom: 15px;
                               
								">
                                    <img src="https://i.ibb.co/DCP2hLW/logov3.png"alt="" width="200">
                                    {{-- <em>STRATECSA</em> --}}
                                </h1>
                            </td>
                        </tr>
						<tr>
                            <td style="
                                color: #153643;
                                height: 70px;
                                padding: 0 46px;
                                font-size: 16px;
                                text-align: justify;">

                                @yield('information')

                            </td>
                        </tr>
                        <tr>
                            <td style="color: #153643;
                            height: 70px;
                            padding: 20px 20px;
                            margin-left: 5px;
                            font-size: 16px;
                            text-align: justify;
                            padding-bottom: 25px;">

                                @yield('content')
                            </td>
                            {{-- <td>
                               <img src="{{asset('assets/images/robot.png')}}" alt="" width="200" style="height: auto; display: block" />
                            </td> --}}
                        </tr>
                        <tr>
                            <td align="center" style="padding: 0; padding-bottom: 30px; padding-top: 10px" colspan="2">
                                <button
                                    style="
											text-align: center;
													background-color: #2196f3;
													border-radius: 15px;
													height: 30px;
													color: white;
													border: solid 1px white;
													width: 180px;">
																<a href="https://www.stratecsa.com/"
																	style="
										color: inherit; /* Hereda el color del texto del botón */
										text-decoration: none; /* Quita el subrayado */
									">Consulta más aquí</a></button>

                            </td>
                        </tr>



                        <tr>
                            <td align="center" style="padding: 0; padding-bottom: 0px;" colspan="2">
                                <p
                                    style="color: #153643;
                                        padding: 23px 46px;
                                        margin-left: 5px;
                                        font-size: 12.4px;
                                        text-align: center;">
                                    Stratecsa, Avenida 4 norte 26 n 18, Cali, Colombia, (+57) 315 472 5104
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" style="padding: 0; padding: 0 320px;" colspan="2">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
