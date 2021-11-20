<?PHP

include("../principal/arriba.php");

if(isset($_POST["crear"])){
    $sql="INSERT INTO devolucion
    (PEDIDO, FECHA_PEDIDO, CODIGO, CODIGO_BARRAS, DESCRIPCION, COLOR, MARCA, REFERENCIA, GARANTIA, CANTIDAD, V_UNITARIO, TOTAL)
    VALUES(:PEDIDO,:FECHA_PEDIDO,:CODIGO,:CODIGO_BARRAS,:DESCRIPCION,:COLOR,:MARCA,:REFERENCIA,:GARANTIA,:CANTIDAD,:V_UNITARIO, :TOTAL)";

    $resultado=$conexion->prepare($sql);
    $resultado->execute(array( ":PEDIDO"=>$_POST["PEDIDO"],":FECHA_PEDIDO"=>$_POST["FECHA_PEDIDO"],":CODIGO"=>$_POST["CODIGO"],
    ":CODIGO_BARRAS"=>$_POST["CODIGO_BARRAS"],":DESCRIPCION"=>$_POST["DESCRIPCION"],":COLOR"=>$_POST["COLOR"],":MARCA"=>$_POST["MARCA"],
    ":REFERENCIA"=>$_POST["REFERENCIA"],":GARANTIA"=>$_POST["GARANTIA"],":CANTIDAD"=>$_POST["CANTIDAD"],":V_UNITARIO"=>$_POST["V_UNITARIO"],
    ":TOTAL"=>$_POST["TOTAL"]));
    $mensaje = "Registrado Ok";
}

$materiales = $conexion->query("SELECT * FROM materiales")->fetchAll(PDO::FETCH_OBJ);
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
                        <select name="CODIGO" style="width: 300px;">
                            <?PHP foreach($pedidos as $pedido):?>
                            <option value="<?php echo $pedido->ID?>"><?php echo $pedido->DESCRIPCION?></option>
                            <?php endforeach;?>
                        </select> 
                        </td>
                    </tr>
                    <tr>
                        <td>Fecha de Pedido</td>
                        <td><input type="date" name="FECHA_PEDIDO" required></td>
                    </tr>
                    <tr>
                        <td>Descripción de Material</td>
                        <td>
                        <select name="CODIGO" style="width: 300px;">
                            <?PHP foreach($materiales as $material):?>
                            <option value="<?php echo $material->IDMATERIAL?>"><?php echo $material->DESCRIPCION?></option>
                            <?php endforeach;?>
                        </select> 
                        </td>
                    </tr>
                    <tr>
                        <td>Código de Barras</td>
                        <td><input type="text" name="CODIGO_BARRAS"></td>
                    </tr>
                    <tr>
                        <td>Descripción</td>
                        <td><input type="text" name="DESCRIPCION" required></td>
                    </tr>
                    <tr>
                        <td>Color</td>
                        <td><input type="text" name="COLOR" ></td>
                    </tr>
                    <tr>
                        <td>Marca</td>
                        <td><input type="text" name="MARCA" ></td>
                    </tr>
                    <tr>
                        <td>Referencia</td>
                        <td><input type="text" name="REFERENCIA" ></td>
                    </tr>
                    <tr>
                        <td>Fecha de Garantia</td>
                        <td><input type="date" name="GARANTIA" required></td>
                    </tr>
                    <tr>
                        <td>Cantidad</td>
                        <td><input type="number" name="CANTIDAD" required></td>
                    </tr>
                    <tr>
                        <td>Valor Unitario</td>
                        <td><input type="number" name="V_UNITARIO" required></td>
                    </tr>
                    <tr>
                        <td>Valor Total</td>
                        <td><input type="number" name="TOTAL" required></td>
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