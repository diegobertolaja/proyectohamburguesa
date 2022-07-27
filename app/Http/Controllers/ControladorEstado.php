<?php

namespace App\Http\Controllers;

use App\Entidades\Estado; 
use App\Entidades\Sistema\MenuArea;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorEstado extends Controller
{
    public function index()
    {
        $titulo = "Listado de estados";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("MENUCONSULTA")) {
                $codigo = "MENUCONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('estado.estado-listar', compact('titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function cargarGrilla()
            {
                $request = $_REQUEST;
        
                $entidad = new Estado();
                $aEstados = $entidad->obtenerFiltrado();
        
                $data = array();
                $cont = 0;
        
                $inicio = $request['start'];
                $registros_por_pagina = $request['length'];
        
        
                for ($i = $inicio; $i < count($aEstados) && $cont < $registros_por_pagina; $i++) {
                    $row = array();
                    $row[] = "<a href='/admin/estado/".$aEstados[$i]->idestado."' class='btn btn-secondary'><i class='fas fa-pencil'></i></a>;
                    $row[] = $aEstados[$i]->nombre;
                    $data[] = $row;
                }
        
                $json_data = array(
                    "draw" => intval($request['draw']),
                    "recordsTotal" => count($aEstados), //cantidad total de registros sin paginar
                    "recordsFiltered" => count($aEstados), //cantidad total de registros en la paginacion
                    "data" => $data,
                );
                return json_encode($json_data);
            }                  
    
    public function nuevo()
    {
        $titulo = "Nuevo estado";
        return view('estado.estado-nuevo', compact('titulo', es));
            }
   
    public function guardar(Request $request) {
                try {
                    //Define la entidad servicio
                    $titulo = "Modificar estado";
                    $entidad = new Estado();
                    $entidad->cargarDesdeRequest($request);
        
                    //validaciones
                    if ($entidad->nombre == "") {
                        $msg["ESTADO"] = MSG_ERROR;
                        $msg["MSG"] = "Complete todos los datos";
                    } else {
                        if ($_POST["id"] > 0) {
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
                      
                        $_POST["id"] = $entidad->idestado;
                        return view('sistema.menu-listar', compact('titulo', 'msg'));
                    }
                } catch (Exception $e) {
                    $msg["ESTADO"] = MSG_ERROR;
                    $msg["MSG"] = ERRORINSERT;
                }
        
                $id = $entidad->estado;
                $cliente = new Estado();
                $cliente->obtenerPorId($id);
                return view('estado.estado-nuevo', compact('msg', 'estado', 'titulo')) . '?id=' . $estado->idestado;
        
            }   
        }                    

      