<?php include("../principal/arriba.php");

$campos = $conexion->query("SHOW COLUMNS FROM inventarios.devolucion")->fetchAll(PDO::FETCH_OBJ);
$mensaje;

if (isset($_GET["ID"])) {
    $Id = $_GET["ID"];
    $conexion->query("DELETE FROM devolucion WHERE ID='$Id'");
    $mensaje = "Elminado OK";
} elseif (isset($_POST["ID"])) {
    $arrayField = array();
    foreach ($campos as $campo) :
        if (!empty($_POST["$campo->Field"]) && $campo->Field != "ID") {
            if (strpos($campo->Type,'int') || strpos($campo->Type,'decimal')){
                $arrayField[] = $campo->Field . "=" . $_POST["$campo->Field"];
            } else {
                $arrayField[] = $campo->Field . "='" . $_POST["$campo->Field"] . "'";
            }
        }
    endforeach;
    $dataSet = implode(",", ($arrayField));
    $sql = "UPDATE devolucion SET $dataSet WHERE ID='{$_POST["ID"]}'";
    $resultado = $conexion->prepare($sql);
    $resultado->execute();
    $mensaje = "Actualizado OK";
}

$registros = $conexion->query("select * FROM devolucion")->fetchAll(PDO::FETCH_OBJ);
?>
<div class="contenedor_listado">
    <div class=titulo_pagina>
        <h1>Lista de Devolución</h1>
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
                                    <?php } else { ?>
                                        <input type="text" name="<?php echo $llave; ?>" value="<?php echo $dato; ?>">
                                    <?php } ?>
                                </th>
                            <?php endforeach; ?>
                            <td>
                                <input type="hidden" name="ID" id="ID" value="<?php echo $valor; ?>">
                                <?php if (isset($_SESSION['usuario']) && $_SESSION['ID_ROL'] == 1 ) { ?>
                                <input type="submit" value="Actualizar">
                                <?php } ?>
                    </form>
                    </td>
                    <td>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                            <input type="hidden" name="ID" id="ID" value="<?php echo $valor; ?>">
                            <?php if (isset($_SESSION['usuario']) && $_SESSION['ID_ROL'] == 1 ) { ?>
                            <input type="submit" value="Borrar">
                            <?php } ?>
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