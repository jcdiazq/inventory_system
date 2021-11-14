<?php

$usuario = "root";
$contrasena = "my_secret_pw_shh";

try{
$conexion=new PDO ('mysql:host=db;dbname=inventarios', $usuario,$contrasena);
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conexion->exec("SET CHARACTER SET UTF8");

} catch (Exception $e){
die ('ERROR: '.$e ->getMessage());    
echo  "Linea del error" . $e->getLine();
}

?>