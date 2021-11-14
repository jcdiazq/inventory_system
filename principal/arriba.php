<?php include("../conexion.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/formulario.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/listado.css">
    <link rel="stylesheet" href="../css/menu.css">
    <title>Sistema de Inventarios</title>
</head>
<body>
<!-- Cuerpo de Página -->
<div class="cuerpo">
<!-- Encabezado -->
<div class="encabezado">
        <div class="encabezado_titulo_logo">
            <div class="titulo">
                <span class="titulo_texto">Sistema de Inventarios</span>
            </div>
            <div class="logo">
                <img src="../img/distribuidora.png">
            </div>
        </div>
        <!-- Menu Navegación-->
        <div class="navegacion">
            <div id="menu">
            <ul>
                <li class="nivel1"><a class="opcion_inicio" href="/">Inicio</a>
                    <ul class="nivel2">
                        <li class="nivel2"><a href="#"><img src="../img/cliente.png"><br>Clientes</a>
                            <ul class="nivel3">
                                <li><a href="/clientes">Crear Cliente</a></li>
                                <li><a href="/clientes/listar.php">Listar Clientes</a></li>
                            </ul>
                        </li>
                        <li class="nivel2"><a href="#"><img src="../img/ventas.png"><br>Pedidos/Ventas</a>
                            <ul class="nivel3">
                                <li><a href="#">Pedidos</a></li>
                                <li><a href="#">Ventas</a></li>
                            </ul>
                        </li>
                        <li><a href="/devolucion/listar.php"><img src="../img/devolucion.png"><br>Devolución</a></li>
                        <li><a href="/inventario/listar.php"><img src="../img/inventario.png"><br>Inventarios</a></li>
                    </ul>
                </li>
                <li class="nivel1">Usuario
                    <ul class="nivel2">
                        <li><a href="/usuarios">Crear Usuario</a></li>
                        <li><a href="/usuarios/listar.php">Listar Usuarios</a></li>
                    </ul>
                </li>
            </ul>
            </div>
            <!-- <div class="transaccion">
                <nav class="opciones">
                    <ul class="opcion_inicio">Inicio
                        <li>Clientes
                            <ul>Crear Cliente</ul>
                            <ul>Listar Clientes</ul>
                        </li>
                        <li>Pedidos/Ventas
                            <ul>Pedidos</ul>
                            <ul>Ventas</ul>
                        </li>
                        <li>Devolución</li>
                        <li>Inventarios</li>
                    </ul>
                    <ul>Usuario
                        <li>Crear Usuario</li>
                        <li>Listar Usuarios</li>
                    </ul>
                </nav>
            </div>
            <div class="sesion">
                <nav><ul>Cerrar</ul></nav>
            </div> -->
        </div>
    </div>
    <!-- Contenido -->
    <div class="contenido">