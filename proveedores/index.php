<?PHP

include("../principal/arriba.php");

if(isset($_POST["crear"])){
    $sql="INSERT INTO proveedores
    (DV, TIPO_DOC, NOMBRE, RAZON_SOCIAL, DIRECCION, DEPARTAMENTO, CIUDAD, TELEFONO1, TELEFONO2, MOVIL, EMAIL, ID_USUARIO)
    VALUES(:DV,:TIPO_DOC,:NOMBRE,:RAZON_SOCIAL,:DIRECCION,:DEPARTAMENTO,:CIUDAD,:TELEFONO1,:TELEFONO2,:MOVIL,:EMAIL, :ID_USUARIO)";

    $resultado=$conexion->prepare($sql);
    $resultado->execute(array( ":DV"=>$_POST["DV"],":TIPO_DOC"=>$_POST["TIPO_DOC"],":NOMBRE"=>$_POST["NOMBRE"],
    ":RAZON_SOCIAL"=>$_POST["RAZON_SOCIAL"],":DIRECCION"=>$_POST["DIRECCION"],":DEPARTAMENTO"=>$_POST["DEPARTAMENTO"],":CIUDAD"=>$_POST["CIUDAD"],
    ":TELEFONO1"=>$_POST["TELEFONO1"],":TELEFONO2"=>$_POST["TELEFONO2"],":MOVIL"=>$_POST["MOVIL"],":EMAIL"=>$_POST["EMAIL"],
    ":ID_USUARIO"=>$_POST["ID_USUARIO"]));
    $mensaje = "Registrado Ok";
}

$usuarios = $conexion->query("SELECT * FROM usuarios")->fetchAll(PDO::FETCH_OBJ);

?>
    <div class="contenido_formulario">
        <div>
            <h2>Registro de Proveedor</h2>
        </div>
        <div>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <table class="table_formulario">
                    <tr>
                        <td>Código DV</td>
                        <td><input type="number" name="DV" min="0"></td>
                    </tr>
                    <tr>
                        <td>Tipo Documento</td>
                        <td>
                        <select name="TIPO_DOC">
                            <option value="CC">Cédula</option>
                            <option value="NIT">NIT</option>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td><input type="text" name="NOMBRE" ></td>
                    </tr>
                    <tr>
                        <td>Razón Social</td>
                        <td><input type="text" name="RAZON_SOCIAL" ></td>
                    </tr>
                    <tr>
                        <td>Direccion</td>
                        <td><input type="text" name="DIRECCION" ></td>
                    </tr>
                    <tr>
                        <td>Departamento</td>
                        <td><input type="text" name="DEPARTAMENTO" ></td>
                    </tr>
                    <tr>
                        <td>Ciudad</td>
                        <td><input type="text" name="CIUDAD" ></td>
                    </tr>
                    <tr>
                        <td>Telefono 1</td>
                        <td><input type="text" name="TELEFONO1"></td>
                    </tr>
                    <tr>
                        <td>Telefono 2</td>
                        <td><input type="text" name="TELEFONO2"></td>
                    </tr>
                    <tr>
                        <td>Movil</td>
                        <td><input type="text" name="MOVIL"></td>
                    </tr>
                    <tr>
                        <td>Correo</td>
                        <td><input type="email" name="EMAIL"></td>
                    </tr>
                    <tr>
                        <td>Seleccione Un Usuario</td>
                        <td>
                        <select name="ID_USUARIO" style="width: 300px;">
                            <?PHP foreach($usuarios as $usuario):?>
                            <option value="<?php echo $usuario->ID?>"><?php echo $usuario->NOMBRES?></option>
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