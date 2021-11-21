<?php include("../principal/arriba.php");

$campos = $conexion->query("SHOW COLUMNS FROM inventarios.pedidos")->fetchAll(PDO::FETCH_OBJ);
$mensaje;
$tipodato;

if (isset($_GET["ID"])) {
    $Id = $_GET["ID"];
    $conexion->query("DELETE FROM pedidos WHERE ID='$Id'");
    $mensaje = "Elminado OK";
} elseif (isset($_POST["ID"])) {
    $arrayField = array();
    foreach ($campos as $campo) :
        if (!empty($_POST["$campo->Field"]) && $campo->Field != "ID") {
            if (strpos($campo->Type,'date')) {
                $arrayField[] = $campo->Field . "='" . $_POST["$campo->Field"] . "'";
                $tipodato="date";
            } elseif (strpos($campo->Type,'int') || strpos($campo->Type,'decimal')){ 
                $arrayField[] = $campo->Field . "=" . $_POST["$campo->Field"];
                $tipodato="number";
            } else {
                $arrayField[] = $campo->Field . "='" . $_POST["$campo->Field"] . "'";
                $tipodato="text";
            }
        }
    endforeach;
    $dataSet = implode(",", ($arrayField));
    $sql = "UPDATE pedidos SET $dataSet WHERE ID='{$_POST["ID"]}'";
    $resultado = $conexion->prepare($sql);
    $resultado->execute();
    $mensaje = "Actualizado OK";
}

$registros = $conexion->query("select * FROM pedidos")->fetchAll(PDO::FETCH_OBJ);
$materiales = $conexion->query("select * FROM materiales")->fetchAll(PDO::FETCH_OBJ);
$clientes = $conexion->query("select * FROM clientes")->fetchAll(PDO::FETCH_OBJ);

?>
<div class="contenedor_listado">
    <div class=titulo_pagina>
        <h1>Listar de Pedidos</h1>
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
                                    <?php } elseif ($llave == "CODIGO") { ?>
                                        <select name="<?php echo $llave; ?>" id="<?php echo $llave; ?>" style="width: 300px;">
                                            <?PHP foreach ($materiales as $material) : ?>
                                                <option value="<?php echo $material->IDMATERIAL ?>" <?php if ($dato == $material->IDMATERIAL) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $material->DESCRIPCION ?></option>
                                            <?php endforeach; ?>
                                    <?php } elseif ($llave == "CLIENTE") { ?>
                                        <select name="<?php echo $llave; ?>" id="<?php echo $llave; ?>" style="width: 300px;">
                                            <?PHP foreach ($clientes as $cliente) : ?>
                                                <option value="<?php echo $cliente->ID ?>" <?php if ($dato == $cliente->ID) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $cliente->NOMBRE ?></option>
                                            <?php endforeach; ?>
                                    <?php } else { ?>
                                        <input type="<?php echo $tipodato; ?>" name="<?php echo $llave; ?>" value="<?php echo $dato; ?>">
                                    <?php } ?>
                                </th>
                            <?php endforeach; ?>
                            <td>
                                <input type="hidden" name="ID" id="ID" value="<?php echo $valor; ?>">
                                <input type="submit" value="Actualizar">
                    </form>
                    </td>
                    <td>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                            <input type="hidden" name="ID" id="ID" value="<?php echo $valor; ?>">
                            <input type="submit" value="Borrar">
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