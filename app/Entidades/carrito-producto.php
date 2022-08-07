<?php

namespace App\Entidades;

use DB;
use illuminate\Database\Eloquent\Model; 

class Carrito_producto extends Model
{
    protected $table = 'carritos_productos';
    public $timestamps = false;

    protected $fillable = [
        'idcarrito_producto', 
        'fk_idproducto',
        'fk_idcarrito',
        'cantidad'

    ];

    protected $hidden = [

    ];
}

    public function insertar()
    {
        $sql = "INSERT INTO $this->table (
        fk_idproducto,
        fk_idcarrito,
        cantidad
            ) VALUES (?, ?, ?);";
      $result = DB::insert($sql, [
            $this->fk_idproducto,
            $this->fk_idcarrito,
            $this->cantidad
        ]);
        return $this->idcarrito_producto = DB::getPdo()->lastInsertId();
    }


    public function guardar() {
      $sql = "UPDATE $this->table SET
          fk_idproducto=$this->fk_idproducto,
          fk_carrito=$this->fk_idcarrito,
          cantidad=$this->cantidad,
          WHERE idcarrito_producto=?";
      $affected = DB::update($sql, [$this->idcarrito_producto]);
  }


  public function obtenerPorId($idcarrito_producto) {
      $sql = "SELECT
              $idcarrito_producto,
              fk_idproducto,
              fk_carrito,
              cantidad
      FROM $this->table WHERE idcarrito_producto = $idcarrito_producto";
      $lstRetorno = DB::select($sql);

      if (count($lstRetorno) > 0) {
          $this->idcarrito_producto = $lstRetorno[0]->idcarrito_producto;
          $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
          $this->fk_idcarrito = $lstRetorno[0]->fk_idcarrito;
          $this->cantidad = $lstRetorno[0]->cantidad;
          return $this;
          }

      return null;
  }
 

  public function obtenerPorCarrito($idcarrito)
    {
        $sql = "SELECT
                  A.idcarrito_producto,
                  A.fk_idproducto,
                  B.nombre AS nombreproducto,
                  B.precio AS precioproducto,
                  B.imagen AS imagenproducto,
                  A.fk_idcarrito,
                  A.cantidad
                FROM carritos_productos A
                INNER JOIN productos B ON A.fk_idproducto = B.idproducto
                WHERE A.fk_idcarrito = $idcarrito";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorCliente($idcliente){
      $sql = "SELECT
              idcarrito_producto,
              fk_idproducto,
              fk_carrito,
              cantidad
       FROM carritos_productos A
       INNER JOIN carritos ON carritos_productos.fk_idcarrito = carritos.idcarrito
       WHERE carritos.fk_idcliente = $idcliente";
       $lstRetorno = DB::select($sql);

       if(count($lstRetorno) > 0) {
      $this->idcarrito = $lstRetorno[0]->idcarrito;
      $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;
      return $this;
      }

      return Null;

      public function obtenerTodos() {
            $sql = "SELECT
                    $idcarrito_producto;
                    fk_idproducto,
                    fk_carrito,
                    cantidad
            FROM $this->table ORDER BY idcarrito_producto";
            $lstRetorno = DB::select($sql);
            return $lstRetorno;

      public function eliminar() {
            $sql = "DELETE FROM $this->table WHERE idcarrito_producto=?";
            $affected =DB::delete($sql, [$this->idcarrito_producto]);

      }     
      
}
}
