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

    public function insertar()
    {
        $sql = "INSERT INTO $this->table (
                 nombre, 
                 cantidad, 
                 precio, 
                 imagen, 
                 fk_idcategoria,
                 'descripcion'
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
          fk_idcategoria=fk_idcategoria,
          descripcion=descripcion

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
          $this->idsucursal = $lstRetorno[0]->idsucursal;
          $this->nombre = $lstRetorno[0]->nombre;
          $this->cantidad = $lstRetorno[0]->cantidad;
          $this->precio = $lstRetorno[0]->precio;
          $this->dni = $lstRetorno[0]->dni;
          $this->imagen= $lstRetorno[0]->imagen;
          $this->fk_idcategoria = $lstRetorno[0]->fk_idcategoria;
          $this->descripcion = $lstRetorno[0]->descripcion;
          return $this;
      }
      return null;
  }
}

