<!DOCTYPE html>
<html>
<head>
    <title>Envío de correo</title>
</head>
<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $para = 'carlosricardovertiz@gmail.com';
        $asunto = $_POST['asunto'];
        $mensaje = $_POST['mensaje'];

        // Encabezados del correo
        $headers = 'From: tu_nombre@example.com' . "\r\n" .
            'Reply-To: tu_nombre@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        // Envío del correo
        if (mail($para, $asunto, $mensaje, $headers)) {
            echo 'El correo se ha enviado correctamente.';
        } else {
            echo 'Error al enviar el correo.';
        }
    }
    ?>
    <form method="post" action="">
        <label for="asunto">Asunto:</label>
        <input type="text" id="asunto" name="asunto" required><br><br>
        <label for="mensaje">Mensaje:</label><br>
        <textarea id="mensaje" name="mensaje" required></textarea><br><br>
        <input type="submit" value="Enviar correo">
    </form>
</body>
</html>
