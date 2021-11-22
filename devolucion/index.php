<?PHP

include("../principal/arriba.php");

if(isset($_POST["crear"])){
    $idpedido = $_POST["PEDIDO"];
    $pedido = $conexion->query("SELECT * FROM pedidos WHERE ID=$idpedido")->fetch(PDO::FETCH_OBJ);

    if(isset($pedido)){
    $sql="INSERT INTO devolucion
    (PEDIDO, FECHA_PEDIDO, CODIGO, CODIGO_BARRAS, DESCRIPCION, COLOR, MARCA, REFERENCIA, GARANTIA, CANTIDAD, V_UNITARIO, TOTAL)
    VALUES(:PEDIDO,:FECHA_PEDIDO,:CODIGO,:CODIGO_BARRAS,:DESCRIPCION,:COLOR,:MARCA,:REFERENCIA,:GARANTIA,:CANTIDAD,:V_UNITARIO, :TOTAL)";

    $resultado=$conexion->prepare($sql);
    $resultado->execute(array( ":PEDIDO"=>$_POST["PEDIDO"],":FECHA_PEDIDO"=>$pedido->FECHA_PEDIDO,":CODIGO"=>$pedido->CODIGO,
    ":CODIGO_BARRAS"=>$pedido->CODIGO_BARRAS,":DESCRIPCION"=>$pedido->DESCRIPCION,":COLOR"=>$pedido->COLOR,":MARCA"=>$pedido->MARCA,
    ":REFERENCIA"=>$pedido->REFERENCIA,":GARANTIA"=>$pedido->GARANTIA,":CANTIDAD"=>$pedido->CANTIDAD,":V_UNITARIO"=>$pedido->V_UNITARIO,
    ":TOTAL"=>$pedido->TOTAL));
    $mensaje = "Registrado Ok";

    $inventario = $conexion->query("SELECT * FROM inventario WHERE N_PEDIDO=$idpedido")->fetch(PDO::FETCH_OBJ);
    $cantidad = $inventario->CANT_DISPONIBLE+1;
    $sql = "UPDATE inventario SET N_PEDIDO=$idpedido, CANT_DISPONIBLE=$cantidad WHERE ID=$inventario->ID";
    $resultado = $conexion->prepare($sql);
    $resultado->execute();
    }
}

$pedidos = $conexion->query("SELECT * FROM pedidos")->fetchAll(PDO::FETCH_OBJ);

?>
    <div class="contenido_formulario">
        <div>
            <h2>Registro de Devoluciones</h2>
        </div>
        <div>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <table class="table_formulario">
                    <tr>
                        <td>Numero de Pedido</td>
                        <td>
                        <select name="PEDIDO" style="width: 300px;" required oninvalid="this.setCustomValidity('Debe Seleccionar Un Pedido')">
                            <?PHP foreach($pedidos as $pedido):?>
                            <option value="<?php echo $pedido->ID?>"><?php echo $pedido->DESCRIPCION?></option>
                            <?php endforeach;?>
                        </select> 
                        </td>
                    </tr>
        </div>
        <div>
            <tr>
                <td class="boton_fomulario" colspan="2">
                    <input type="submit" name="crear" id="crear" value="Guardar">
                    <input type="reset" name="limpiar" id="limpiar" value="Limpiar">
                </td>
            </tr>
            </table>
            </form>
        </div>
    </div>
    <script><?php If(isset($mensaje)) {echo "alert('".$mensaje."');";} ?></script>
<?php include("../principal/abajo.php"); ?>