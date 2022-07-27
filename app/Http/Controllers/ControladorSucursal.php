<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal; 
use App\Entidades\Sistema\MenuArea;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorSucursal extends Controller
{
    
    public function nuevo()
    {
        $titulo = "Nueva Sucursal";
        $sucursal = new Sucursal();
        return view('sucursal.sucursal-nuevo', compact('titulo', 'sucursal'));
            }

    
    public function index()
    {
        $titulo = "Listado de sucursales";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("MENUCONSULTA")) {
                $codigo = "MENUCONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('sucursal.sucursal-listar', compact('titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Sucursal();
        $aSucursales = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];


        for ($i = $inicio; $i < count($aSucursales) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = "<a href='/admin/sucursal/".$aSucursales[$i]->idsucursal."' class='btn btn-secondary'><i class='fas fa-pencil'></i></a>;
            $row[] = $aSucursales[$i]->direccion;
            $row[] = $aSucursales[$i]->telefono;
            $row[] = $aSucursales[$i]->linkmapa;
            $row[] = $aSucursales[$i]->nombre;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aSucursales), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aSucursales), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }            

    public function guardar(Request $request) {
                try {
                    //Define la entidad servicio
                    $titulo = "Modificar sucursal";
                    $entidad = new Sucursal();
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
                      
                        $_POST["id"] = $entidad->idsucursal;
                        return view('sistema.menu-listar', compact('titulo', 'msg'));
                    }
                } catch (Exception $e) {
                    $msg["ESTADO"] = MSG_ERROR;
                    $msg["MSG"] = ERRORINSERT;
                }
        
                $id = $entidad->sucursal;
                $cliente = new Sucursal();
                $cliente->obtenerPorId($id);
                return view('sucursal.sucursal-nuevo', compact('msg', 'sucursal', 'titulo')) . '?id=' . $sucursal->idsucursal;
        
            }                        

      }