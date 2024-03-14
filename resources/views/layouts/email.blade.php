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
						background-image: url(https://ci3.googleusercontent.com/meips/ADKq_NbJk5PQLdd5IcpwDNFl4EzPzPzcIhKdwUCrbCFnBnvdVGokg6D6fdHdO4GsGTfIBDcV7vAL7MbzAo3UidU=s0-d-e1-ft#https://i.ibb.co/tsXQmhf/correos-02.png);
						background-repeat: no-repeat;
						background-position: center;">
                        <tr>
                            <td align="center"
                                style="background-color:#009cda00;
							text-align: left;
    						padding-bottom: 0;"
                                colspan="2">
                                <h1
                                    style="
								/* color: #03A9F4; */
								padding-left: 20px;
								/* font-size: 38px; */
								">
                                    <img src="https://i.ibb.co/DCP2hLW/logov3.png"alt="" width="200">
                                    {{-- <em>STRATECSA</em> --}}
                                </h1>
                            </td>
                        </tr>
						<tr>
                            <td style="color: #153643; height: 70px; padding: 0 20px; margin-left:5px; font-size: 16px; ">
                            Le informamos que hemos REGISTRADOOOOO KJH su solicitud como un nuevo ticket. Estamos trabajando para atender su requerimiento y nos comunicaremos con usted pronto.

                            </td>
                        </tr>
                        <tr>
                            <td style="color: #153643; height: 70px; padding: 0; margin-left:5px">
                                @yield('content')
                            </td>
                            {{-- <td>
                               <img src="{{asset('assets/images/robot.png')}}" alt="" width="200" style="height: auto; display: block" />
                            </td> --}}
                        </tr>
                        <tr>
                            <td align="center" style="padding: 0;" colspan="2">
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
									">Para más información</a></button>

                            </td>
                        </tr>



                        <tr>
                            <td align="center" style="padding: 0;" colspan="2">
                                <p
                                    style="height: 60px;
								color: black;
								font-size: 14.2px;
								margin: 0;">
                                    <br />
                                    Stratecsa, Avenida 4 norte 26 n 18, Cali, Colombia, (+57) 315 472 5104
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
