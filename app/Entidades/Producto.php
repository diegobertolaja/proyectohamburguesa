<?php

namespace App\Entidades;

use DB;
use illuminate\Database\Eloquent\Model; 

class Producto extends Model
{
    protected $table = 'productos';
    public $timestamps = false;

    protected $fillable = [
        'idproducto', 
        'nombre', 
        'cantidad', 
        'precio', 
        'imagen', 
        'fk_idcategoria',
        'descripcion' 
        
      ];

    protected $hidden = [

    ];

    public function cargarDesdeRequest($request) {
        $this->idproducto = $request->input('id') != "0" ? $request->input('id') : $this->idproducto;
        $this->nombre = $request->input('txtNombre');
        $this->cantidad = $request->input('txtCantidad');
        $this->precio = $request->input('txtPrecio');
        $this->dni = $request->input('txtDni');
        $this->fk_idcategoria = $request->input('lstFk_idcategoria');
        $this->descripcion = $request->input('txtDescripcion');
    }

    public function insertar()
    {
        $sql = "INSERT INTO $this->table (
                 nombre, 
                 cantidad, 
                 precio, 
                 imagen, 
                 fk_idcategoria,
                 descripcion
            ) VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->cantidad,
            $this->precio,
            $this->imagen,
            $this->fk_idcategoria,
            $this->descripcion
      ]);
        return $this->idproducto = DB::getPdo()->lastInsertId();
    }


    public function guardar() {
      $sql = "UPDATE $this->table SET
          nombre='$this->nombre',
          cantidad=$this->cantidad,
          precio=$this->mail,
          imagen='$this->imagen',
          fk_idcategoria=$this->fk_idcategoria,
          descripcion=$this->descripcion

          WHERE idproducto=?";
      $affected = DB::update($sql, [$this->idproducto]);
  }

  public function obtenerPorId($idproducto)
  {
      $sql = "SELECT
              idproducto,
              nombre,
              cantidad,
              precio,
              imagen,
              fk_idcategoria,
              descripcion
      FROM productos WHERE idproducto = $idproducto";
      $lstRetorno = DB::select($sql);

      if (count($lstRetorno) > 0) {
          $this->idproducto = $lstRetorno[0]->idproducto;
          $this->nombre = $lstRetorno[0]->nombre;
          $this->cantidad = $lstRetorno[0]->cantidad;
          $this->precio = $lstRetorno[0]->precio;
          $this->imagen= $lstRetorno[0]->imagen;
          $this->fk_idcategoria = $lstRetorno[0]->fk_idcategoria;
          $this->descripcion = $lstRetorno[0]->descripcion;
          return $this;
      }
      return null;
  }
  public function obtenerTodos()
    {
        $sql = "SELECT
                  A.idproducto,
                  A.nombre
                FROM productos A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }
}

