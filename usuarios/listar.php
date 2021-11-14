<?php include("../principal/arriba.php");

$campos = $conexion->query("SHOW COLUMNS FROM inventarios.usuarios")->fetchAll(PDO::FETCH_OBJ);
$mensaje;

if(isset($_GET["ID"])){
    $Id=$_GET["ID"];
    $conexion->query("DELETE FROM usuarios WHERE ID='$Id'");
    $mensaje = "Elminado OK";
} elseif (isset($_POST["ID"])) {
    $arrayField = array();
    $arrayexec = array();
    $arraybindParam = array();
    foreach($campos as $campo):
        $arraybindParam[] = ":".$campo->Field;
        $arrayField[] = $campo->Field."=:".$campo->Field;
        $arrayexec[] = $_POST["$campo->Field"];
    endforeach;
    $dataSet = implode(",",($arrayField));
    $sql="UPDATE usuarios SET $dataSet WHERE ID=:ID";
    echo $sql;
    $resultado=$conexion->prepare($sql);
    foreach($arrayexec as $i=>$exec):
         echo $arraybindParam[$i] ."  ". $exec."</br>";
        $resultado->bindParam($arraybindParam[$i], $exec);
    endforeach;
    $resultado->execute();
    $mensaje = "Actualizado OK";
}

$registros = $conexion->query("select * FROM usuarios")->fetchAll(PDO::FETCH_OBJ);
?>
    <table class="tabla_lista">
        <thead class="tabla_encabezado">
        <tr>
        <?PHP foreach($campos as $campo):?>
            <th><?php echo $campo->Field; ?></th>
        <?php endforeach;?>
            <th colspan="2">Borrar/Actualizar</th>
        </tr>
        </thead>
        <tbody class="tabla_cuerpo" >
            <?PHP foreach($registros as $registro):?>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <tr class="tabla_fila">
                    <?PHP foreach($registro as $llave=>$dato):?>
                        <th>
                        <?php if($llave == "ID") { ?>
                            <?php echo $dato; $valor=$dato?>
                        <?php } elseif($llave == "ID_ROL") { ?>
                            <select name="rol" id="rol">
                                <?PHP $roles = $conexion->query("select * FROM roles")->fetchAll(PDO::FETCH_OBJ);
                                foreach($roles as $rol):?>
                                <option value="<?php echo $rol->ID?>" <?php If ($dato==$rol->ID) {echo "selected";} ?>><?php echo $rol->ROL?></option>
                                <?php endforeach;?>
                            </select>   
                        <?php } else { ?>
                            <input type="text" name="<?php echo $llave; ?>" value="<?php echo $dato; ?>">
                        <?php } ?>
                        </th>
                    <?php endforeach;?>
                    <td>
                            <input type="hidden" name="ID" id="ID" value="<?php echo $valor;?>">
                            <input type="submit" name="actualizarusuario" id="actualizarusuario" value="Actualizar">
                        </form>
                    </td>
                    <td>
                        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
                            <input type="hidden" name="ID" id="ID" value="<?php echo $valor;?>">
                            <input type="submit" name="eliminarusuario" id="eliminarusuario" value="Borrar">
                        </form>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>   
    <?php If(isset($mensaje)) {echo $mensaje;} ?>                         
<?php include("../principal/abajo.php"); ?>