<?php

namespace App\Entidades;

use DB;
use illuminate\Database\Eloquent\Model; 

class Cliente extends Model
{
    protected $table = 'clientes';
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

    public function guardar() {
        $sql = "UPDATE $this->table SET
            nombre='$this->nombre',
            apellido='$this->apellido'
            mail=$this->mail,
            dni='$this->dni',
            telefono='$this->telefono'
            WHERE idcliente=?";
        $affected = DB::update($sql, [$this->idcliente]);
    }

    public function obtenerPorId($idcliente)
    {
        $sql = "SELECT
                idcliente,
                nombre,
                apellido,
                mail,
                dni,
                telefono,
                clave
        FROM clientes WHERE idcliente = $idcliente";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcliente = $lstRetorno[0]->idcliente;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->apellido = $lstRetorno[0]->apellido;
            $this->mail = $lstRetorno[0]->mail;
            $this->dni = $lstRetorno[0]->dni;
            $this->telefono = $lstRetorno[0]->telefono;
            $this->clave = $lstRetorno[0]->clave;
            return $this;
        }
        return null;
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                  A.idcliente,
                  A.nombre
                FROM clientes A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


}

