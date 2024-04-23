<!DOCTYPE html>
<html lang="en">
<head>
    <title>Nuevo mensaje de contacto de la pagina web</title>
</head>
<body>
    <h2>Nuevo mensaje de contacto:</h2>
    <p><strong>Nombre:</strong> {{ $formData['nombre'] }}</p>
    <p><strong>Empresa:</strong> {{ $formData['empresa'] }}</p>
    <p><strong>Pais:</strong> {{ $formData['pais'] }}</p>
    <p><strong>Provincia:</strong> {{ $formData['provincia'] }}</p>
    <p><strong>Teléfono:</strong> {{ $formData['telefono'] }}</p>
    <p><strong>Correo electrónico:</strong> {{ $formData['correo'] }}</p>
    <p><strong>Asunto:</strong> {{ $formData['asunto'] }}</p>
    <p><strong>Mensaje:</strong></p>
    <p>{{ $formData['mensaje'] }}</p>
</body>
</html>