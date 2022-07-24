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
        $this->linkmapa = $request->input('txtLinkmapa');
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
                  A.nombre
                FROM sucursales A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }
}