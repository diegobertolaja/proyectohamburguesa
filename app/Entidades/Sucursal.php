<?php

namespace App\Entidades;

use DB;
use illuminate\Database\Eloquent\Model; 

class Sucursal extends Model
{
    protected $table = 'sucursales';
    public $timestamps = false;

    protected $fillable = [
        'idsucursal',
        'direccion', 
        'telefono', 
        'linkmapa',
        'nombre'
        
      ];

    protected $hidden = [

    ];

    public function cargarDesdeRequest($request) {
        $this->idsucursal = $request->input('id') != "0" ? $request->input('id') : $this->idsucursal;
        $this->direccion = $request->input('txtDireccion');
        $this->telefono = $request->input('txtTelefono');
        $this->linkmapa = $request->input('txtMapa');
        $this->nombre = $request->input('txtNombre');
        
    }


    public function insertar()
    {
        $sql = "INSERT INTO $this->table (
        'direccion', 
        'telefono', 
        'linkmapa', 
        'nombre'
            ) VALUES (?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->direccion,
            $this->telefono,
            $this->linkmapa,
            $this->nombre,
            
        ]);
        return $this->idsucursal = DB::getPdo()->lastInsertId();
    }
    
    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.idsucursal',
            1 => 'A.direccion',
            2 => 'A.telefono',
            3 => 'A.linkmapa',
            4 => 'A.nombre',
        );
        $sql = "SELECT DISTINCT
                    A.idsucursal,
                    A.direccion,
                    A.telefono,
                    A.linkmapa,
                    A.nombre
                    FROM sistema_menues A
                    LEFT JOIN sistema_menues B ON A.id_padre = B.idsucursal
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.direccion LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.telefono LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.linkmapa LIKE '%" . $request['search']['value'] . "%' )";
            $sql .= " OR A.nombre LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }
    public function guardar() {
      $sql = "UPDATE $this->table SET
          direccion=$this->direccion,
          telefono='$this->telefono',
          linkmapa='$this->linkmapa,
          telefono='$this->telefono',
          nombre='$this->nombre'
          WHERE idsucursal=?";
      $affected = DB::update($sql, [$this->idsucursal]);
  }

  public function obtenerPorId($idmenu)
  {
      $sql = "SELECT
              idsucursal,
              direccion,
              telefono,
              linkmapa,
              nombre
      FROM sucursales WHERE idsucursal = $idsucursal";
      $lstRetorno = DB::select($sql);

      if (count($lstRetorno) > 0) {
          $this->idsucursal = $lstRetorno[0]->idsucursal;
          $this->direccion = $lstRetorno[0]->direccion;
          $this->telefono = $lstRetorno[0]->telefono;
          $this->linkmapa = $lstRetorno[0]->linkmapa;
          $this->nombre = $lstRetorno[0]->nombre;
          return $this;
      }
      return null;
  }

  public function obtenerTodos()
    {
        $sql = "SELECT
                  A.idsucursal,
                  A.direccion,
                  A.telefono,
                  A.linkmapa,
                  A.nombre
                  
                FROM sucursales A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }
}