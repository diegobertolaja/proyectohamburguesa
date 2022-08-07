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

    public function cargarDesdeRequest($request) {
        $this->idcliente = $request->input('id') != "0" ? $request->input('id') : $this->idcliente;
        $this->nombre = $request->input('txtNombre');
        $this->apellido = $request->input('txtApellido');
        $this->mail = $request->input('txtMail');
        $this->dni = $request->input('txtDni');
        $this->Telefono = $request->input('txtTelefono');
        $this->clave = password_hash ($request->input('txtClave'), PASSWORD_DEFAULT);
    }

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
            $this->clave,
        ]);
        return $this->idcliente = DB::getPdo()->lastInsertId();
    }

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.idcliente',
            1 => 'A.nombre',
            2 => 'A.mail',
            3 => 'A.dni',
            4 => 'A.telefono',
        );
        $sql = "SELECT DISTINCT
                    A.idcliente,
                    A.nombre,
                    A.apellido,
                    A.mail,
                    A.dni,
                    A.telefono
                    A.clave
                    FROM sistema_menues A
                    LEFT JOIN sistema_menues B ON A.id_padre = B.idcliente
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.apellido LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.mail LIKE '%" . $request['search']['value'] . "%' )";
            $sql .= " OR A.dni LIKE '%" . $request['search']['value'] . "%' )";
            $sql .= " OR A.telefono LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function guardar() 
    {
        if($this->clave != "") {
        $sql = "UPDATE $this->table SET
            nombre='$this->nombre',
            apellido='$this->apellido',
            mail='$this->mail',
            dni='$this->dni',
            telefono='$this->telefono',
            clave='$this->clave'
            WHERE idcliente=?";
        } else {
            $sql = "UPDATE $this->table SET
            nombre='$this->nombre',
            apellido='$this->apellido'
            mail='$this->mail',
            dni='$this->dni',
            telefono='$this->telefono'
      }    
        $affected = DB::update($sql, [$this->idcliente]);
    }

   
    public function obtenerPorId($idcliente)
    {
        $sql = "SELECT
                idcliente;
                nombre;
                apellido;
                mail;
                dni;
                telefono;
                clave;
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
                  A.nombre,
                FROM clientes A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorCorreo($correo)
    {
        $sql = "SELECT
                idcliente,
                mail,
                clave
        FROM clientes WHERE correo = ?";
        $lstRetorno = DB::select($sql, ($correo));

        if (count($lstRetorno) > 0) {
            $this->idcliente = $lstRetorno[0]->idcliente;
            $this->mail = $lstRetorno[0]->mail;
            $this->calve = $lstRetorno[0]->clave;
            return $this;
            }
            return null;
        }

       
        