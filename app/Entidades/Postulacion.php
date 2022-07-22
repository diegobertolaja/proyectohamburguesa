<?php

namespace App\Entidades;

use DB;
use illuminate\Database\Eloquent\Model; 

class Postulacion extends Model
{
    protected $table = 'postulaciones';
    public $timestamps = false;

    protected $fillable = [
        'idpostulacion', 
        'nombre', 
        'apellido', 
        'telefono', 
        'mail', 
        'curriculum' 
        
      ];

    protected $hidden = [

    ];

    public function insertar()
    {
        $sql = "INSERT INTO $this->table (
                 nombre, 
                 apellido, 
                 telefono, 
                 mail, 
                 curriculum 
            ) VALUES (?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->apellido,
            $this->telefono,
            $this->mail,
            $this->curriculum 
      ]);
        return $this->idpostulacion = DB::getPdo()->lastInsertId();
    }

    public function guardar() {
      $sql = "UPDATE $this->table SET
          nombre='$this->nombre',
          apellido='$this->apellido',
          telefono='$this->telefono',
          mail=$this->mail,
          curriculum=$this->curriculum'
          WHERE idpostulacion=?";
      $affected = DB::update($sql, [$this->ipostulacion]);
  }

  public function obtenerPorId($idpostulacion)
  {
      $sql = "SELECT
              idpostulacion,
              nombre,
              apellido,
              telefono,
              mail,
              curriculum             
      FROM postulaciones WHERE idpostulacion = $idpostulacion";
      $lstRetorno = DB::select($sql);

      if (count($lstRetorno) > 0) {
          $this->idpostulacion = $lstRetorno[0]->idpostulacion;
          $this->nombre = $lstRetorno[0]->nombre;
          $this->apellido = $lstRetorno[0]->apellido;
          $this->telefono = $lstRetorno[0]->telefono;
          $this->mail = $lstRetorno[0]->mail;
          $this->curriculum = $lstRetorno[0]->curriculum;
          return $this;
      }
      return null;
  }

}

