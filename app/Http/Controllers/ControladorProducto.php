<?php

namespace App\Http\Controllers;

use App\Entidades\Producto; 
use App\Entidades\Sistema\MenuArea;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorProducto extends Controller
{
    public function nuevo()
    {
        $titulo = "Nuevo Producto";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("PRODUCTOCONSULTA")) {
                $codigo = "PRODUCTOCONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $producto = New Producto ();
                return view('producto.producto-nuevo', compact('titulo', 'producto'));
            }
        } else {
            return redirect('admin/login');
        }

            public function index()
            {
                $titulo = "Listado de productos";
                if (Usuario::autenticado() == true) {
                    if (!Patente::autorizarOperacion("PRODUCTOCONSULTA")) {
                        $codigo = "PRODUCTOCONSULTA";
                        $mensaje = "No tiene permisos para la operaci&oacute;n.";
                        return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                    } else {
                        return view('producto.producto-listar', compact('titulo'));
                    }
                } else {
                    return redirect('admin/login');
                }
            }

            public function cargarGrilla()
            {
                $request = $_REQUEST;
        
                $entidad = new Producto();
                $aProducto = $entidad->obtenerFiltrado();
        
                $data = array();
                $cont = 0;
        
                $inicio = $request['start'];
                $registros_por_pagina = $request['length'];
        
        
                for ($i = $inicio; $i < count($aProductos) && $cont < $registros_por_pagina; $i++) {
                    $row = array();
                    $row[] = "<a href='/admin/producto/".$aProductos[$i]->idproducto."' class='btn btn-secondary'><i class='fas fa-pencil'></i></a>;
                    $row[] = $$aProductos[$i]->nombre;
                    $row[] = $$aProductos[$i]->cantidad;
                    $row[] = $ . number_format ($aProductos[$i]->precio, 2, ", ", ".");
                    $row[] = $$aProductos[$i]->descripcion;
                    $row[] = "<img src='/files/".$aProductos[$i]->imagen."' class='img-thumbnail'>";
                    $cont++;
                    $data[] = $row;
                }
        
                $json_data = array(
                    "draw" => intval($request['draw']),
                    "recordsTotal" => count($$aProductos), //cantidad total de registros sin paginar
                    "recordsFiltered" => count($aProductos), //cantidad total de registros en la paginacion
                    "data" => $data,
                );
                return json_encode($json_data);
            }           

            public function guardar(Request $request) {
                try {
                    //Define la entidad servicio
                    $titulo = "Modificar producto";
                    $entidad = new Producto();
                    $entidad->cargarDesdeRequest($request);

                    if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) {//Se adjunta imagen
                        $extension = pathinfo($_FILES ["archivo"]["name"], PATHINFO_EXTENSION);
                        $nombre = date("Ymdhmsi") . ".$extension";
                        $archivo = $_FILES["archivo"]["tmp_name"];
                        move_uploaded_file($archivo, env('APP_PATH') . "/public/files/$nombre"); //guardaelarchivo
                        $entidad->imagen = $nombre;
                    }
                
                    //validaciones
                    if ($entidad->nombre == "") {
                        $msg["ESTADO"] = MSG_ERROR;
                        $msg["MSG"] = "Complete todos los datos";
                    } else {
                        if ($_POST["id"] > 0) {

                    $productoAnt = new Producto();
                    $productonAnt->obtenerPorId($entidad->idproducto);
                
                    if($_FILES["archivo"]["error"] === UPLOAD_ERR_OK){
                    //Eliminar imagen anterior
                    @unlink(env('APP_PATH') . "/public/files/$productoAux->imagen");                          
                     } else {
                    $entidad->imagen = $productoAnt->imagen;
                     }
                
                    //Es actualizacion
                        $entidad->guardar();
        
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                        } else {
                            //Es nuevo
                            $entidad->insertar();
        
                            $msg["ESTADO"] = MSG_SUCCESS;
                            $msg["MSG"] = OKINSERT;
                        }
                      
                        $_POST["id"] = $entidad->idproducto;
                        return view('sistema.menu-listar', compact('titulo', 'msg'));
                    }
                } catch (Exception $e) {
                    $msg["ESTADO"] = MSG_ERROR;
                    $msg["MSG"] = ERRORINSERT;
                }
        
                $id = $entidad->producto;
                $cliente = new Producto();
                $cliente->obtenerPorId($id);
                return view('producto.producto-nuevo', compact('msg', 'producto', 'titulo')) . '?id=' . $producto->idproducto;
        
            }         
            
            public function eliminar(Request $request) {
                $id = $request->input('id');
        
                if (Usuario::autenticado() == true) {
                    if (Patente::autorizarOperacion("PRODUCTOELIMINAR")) {
        
                        $entidad = new Producto();
                        $entidad->cargarDesdeRequest($request);
                        @unlink(env('APP_PATH') . "/public/files/$entidad->imagen");  
                        $entidad->eliminar();
        
                        $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
                    } else {
                        $codigo = "PRODUCTOELIMINAR";
                        $aResultado["err"] = "No tiene pemisos para la operaci&oacute;n.";
                    }
                    echo json_encode($aResultado);
                } else {
                    return redirect('admin/login');
                }

      }
    }