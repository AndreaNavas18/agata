<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignación de Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            color: #333333;
        }

        p {
            color: #555555;
            line-height: 1.6;
        }

        .ticket-info {
            margin-top: 20px;
            border: 1px solid #dddddd;
            border-collapse: collapse;
            width: 100%;
        }

        .ticket-info th, .ticket-info td {
            border: 1px solid #dddddd;
            padding: 10px;
            text-align: left;
        }

        .ticket-info th {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 20px;
            color: #777777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Asignación de Ticket</h1>
        <p>¡Hola [Nombre del Usuario]!</p>
        <p>Te informamos que se te ha asignado un nuevo ticket con la siguiente información:</p>

        <table class="ticket-info">
            <tr>
                <th>Ticket ID</th>
                <td>[ID del Ticket]</td>
            </tr>
            <tr>
                <th>Asunto</th>
                <td>[Asunto del Ticket]</td>
            </tr>
            <tr>
                <th>Descripción</th>
                <td>[Descripción del Ticket]</td>
            </tr>
            <tr>
                <th>Prioridad</th>
                <td>[Prioridad del Ticket]</td>
            </tr>
            <!-- Agrega más filas según sea necesario -->
        </table>

        <p>Gracias por tu atención. Si tienes alguna pregunta, no dudes en contactarnos.</p>

        <div class="footer">
            <p>Este es un mensaje automático, por favor no respondas a este correo.</p>
        </div>
    </div>
</body>
</html>
