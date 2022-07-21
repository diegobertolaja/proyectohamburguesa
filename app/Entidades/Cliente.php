<?php

namespace App\Entidades;

use DB;
use illuminate\Database\Eloquent\Model; 

class Cliente extends Model
{
      protected $table = 'cliente';
    public $timestamps = false;

    protected $fillable = [
        'idcliente', 
        'nombre', 
        'apellido', 
        'mail', 
        'dni', 
        'telefono', 
        'clave'
    ];

    protected $hidden = [

    ];

    public function insertar()
    {
        $sql = "INSERT INTO $this->table (
                 nombre, 
                 apellido, 
                 mail, 
                 dni, 
                 telefono, 
                 clave
            ) VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->apellido,
            $this->mail,
            $this->dni,
            $this->telefono,
            $this->clave
        ]);
        return $this->idcliente = DB::getPdo()->lastInsertId();
    }


}

