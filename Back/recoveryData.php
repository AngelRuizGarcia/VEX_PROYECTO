<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../recursos/PHPMailer/PHPMailer-master/src/Exception.php';
require '../recursos/PHPMailer/PHPMailer-master/src/PHPMailer.php';
require '../recursos/PHPMailer/PHPMailer-master/src/SMTP.php';

require_once("./conexionClaves.php");

try {
    $conexion = new PDO($dsn, $usuario, $contraseña);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $email = $POST_["email"];
    $query = "SELECT * FROM users WHERE email = $email";
    $resultado = $conexion->query($query);
    //$row = $resultado->fetch_assoc();
    if ($resultado->rowCount() > 1) {

        $mail = new PHPMailer(true);

        try {
                             
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp-mail.outlook.com';                    
            $mail->SMTPAuth   = true;                                  
            $mail->Username   = 'alerovmar@alu.edu.gva.es';                     
            $mail->Password   = '';                                        
            $mail->Port       = 587;                                   

            //Recipients
            $mail->setFrom('alerovmar@alu.edu.gva.es', 'VEXI');
            $mail->addAddress($email, 'Usuario');                  

            //Attachments      
            $mail->addAttachment('../recursos/img/VEX_logo.png', 'VEXI.png');    

            //Content
            $mail->isHTML(true);                                 
            $mail->Subject = 'Recuperación de contraseña - VEXI';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b> <a href=localhost/VEX_PROYECTO/BACK/change_password.php>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    $conexion = null;
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
