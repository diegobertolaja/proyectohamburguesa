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

    public function cargarDesdeRequest($request) {
        $this->idpostulacion = $request->input('id') != "0" ? $request->input('id') : $this->idpostulacion;
        $this->nombre = $request->input('txtNombre');
        $this->apellido = $request->input('txtApellido');
        $this->Telefono = $request->input('txtTelefono');
        $this->mail = $request->input('txtMail');
        $this->curriculum = $request->input('txtCurriculum');
    }


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

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.idpostulacion',
            1 => 'A.nombre',
            2 => 'A.apellido',
            3 => 'A.telefono',
            4 => 'A.mail',
            5 => 'A.curriculum',
        );
        $sql = "SELECT DISTINCT
                    A.idpostulacion,
                    A.nombre,
                    A.apellido,
                    A.telefono,
                    A.mail,
                    A.curriculum
                    FROM sistema_menues A
                    LEFT JOIN sistema_menues B ON A.id_padre = B.idpostulacion
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.apellido LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.telefono LIKE '%" . $request['search']['value'] . "%' )";
            $sql .= " OR A.mail LIKE '%" . $request['search']['value'] . "%' )";
            $sql .= " OR A.curriculum LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
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

  public function obtenerTodos()
    {
        $sql = "SELECT
                  A.idpostulacion,
                  A.nombre
                FROM postulaciones A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

}

?>
