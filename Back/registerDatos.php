<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_POST['g-recaptcha-response'])) {
        die("Captcha no enviado");
    }

    $secretKey = "";
    $response = $_POST['g-recaptcha-response'];

    $verify = file_get_contents(
        "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response"
    );

    $captchaSuccess = json_decode($verify);

    if (!$captchaSuccess->success) {
        die("Captcha incorrecto");
    }

    echo "Formulario validado correctamente";
}

?>