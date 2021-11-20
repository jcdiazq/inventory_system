<?PHP

include("../principal/arriba.php");

if(isset($_POST["crear"])){
    $sql="INSERT INTO materiales
    (CODIGOBARRAS, DESCRIPCION, COLOR, MARCA)
    VALUES(:CODIGOBARRAS, :DESCRIPCION, :COLOR, :MARCA)";

    $resultado=$conexion->prepare($sql);
    $resultado->execute(array( ":CODIGOBARRAS"=>$_POST["codigobarras"],":DESCRIPCION"=>$_POST["descripcion"],":COLOR"=>$_POST["color"],
    ":MARCA"=>$_POST["marca"]));
    $mensaje = "Registrado Ok";
}
?>
    <div class="contenido_formulario">
        <div>
            <h2>Registro de Material</h2>
        </div>
        <div>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <table class="table_formulario">
                    <tr>
                        <td>Código Material</td>
                        <td><input type="text" name="codigobarras"></td>
                    </tr>
                    <tr>
                        <td>Descripción</td>
                        <td><input type="text" name="descripcion" ></td>
                    </tr>
                    <tr>
                        <td>Color</td>
                        <td><input type="text" name="color" ></td>
                    </tr>
                    <tr>
                        <td>Marca</td>
                        <td><input type="text" name="marca" ></td>
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