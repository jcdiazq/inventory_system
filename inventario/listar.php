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
            if (strpos($campo->Type,'int')){
                $arrayField[] = $campo->Field . "=" . $_POST["$campo->Field"];
            } else {
                $arrayField[] = $campo->Field . "='" . $_POST["$campo->Field"] . "'";
            }
        }
    endforeach;
    $dataSet = implode(",", ($arrayField));
    $sql = "UPDATE inventario SET $dataSet WHERE ID='{$_POST["ID"]}'";
    $resultado = $conexion->prepare($sql);
    $resultado->execute();
    $mensaje = "Actualizado OK";
}

$registros = $conexion->query("select * FROM inventario")->fetchAll(PDO::FETCH_OBJ);
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