<?PHP

include("../principal/arriba.php");

if(isset($_POST["crear"])){
    $sql="INSERT INTO inventarios.roles (ID, ROL) VALUES (:ID,:ROL)";

    $resultado=$conexion->prepare($sql);
    $resultado->execute(array( ":ID"=>$_POST["ID"],":ROL"=>$_POST["ROL"]));
    $mensaje = "Registrado Ok";
}

?>
    <div class="contenido_formulario">
        <div>
            <h2>Registro de Roles</h2>
        </div>
        <div>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <table class="table_formulario">
                    <tr>
                        <td>ID del Rol</td>
                        <td><input type="number" name="ID"></td>
                    </tr>
                    <tr>
                        <td>Nombre del Rol</td>
                        <td><input type="text" name="ROL" ></td>
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