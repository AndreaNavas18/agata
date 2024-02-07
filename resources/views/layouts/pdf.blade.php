<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sky bridge restoration')</title>
    <style>
        .page-break {
            page-break-after: always;
        }
   
        .text-center {
            text-align: center;
        }
        .text-normal {
            font-weight: normal;
        }
        .text-bold {
            font-weight: bold;
        }
        .text-underline {
            text-decoration: underline;
        }
        .text-justify {
            text-align: justify;
        }
        .text-italic {
            font-style: italic;
        }
        .text-uppercase {
            text-transform: uppercase;
        }
        .enmarcado {
            height: auto;
        }
        table {
            width: 100%;
        }
        table.border, th.border, td.border, .enmarcado {
            padding: 10px;
            border: 1px solid black;
            border-collapse: collapse;
        }

        .border-only {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .border-l {
            border: 1px solid black;
        }

        .border-bottom {
            border-bottom: 1px solid black;
            width:100vh;
        }

        #watermark {
            position: fixed;
            top: 8;
            right: 8;
            width: 100%;
            text-align: right;
        }
        .mb-1{
            margin-bottom: 1rem;
        }
        .mb-2{
            margin-bottom: 2rem;
        }
        .flex-container {
            display: flex;
        }

        .col {
            flex-grow: 1;
        }
        .text-danger {
            color:red;
        }

        .border-lados {
            border-left: 1px solid black;
            border-right: 1px solid black;
            padding: 2px;
        }
    </style>
    @stack('css')
</head>
<body>
    @yield('content')
</body>
</html>
