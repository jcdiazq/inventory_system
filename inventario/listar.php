<?php include("../principal/arriba.php");

$campos = $conexion->query("SHOW COLUMNS FROM inventarios.inventario")->fetchAll(PDO::FETCH_OBJ);
$mensaje;

if (isset($_GET["ID"])) {
    $Id = $_GET["ID"];
    $conexion->query("DELETE FROM inventario WHERE ID='$Id'");
    $mensaje = "Elminado OK";
} elseif (isset($_POST["ID"])) {
    $arrayField = array();
    foreach ($campos as $campo) :
        if (!empty($_POST["$campo->Field"]) && $campo->Field != "ID") {
            $arrayField[] = $campo->Field . "=" . $_POST["$campo->Field"];
        }
    endforeach;

    $dataSet = implode(",", ($arrayField));
    $sql = "UPDATE inventario SET $dataSet WHERE ID={$_POST["ID"]}";
    $resultado = $conexion->prepare($sql);
    $resultado->execute();
    $mensaje = "Actualizado OK";
}

$registros = $conexion->query("select * FROM inventario")->fetchAll(PDO::FETCH_OBJ);
$compras = $conexion->query("select * FROM compras")->fetchAll(PDO::FETCH_OBJ);
$pedidos = $conexion->query("select * FROM pedidos")->fetchAll(PDO::FETCH_OBJ);
$devoluciones = $conexion->query("select * FROM devolucion")->fetchAll(PDO::FETCH_OBJ);
$materiales = $conexion->query("select * FROM materiales")->fetchAll(PDO::FETCH_OBJ);

?>
<div class="contenedor_listado">
    <div class=titulo_pagina>
        <h1>Lista de Inventario</h1>
    </div>
    <div>
        <div class="caja_filtro">
            <form action="" method="get">
                Filtrar Por: <select name="filtro" id="filtro">
                                <option value="filtro1">Filtro 1</option>
                                <option value="filtro2">Filtro 2</option>
                            </select>
                <input type="submit" name="filtrar" value="Aceptar">
            </form>
        </div>
        <div class="iconos_exportar">
            <div><img src="../img/icono_excel.png"></div>
            <div><img src="../img/icono_pdf.png"></div>
            <div><img src="../img/icono_imprimir.png"></div>
            <div><img src="../img/icono_correo.png"></div>
        </div>
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
                                    <?php if ($llave == "N_COMPRAS") { ?>
                                        <select name="<?php echo $llave; ?>" id="<?php echo $llave; ?>" style="width: 300px;">
                                            <option value="NULL">NULL</option>
                                            <?PHP foreach ($compras as $compra) : ?>
                                                <option value="<?php echo $compra->ID; ?>" <?php if ($dato == $compra->ID) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $compra->DESCRIPCION; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php } elseif ($llave == "N_PEDIDO") { ?>
                                        <select name="<?php echo $llave; ?>" id="<?php echo $llave; ?>" style="width: 300px;">
                                            <option value="NULL">NULL</option>
                                            <?PHP foreach ($pedidos as $pedido) : ?>
                                                <option value="<?php echo $pedido->ID; ?>" <?php if ($dato == $pedido->ID) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $pedido->DESCRIPCION; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php } elseif ($llave == "N_DEVOLUCION") { ?>
                                        <select name="<?php echo $llave; ?>" id="<?php echo $llave; ?>" style="width: 300px;">
                                            <option value="NULL">NULL</option>
                                            <?PHP foreach ($devoluciones as $devolucion) : ?>
                                                <option value="<?php echo $devolucion->ID; ?>" <?php if ($dato == $devolucion->ID) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $devolucion->DESCRIPCION; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php } elseif ($llave == "CODIGO") { ?>
                                        <select name="<?php echo $llave; ?>" id="<?php echo $llave; ?>" style="width: 300px;">
                                            <option value="NULL">NULL</option>
                                            <?PHP foreach ($materiales as $material) : ?>
                                                <option value="<?php echo $material->IDMATERIAL; ?>" <?php if ($dato == $material->IDMATERIAL) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $material->DESCRIPCION; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php } else { ?>
                                        <?php if ($llave == "ID") {$valor = $dato;} ?>
                                        <?php echo $dato; ?>
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