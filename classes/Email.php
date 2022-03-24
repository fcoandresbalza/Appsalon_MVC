<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
    public $email;
    public $nombre;
    public $token;


    public function __construct($email, $nombre, $token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'c3c36038424d76';
        $mail->Password = 'f44bd6846ed846';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Confirma tu cuenta';

        $contenido = '<html>';
        $contenido .= "<p><strong> Hola ". $this->nombre ." </strong> Has creado tu cuenta para utilizar los beneficios que te ofrece AppSalon!</p>";
        $contenido .= "<p>Para confirmar tu cuenta, debes hacer click en el siguiente enlace.</p>";
        $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/confirmar-cuenta?token=" .$this->token . "'>Confirmar cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitaste crear la cuenta, por favor ignora este mensaje</p>";
        $contenido .= '</html>';

        $mail->Body = $contenido;
        
        // Enviar email
        $mail->send();

    }

    public function reestablecerPassword(){
        
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'c3c36038424d76';
        $mail->Password = 'f44bd6846ed846';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Reestablece tu Password';

        $contenido = '<html>';
        $contenido .= "<p><strong> Hola ". $this->nombre ." </strong> ¿Se te ha olvidado tu password? No te precupes!</p>";
        $contenido .= "<p>Para reestablecerlo, debes hacer click en el siguiente enlace.</p>";
        $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/recuperar?token=" .$this->token . "'>Reestablece tu password</a></p>";
        $contenido .= "<p>Si tu no solicitaste crear la cuenta, por favor ignora este mensaje</p>";
        $contenido .= '</html>';

        $mail->Body = $contenido;
        
        // Enviar email
        $mail->send();

    }
}