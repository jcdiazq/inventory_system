<?php

// Credenciales para conexión a base de datos
$usuario = "root";
$contrasena = "my_secret_pw_shh";

// Establecer conexión con la base de datos
try{
$conexion=new PDO ('mysql:host=db;dbname=inventarios', $usuario,$contrasena);
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conexion->exec("SET CHARACTER SET UTF8");

} catch (Exception $e){
die ('ERROR: '.$e ->getMessage());    
echo  "Linea del error" . $e->getLine();
}

//iniciar la session
session_start();

// Cookies para almacenar de los productos seleccionados para comprar
if (isset($_POST["comprar"])){
    $objecto = ["ID"=>$_POST["ID"],"DESCRIPCION"=>$_POST["DESCRIPCION"],"COLOR"=>$_POST["COLOR"],"CODIGO"=>$_POST["CODIGO"],
    "MARCA"=>$_POST["MARCA"],"REFERENCIA"=>$_POST["REFERENCIA"],"GARANTIA"=>$_POST["GARANTIA"],
    "CANTIDAD_COMPRAR"=>1,"V_UNITARIO"=>$_POST["V_UNITARIO"],"TOTAL"=>$_POST["V_UNITARIO"]];
    $existe=false;
    if (isset($_COOKIE["productos"])) {
        $array_productos = json_decode($_COOKIE["productos"]);
        foreach ($array_productos as $dato) :
            if ($dato->ID==$_POST["ID"]) {
                $existe=true;
                if ($dato->CANTIDAD_COMPRAR<$_POST["CANT_DISPONIBLE"]) {
                    $dato->CANTIDAD_COMPRAR++;
                    $dato->TOTAL=$dato->CANTIDAD_COMPRAR*$_POST["V_UNITARIO"];
                }
            }
        endforeach;
    }
    if (!$existe) { $array_productos[] = $objecto; }
    $productos = json_encode($array_productos);
    setcookie("productos", $productos, time() + 3600);
    $productos = $array_productos;
} elseif (isset($_COOKIE["productos"])) {
    $productos = json_decode($_COOKIE["productos"]);
}else{
    $productos=[];
}

// Limpiar la Cookies
if (isset($_POST["limpiar_pedido"]) || isset($_POST["finalizar_pedido"])){
    setcookie("productos", "", time() - 3600);
    $productos=[];
}

?>