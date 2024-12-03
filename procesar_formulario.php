<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <?php
// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar los datos enviados desde el formulario
    $nombre = htmlspecialchars(trim($_POST["nombre"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $asunto = htmlspecialchars(trim($_POST["asunto"]));
    $mensaje = htmlspecialchars(trim($_POST["mensaje"]));

    // Validar campos requeridos
    if (empty($nombre) || empty($email) || empty($mensaje)) {
        echo "Por favor, complete todos los campos requeridos.";
        exit;
    }

    // Validar dirección de correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, ingrese un correo electrónico válido.";
        exit;
    }

    // Configuración para enviar correo (puedes personalizar esto)
    $destinatario = "cookyempresa@gmail.com"; // Cambiar a la dirección deseada
    $asuntoEmail = "Formulario de contacto: " . $asunto;
    $cuerpoMensaje = "Nombre: $nombre\n";
    $cuerpoMensaje .= "Correo Electrónico: $email\n";
    $cuerpoMensaje .= "Asunto: $asunto\n\n";
    $cuerpoMensaje .= "Mensaje:\n$mensaje";

    // Configuración adicional del encabezado del correo
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8";

    // Enviar correo
    if (mail($destinatario, $asuntoEmail, $cuerpoMensaje, $headers)) {
        echo "Gracias por contactarnos, $nombre. Tu mensaje fue enviado con éxito.";
    } else {
        echo "Lo sentimos, ocurrió un error al enviar tu mensaje. Por favor, inténtalo de nuevo.";
    }
} else {
    echo "Método de solicitud no válido.";
}
?>

    </body>
</html>