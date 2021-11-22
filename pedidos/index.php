<?PHP

include("../principal/arriba.php");
$sqlinventario = "SELECT inventario.ID, inventario.DESCRIPCION, inventario.COLOR, inventario.CODIGO, inventario.MARCA, inventario.REFERENCIA, inventario.GARANTIA, inventario.CANT_DISPONIBLE, 
(SELECT V_UNITARIO FROM compras WHERE compras.ID = inventario.N_COMPRAS) AS V_UNITARIO
FROM inventario WHERE inventario.CANT_DISPONIBLE>0";
$registros = $conexion->query($sqlinventario)->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST["finalizar_pedido"])) {
    $sql="INSERT INTO inventarios.pedidos
    (FECHA_PEDIDO, CLIENTE, CODIGO, CODIGO_BARRAS, DESCRIPCION, COLOR, MARCA, REFERENCIA, GARANTIA, CANTIDAD, V_UNITARIO, TOTAL)
    VALUES(:FECHA_PEDIDO, :CLIENTE, :CODIGO, :CODIGO_BARRAS, :DESCRIPCION, :COLOR, :MARCA, :REFERENCIA, :GARANTIA, :CANTIDAD, :V_UNITARIO, :TOTAL)";

    $fecha=date("d/m/y");
    $resultado = $conexion->prepare($sql);
    $resultado->execute(array(
        ":FECHA_PEDIDO" => $fecha, ":CLIENTE" =>$_SESSION['ID'], ":CODIGO" => $_POST["CODIGO"],
        ":CODIGO_BARRAS" => $_POST["CODIGO_BARRAS"], ":DESCRIPCION" => $_POST["DESCRIPCION"], ":COLOR" => $_POST["COLOR"], ":MARCA" => $_POST["MARCA"],
        ":REFERENCIA" => $_POST["REFERENCIA"], ":GARANTIA" => $_POST["GARANTIA"], ":CANTIDAD" => $_POST["CANTIDAD_COMPRAR"], ":V_UNITARIO" => $_POST["V_UNITARIO"],
        ":TOTAL" => $_POST["TOTAL"]
    ));

    $id = $conexion->lastInsertId();
    $mensaje = "Pedido Registrado";

    foreach ($registros as $valor):
        if ($valor->ID == $_POST["ID"]) {$cantidad = $valor->CANT_DISPONIBLE-$_POST["CANTIDAD_COMPRAR"];}
    endforeach;

    $sql = "UPDATE inventario SET N_PEDIDO=$id, CANT_DISPONIBLE=$cantidad WHERE ID='{$_POST["ID"]}'";
    $resultado = $conexion->prepare($sql);
    $resultado->execute();
    $registros = $conexion->query($sqlinventario)->fetchAll(PDO::FETCH_OBJ);
}
$campos = $registros[0];
?>
<div class="contenedor_listado">
    <div class=titulo_pagina>
        <h1>Realizar Pedido</h1>
    </div>
    <div class=registros>
        <table class="tabla_lista">
            <thead class="tabla_encabezado">
                <tr>
                    <?PHP foreach ($campos as $llave => $dato) : ?>
                        <th><?php echo $llave; ?></th>
                    <?php endforeach; ?>
                    <th colspan="2">Comprar</th>
                </tr>
            </thead>
            <tbody class="tabla_cuerpo">
                <?PHP foreach ($registros as $registro) : ?>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <tr class="tabla_fila">
                            <?PHP foreach ($registro as $llave => $dato) : ?>
                                <th>
                                    <?php echo $dato;
                                    if ($llave == "ID") {
                                        $valor = $dato;
                                    } ?>
                                    <input type="hidden" name="<?php echo $llave ?>" id="<?php echo $llave ?>" value="<?php echo $dato; ?>">
                                </th>
                            <?php endforeach; ?>
                            <td>
                                <input type="hidden" name="ID" id="ID" value="<?php echo $valor; ?>">
                                <input type="submit" name="comprar" value="Comprar">
                    </form>
                    </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if (sizeof($productos) > 0) { ?>
        <div class=titulo_pagina>
            <h1>Finalizar Compra</h1>
        </div>
        <div class=registros>
            <table class="tabla_lista">
                <thead class="tabla_encabezado">
                    <tr>
                        <?PHP $campos = $productos[0];
                        foreach ($campos as $llave => $dato) : ?>
                            <th><?php echo $llave; ?></th>
                        <?php endforeach; ?>
                        <th>CODIGO DE BARRAS</th>
                    </tr>
                </thead>
                <tbody class="tabla_cuerpo">
                    <?PHP foreach ($productos as $registro) : ?>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <tr class="tabla_fila">
                                <?PHP foreach ($registro as $llave => $dato) : ?>
                                    <th>
                                        <?php if ($llave == "ID") { $valor = $dato; } echo $dato; ?>
                                        <input type="hidden" name="<?php echo $llave ?>" id="<?php echo $llave ?>" value="<?php echo $dato; ?>">
                                    </th>
                                <?php endforeach; ?>
                                <td>
                                    <input type="text" name="CODIGO_BARRAS" value="">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <input type="submit" name="finalizar_pedido" value="Finalizar Pedido">
                        <input type="submit" name="limpiar_pedido" value="Limpiar Pedido">
                        </form>
                </tbody>
            </table>
        </div>
    <?php } ?>
    <script>
        <?php if (isset($mensaje)) {
            echo "alert('" . $mensaje . "');";
        } ?>
    </script>
    <?php include("../principal/abajo.php"); ?>