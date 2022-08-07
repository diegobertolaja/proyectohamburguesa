<?php

namespace App\Entidades;

use DB;
use illuminate\Database\Eloquent\Model; 

class Carrito_producto extends Model
{
    protected $table = 'carritos_productos';
    public $timestamps = false; 
    private $producto;

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
              A.idcarrito_producto,
              A.fk_idproducto,
              A.fk_carrito,
              A.cantidad,
              C.nombre AS producto,
              C.precio
       FROM carritos_productos A
       INNER JOIN carritos B ON A.fk_idcarrito = B.idcarrito
       INNER JOIN productos C ON C.idproducto = A.fk_idproducto
       WHERE B.fk_idcliente = $idcliente";
       $lstRetorno = DB::select($sql);
      
      $aResultado = array(); 
      if(count($lstRetorno) > 0) {
            foreach($lstRetorno as $resultado){
      $carrito_producto = New Carrito_producto();      
      $carrito_producto->idcarrito_producto = $resultado->idcarrito_producto;
      $carrito_producto->fk_idproducto = $resultado->fk_idproducto;
      $carrito_producto->fk_carrito = $resultado->fk_carrito;
      $carrito_producto->cantidad = $resultado->cantidad;
      $carrito_producto->producto = $resultado->producto;
      $carrito_producto->precio = $resultado->precio;
      $aResultado[] = $carrito_producto;
      return $aResultado;
}
}

   

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
