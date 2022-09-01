<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use App\Entidades\Postulacion;
use Illuminate\Http\Request;

class ControladorWebNosotros extends Controller
{
    public function index()
    {
                 
        $sucursal = New Sucursal();
        $aSucursales = $sucursal-> obtenerTodos();    
        
        return view("web.nosotros", compact('aSucursales'));
    }

    public function enviar (Request $request) {
        $nombre = $request->input('txtNombre');
        $apellido = $request->input('txtApellido');
        $telefono = $request->input('txtTelefono');
        $mail = $request->input('txtMail');
        $mensaje = $request->input('txtMensaje');
        $postulacion = New Postulacion();
        $postulacion->curriculum = $nombre;

        if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) {//Se adjunta imagen
            $extension = pathinfo($_FILES ["archivo"]["name"], PATHINFO_EXTENSION);
            $nombreRandom = date("Ymdhmsi") . ".$extension";
            $archivo_temp = $_FILES["archivo"]["tmp_name"];
            $carpeta_archivo = "\\curriculum\\";
            if ($extension == "pfd" || $extension == "doc" || $extension == "docx") {
            move_uploaded_file($archivo_temp, env('APP_PATH') . $carpeta_archivo . $nombreRandom); //guardaelarchivo
            $postulacion->curriculum = $nombreRandom;
        }

       
        $postulacion->nombre = $nombre;
        $postulacion->apellido = "";
        $postulacion->telefono = $telefono;
        $postulacion->mail =  $mail;
        $postulacion->mensaje = $mensaje;
        $postulacion->insertar();

        return redirect("/gracias-postulacion");
    }

   
}

}

?>

