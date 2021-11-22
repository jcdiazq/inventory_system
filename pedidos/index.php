<?PHP

include("../principal/arriba.php");

$registros = $conexion->query("SELECT inventario.ID, inventario.DESCRIPCION, inventario.COLOR, inventario.MARCA, inventario.REFERENCIA, inventario.GARANTIA, inventario.CANT_DISPONIBLE, 
(SELECT V_UNITARIO FROM compras WHERE compras.ID = inventario.N_COMPRAS) AS V_UNITARIO
FROM inventario WHERE inventario.CANT_DISPONIBLE>0")->fetchAll(PDO::FETCH_OBJ);

$campos = $registros[0];

if (isset($_POST["crear"])) {
    $sql = "INSERT INTO pedidos
    (FECHA_PEDIDO, CLIENTE, CODIGO, CODIGO_BARRAS, DESCRIPCION, COLOR, MARCA, REFERENCIA, GARANTIA, CANTIDAD, V_UNITARIO, TOTAL)
    VALUES(:FECHA_PEDIDO,:CLIENTE,:CODIGO,:CODIGO_BARRAS,:DESCRIPCION,:COLOR,:MARCA,:REFERENCIA,:GARANTIA,:CANTIDAD,:V_UNITARIO, :TOTAL)";

    $resultado = $conexion->prepare($sql);
    $resultado->execute(array(
        ":PEDIDO" => $_POST["PEDIDO"], ":FECHA_PEDIDO" => $_POST["FECHA_PEDIDO"], ":CODIGO" => $_POST["CODIGO"],
        ":CODIGO_BARRAS" => $_POST["CODIGO_BARRAS"], ":DESCRIPCION" => $_POST["DESCRIPCION"], ":COLOR" => $_POST["COLOR"], ":MARCA" => $_POST["MARCA"],
        ":REFERENCIA" => $_POST["REFERENCIA"], ":GARANTIA" => $_POST["GARANTIA"], ":CANTIDAD" => $_POST["CANTIDAD"], ":V_UNITARIO" => $_POST["V_UNITARIO"],
        ":TOTAL" => $_POST["TOTAL"]
    ));
    $mensaje = "Registrado Ok";
}

$materiales = $conexion->query("SELECT * FROM materiales")->fetchAll(PDO::FETCH_OBJ);
$clientes = $conexion->query("SELECT * FROM clientes")->fetchAll(PDO::FETCH_OBJ);
$inventarios = $conexion->query("SELECT * FROM inventario WHERE CANT_DISPONIBLE>0")->fetchAll(PDO::FETCH_OBJ);

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
                        <th colspan="2">Comprar</th>
                    </tr>
                </thead>
                <tbody class="tabla_cuerpo">
                    <?PHP foreach ($productos as $registro) : ?>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <tr class="tabla_fila">
                                <?PHP foreach ($registro as $llave => $dato) : ?>
                                    <th>
                                        <?php if ($llave == "ID") {
                                            $valor = $dato;
                                        } else { ?>
                                        <?php echo $dato;
                                        } ?>
                                        <input type="hidden" name="<?php echo $llave ?>" id="<?php echo $llave ?>" value="<?php echo $dato; ?>">
                                    </th>
                                <?php endforeach; ?>
                                <td>
                                    <input type="hidden" name="ID" id="ID" value="<?php echo $valor; ?>">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <input type="submit" name="comprar" value="Finalizar">
                        <input type="submit" name="limpiar_comprar" value="Limpiar Comprar">
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