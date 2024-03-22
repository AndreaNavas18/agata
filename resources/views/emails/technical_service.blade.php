<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <style>
        html{
            font-size: 16px;
        }

        td{
            padding: 10px 10px;
        }

    </style>

</head>

<body>

    <div style="color: black">

        <p style="">
            @if (date('A') == 'AM')
                Buenos días
            @else
                Buenas tardes
            @endif
        </p>

        <p>
            Solicitamos permisos para ingresar a la "ERT TULUA" en horas de la 
            @if (date('A') == 'AM')
                mañana
            @else
                tarde
            @endif
            , necesitamos ir a revisar nuestros equipos.
        </p>

        <p> Los datos del personal que realizará la actividad son:</p>

    </div>


    <div align="center" style="
        color: black; margin: 30px 0px;">


        <table border= "1px" style="border-collapse: collapse; text-align: center; border: solid 1px black;">
            <tr style="background-color: #11409b;color: white;text-align: center;height: 25px;">

                <td>Nombre</td>
                <td>Identificación</td>
                <td>EPS</td>
                <td>ARL</td>
                <td>N° Celular</td>
                <td>Cargo</td>
                
            </tr>
            @if($employees->count() > 0)
                @foreach($employees as $employeeRow)
            <tr>
                <td>{{ $employeeRow->short_name }}</td>
                <td>{{$employeeRow->identification}}</td>
                <td>{{$employeeRow->eps->name}}</td>
                <td>{{$employeeRow->arl->name}}</td>
                <td>{{$employeeRow->cell_phone}}</td>
                <td>>{{$employeeRow->position->name}}</td>
            </tr>
            @endforeach
            @endif
        </table>

    </div>

    <div style="color: black; ">
        <p> Adjunto parafiscales y documentos de alturas de los técnicos.</p>
        <p><b>Coordialmente,</b></p><br>
        <p><b>Departamento de Soporte</b></p>
    </div>

</body>

</html>
