<?php

include_once 'UsuarioDAO.php';

class Usuario {
    private $id;
    private $nombres;
    private $apellidos;
    private $correo;

    public function __construct($id = null) {
        if ($id !== null) {
            $usuarioDAO = new UsuarioDAO();
            $usuario = $usuarioDAO->buscar($id);
            $this->id = $usuario[0]['id'];
            $this->nombres = $usuario[0]['nombres'];
            $this->apellidos = $usuario[0]['apellidos'];
            $this->correo = $usuario[0]['correo'];
        }
    }

    public function guardar() {
        $usuarioDAO = new UsuarioDAO();
        return $usuarioDAO->insertar($this);
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    public function getNombres() {
        return $this->nombres;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function getCorreo() {
        return $this->correo;
    }
}