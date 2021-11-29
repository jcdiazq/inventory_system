<?PHP

include("../principal/arriba.php");

if(isset($_POST["crearusuario"])){
    $sql="INSERT INTO usuarios
    (CEDULA, TIPO_DOC, NOMBRES, APELLIDOS, DIRECCION, TELEFONO1, TELEFONO2, MOVIL, USUARIO, CONTRASEÑA, ID_ROL)
    VALUES(:ide,:tipodoc,:nom,:ape,:dir,:teluno,:teldos,:movil,:usuari,:contras,:rol)";

    $resultado=$conexion->prepare($sql);
    $resultado->execute(array( ":ide"=>$_POST["numero"],":tipodoc"=>$_POST["documento"],":nom"=>$_POST["nombre"],
    ":ape"=>$_POST["apellido"],":dir"=>$_POST["direccion"],":teluno"=>$_POST["telefono1"],":teldos"=>$_POST["telefono2"],
    ":movil"=>$_POST["movil"],":usuari"=>$_POST["usuario"],":contras"=>$_POST["clave"],":rol"=>$_POST["rol"]));
    $mensaje = "Usuario Registrado Ok";

}

$registros = $conexion->query("SELECT * FROM roles")->fetchAll(PDO::FETCH_OBJ);

?>
    <div class="contenido_formulario">
        <div>
            <h2>Registo de Usuarios</h2>
        </div>
        <div>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <table class="table_formulario">
                    <tr>
                        <td>Numero de Identificación</td>
                        <td><input type="text" name="numero"></td>
                    </tr>
                    <tr>
                        <td>Tipo Documento</td>
                        <td><input type="text" name="documento" ></td>
                    </tr>
                    <tr>
                        <td>Nombres</td>
                        <td><input type="text" name="nombre" ></td>
                    </tr>
                    <tr>
                        <td>Apellidos</td>
                        <td><input type="text" name="apellido" ></td>
                    </tr>
                    <tr>
                        <td>Dirección</td>
                        <td><input type="text" name="direccion" ></td>
                    </tr>
                    <tr>
                        <td>Teléfono 1</td>
                        <td><input type="text" name="telefono1" ></td>
                    </tr>
                    <tr>
                        <td>Teléfono 2</td>
                        <td><input type="text" name="telefono2" ></td>
                    </tr>
                    <tr>
                        <td>Movil</td>
                        <td><input type="text" name="movil" ></td>
                    </tr>
                    <tr>
                        <td>Usuario</td>
                        <td><input type="text" name="usuario" ></td>
                    </tr>
                    <tr>
                        <td>Contraseña</td>
                        <td><input type="text" name="clave" ></td>
                    </tr>
                    <tr>
                        <td>Rol</td>
                        <td>
                        <select name="rol" id="rol">
                            <?PHP foreach($registros as $rol):?>
                            <option value="<?php echo $rol->ID?>"><?php echo $rol->ROL?></option>
                            <?php endforeach;?>
                        </select> 
                        </td>
                    </tr>
        </div>
        <div>
            <tr>
                <td class="boton_fomulario" colspan="2">
                    <input type="submit" name="crearusuario" id="crearusuario" value="Guardar">
                    <input type="reset" name="bot_limpiar" id="bot_limpiar" value="Limpiar">
                </td>
            </tr>
            </table>
            </form>
        </div>
    </div>
    <script><?php If(isset($mensaje)) {echo "alert('".$mensaje."');";} ?></script>
<?php include("../principal/abajo.php"); ?>