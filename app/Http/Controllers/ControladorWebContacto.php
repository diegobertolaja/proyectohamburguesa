<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;

class ControladorWebContacto extends Controller
{
    public function index()
    {
        $sucursal = New Sucursal();
        $aSucursales = $sucursal-> obtenerTodos();     
        return view("web.contacto", compact('aSucursales'));
    }

    public function enviar(Request $request) {
        
        $nombre = $request->input('txtNombre');
        $telefono = $request->input('txtTelefono');
        $mail = $request->input('txtMail');
        $mensaje = $request->input('txtMensaje');

        return redirect("/confirmacion-envio");         
        
    }

    $mail = New PHPMailer(true);
    $mail->SMTPDebug = 0;
    $mail->isSmtp();
    $mail->Host = env ('MAIL_HOST');
    $mail->SMTPAuth = tue;
    $mail->Username = env ('MAIL_USERNAME');
    $mail-Password = env ('MAIL_PASSWORD');
    $mail->SMTPSecure = env ('MAIL_ENCRYPTION');
    $mail->Port = env ('MAIL_PORT');

    $mail->sentFrom(env('MAIL_FROM_ADRESS'), env('MAIL_FROM_NAME'));
    $mail->addAdress($mail);
    $mail->addReplyTo(env('MAIL_FROM_ADRESS'));
    
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    //$mail->send();

    return redirect("/confirmacion-envio");  

}
