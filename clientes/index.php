<?PHP

include("../principal/arriba.php");

if(isset($_POST["crearcliente"])){
    $sql="INSERT INTO clientes
    (ID, DV, TIPO_DOC, NOMBRE, RAZON_SOCIAL, DEPARTAMENTO, CIUDAD, DIRECCION, TELEFONO1, TELEFONO2, MOVIL, ID_USUARIO)
    VALUES(:ID, :DV, :TIPO_DOC, :NOMBRE, :RAZON_SOCIAL, :DEPARTAMENTO, :CIUDAD, :DIRECCION, :TELEFONO1, :TELEFONO2, :MOVIL, :ID_USUARIO)";

    $resultado=$conexion->prepare($sql);
    $resultado->execute(array(":ID"=>$_POST["codigo"], ":DV"=>$_POST["numero"], ":TIPO_DOC"=>$_POST["documento"], ":NOMBRE"=>$_POST["nombre"],
     ":RAZON_SOCIAL"=>$_POST["social"], ":DEPARTAMENTO"=>$_POST["departamento"], ":CIUDAD"=>$_POST["ciudad"], ":DIRECCION"=>$_POST["direccion"],
     ":TELEFONO1"=>$_POST["telefono1"], ":TELEFONO2"=>$_POST["telefono2"], ":MOVIL"=>$_POST["movil"], ":ID_USUARIO"=>$_POST["id_usuario"]));
    $mensaje = "Cliente Registrado Ok";

}

$registros = $conexion->query("SELECT * FROM usuarios")->fetchAll(PDO::FETCH_OBJ);

?>
    <div class="contenido_formulario">
        <div>
            <h2>Registo de Clientes</h2>
        </div>
        <div>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <table class="table_formulario">
                    <tr>
                        <td>Código</td>
                        <td><input type="text" name="codigo"></td>
                    </tr>
                    <tr>
                        <td>Numero DV</td>
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
                        <td>Razón Social</td>
                        <td><input type="text" name="social" ></td>
                    </tr>
                    <tr>
                        <td>Departamento</td>
                        <td><input type="text" name="departamento" ></td>
                    </tr>
                    <tr>
                        <td>Ciudad</td>
                        <td><input type="text" name="ciudad" ></td>
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
                        <td>ID Usuario</td>
                        <td>
                        <select name="id_usuario" id="id_usuario">
                            <?PHP foreach($registros as $usuario):?>
                                <option value="<?php echo $usuario->ID?>"><?php echo $usuario->USUARIO?></option>
                            <?php endforeach;?>
                        </select> 
                        </td>
                    </tr>
        </div>
        <div>
            <tr>
                <td class="boton_fomulario" colspan="2">
                    <input type="submit" name="crearcliente" id="crearcliente" value="Guardar">
                    <input type="reset" name="bot_limpiar" id="bot_limpiar" value="Limpiar">
                </td>
            </tr>
            </table>
            </form>
        </div>
    </div>
    <script><?php If(isset($mensaje)) {echo "alert('".$mensaje."');";} ?></script>
<?php include("../principal/abajo.php"); ?>