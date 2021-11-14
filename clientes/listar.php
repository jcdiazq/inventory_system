<?php include("../principal/arriba.php");

$campos = $conexion->query("SHOW COLUMNS FROM inventarios.clientes")->fetchAll(PDO::FETCH_OBJ);
$mensaje;

if (isset($_GET["ID"])) {
    $Id = $_GET["ID"];
    $conexion->query("DELETE FROM clientes WHERE ID='$Id'");
    $mensaje = "Elminado OK";
} elseif (isset($_POST["ID"])) {
    $arrayField = array();
    foreach ($campos as $campo) :
        if (!empty($_POST["$campo->Field"]) && $campo->Field != "ID") {
            if (strpos($campo->Type,'int')){
                $arrayField[] = $campo->Field . "=" . $_POST["$campo->Field"];
            } else {
                $arrayField[] = $campo->Field . "='" . $_POST["$campo->Field"] . "'";
            }
        }
    endforeach;
    $dataSet = implode(",", ($arrayField));
    $sql = "UPDATE clientes SET $dataSet WHERE ID='{$_POST["ID"]}'";
    $resultado = $conexion->prepare($sql);
    $resultado->execute();
    $mensaje = "Actualizado OK";
}

$registros = $conexion->query("select * FROM clientes")->fetchAll(PDO::FETCH_OBJ);
?>
<div class="contenedor_listado">
    <div class=titulo_pagina>
        <h1>Lista de Clientes</h1>
    </div>
    <div class=registros>
        <table class="tabla_lista">
            <thead class="tabla_encabezado">
                <tr>
                    <?PHP foreach ($campos as $campo) : ?>
                        <th><?php echo $campo->Field; ?></th>
                    <?php endforeach; ?>
                    <th colspan="2">Actualizar/Borrar</th>
                </tr>
            </thead>
            <tbody class="tabla_cuerpo">
                <?PHP foreach ($registros as $registro) : ?>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <tr class="tabla_fila">
                            <?PHP foreach ($registro as $llave => $dato) : ?>
                                <th>
                                    <?php if ($llave == "ID") { ?>
                                        <?php echo $dato;
                                        $valor = $dato ?>
                                    <?php } elseif ($llave == "ID_USUARIO") { ?>
                                        <select name="<?php echo $llave; ?>" id="<?php echo $llave; ?>">
                                            <?PHP $usuarios = $conexion->query("select * FROM usuarios")->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($usuarios as $usuario) : ?>
                                                <option value="<?php echo $usuario->ID ?>" <?php if ($dato == $usuario->ID) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $usuario->USUARIO ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php } else { ?>
                                        <input type="text" name="<?php echo $llave; ?>" value="<?php echo $dato; ?>">
                                    <?php } ?>
                                </th>
                            <?php endforeach; ?>
                            <td>
                                <input type="hidden" name="ID" id="ID" value="<?php echo $valor; ?>">
                                <input type="submit" name="actualizarclientes" id="actualizarclientes" value="Actualizar">
                    </form>
                    </td>
                    <td>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                            <input type="hidden" name="ID" id="ID" value="<?php echo $valor; ?>">
                            <input type="submit" name="eliminarclientes" id="eliminarclientes" value="Borrar">
                        </form>
                    </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    <?php if (isset($mensaje)) {
        echo "alert('" . $mensaje . "');";
    } ?>
</script>
<?php include("../principal/abajo.php"); ?>