<?php

include_once 'Usuario.php';

$usuarioDAO = new UsuarioDAO();

$usuario = new Usuario();
$usuario->setNombres('Bugs');
$usuario->setApellidos('Bunny');
$usuario->setCorreo('bugsbunny@wb.com');

$usuario2 = new Usuario();
$usuario2->setNombres('Lola');
$usuario2->setApellidos('Bunny');
$usuario2->setCorreo('lolabunny@wb.com');

$usuarioDAO->insertar($usuario);
$usuarioDAO->insertar($usuario2);

$usuarios = $usuarioDAO->buscarTodos();

foreach ($usuarios as $usuario) {
    echo $usuario->getNombres() . ' ' . $usuario->getApellidos() . ' ' . $usuario->getCorreo() . '<br>';
}