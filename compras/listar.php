<?php include("../principal/arriba.php");

$campos = $conexion->query("SHOW COLUMNS FROM inventarios.compras")->fetchAll(PDO::FETCH_OBJ);
$mensaje;
$tipodato;

if (isset($_GET["ID"])) {
    $Id = $_GET["ID"];
    $conexion->query("DELETE FROM compras WHERE ID='$Id'");
    $mensaje = "Elminado OK";
} elseif (isset($_POST["ID"])) {
    $arrayField = array();
    foreach ($campos as $campo) :
        if (!empty($_POST["$campo->Field"]) && $campo->Field != "ID") {
            if (strpos($campo->Type, 'date')) {
                $arrayField[] = $campo->Field . "='" . $_POST["$campo->Field"] . "'";
                $tipodato = "date";
            } elseif (strpos($campo->Type, 'int') || strpos($campo->Type, 'decimal')) {
                $arrayField[] = $campo->Field . "=" . $_POST["$campo->Field"];
                $tipodato = "number";
            } else {
                $arrayField[] = $campo->Field . "='" . $_POST["$campo->Field"] . "'";
                $tipodato = "text";
            }
        }
    endforeach;
    $dataSet = implode(",", ($arrayField));
    $sql = "UPDATE compras SET $dataSet WHERE ID='{$_POST["ID"]}'";
    $resultado = $conexion->prepare($sql);
    $resultado->execute();
    $mensaje = "Actualizado OK";
}

$registros = $conexion->query("select * FROM compras")->fetchAll(PDO::FETCH_OBJ);
$materiales = $conexion->query("select * FROM materiales")->fetchAll(PDO::FETCH_OBJ);
$proveedores = $conexion->query("select * FROM proveedores")->fetchAll(PDO::FETCH_OBJ);
$contador = 1;

?>
<div class="contenedor_listado">
    <div class=titulo_pagina>
        <h1>Lista de Compras</h1>
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
                                    <?php } elseif ($llave == "PROVEEDOR") { ?>
                                        <select name="<?php echo $llave; ?>" id="<?php echo $llave; ?>" style="width: 300px;">
                                            <?PHP foreach ($proveedores as $proveedor) : ?>
                                                <option value="<?php echo $proveedor->ID ?>" <?php if ($dato == $proveedor->ID) {
                                                                                                    echo "selected";
                                                                                                } ?>><?php echo $proveedor->RAZON_SOCIAL ?></option>
                                            <?php endforeach; ?>
                                        <?php } elseif ($llave == "CODIGO") { ?>
                                            <select name="<?php echo $llave; ?>" id="<?php echo $llave; ?>" style="width: 300px;">
                                                <?PHP foreach ($materiales as $material) : ?>
                                                    <option value="<?php echo $material->IDMATERIAL ?>" <?php if ($dato == $material->IDMATERIAL) {
                                                                                                            echo "selected";
                                                                                                        } ?>><?php echo $material->DESCRIPCION ?></option>
                                                <?php endforeach; ?>
                                            <?php } elseif ($llave == "TOTAL") { ?>
                                                <input type="<?php echo $tipodato; ?>" id="total<?php echo $contador; ?>" name="<?php echo $llave; ?>" value="<?php echo $dato; ?>" readonly>
                                                <script>
                                                    document.getElementById("cantidad<?php echo $contador; ?>").addEventListener("keyup", CantidadPorUnitario);
                                                    document.getElementById("cantidad<?php echo $contador; ?>").addEventListener("change", CantidadPorUnitario);
                                                    document.getElementById("unitario<?php echo $contador; ?>").addEventListener("keyup", CantidadPorUnitario);
                                                    document.getElementById("unitario<?php echo $contador; ?>").addEventListener("change", CantidadPorUnitario);

                                                    function CantidadPorUnitario() {
                                                        let cantidad = document.getElementById("cantidad<?php echo $contador; ?>");
                                                        let unitario = document.getElementById("unitario<?php echo $contador; ?>");
                                                        let total = document.getElementById("total<?php echo $contador; ?>");
                                                        total.value = cantidad.value * unitario.value;
                                                    }
                                                </script>
                                                <?php $contador++; ?>
                                            <?php } else { ?>
                                                <input type="<?php echo $tipodato; ?>" <?php if ($llave == "CANTIDAD") {
                                                                                            echo 'id="cantidad' . $contador . '"';
                                                                                        } elseif ($llave == "V_UNITARIO") {
                                                                                            echo 'id="unitario' . $contador . '"';
                                                                                        } ?> name="<?php echo $llave; ?>" value="<?php echo $dato; ?>">
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