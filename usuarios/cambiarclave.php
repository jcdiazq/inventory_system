<?PHP include("../principal/arriba.php"); 

if(isset($_POST["cambiar"])){
    if($_POST["usuario"] == $_POST["contraseña"]) {
        $sql = "UPDATE usuarios SET CONTRASEÑA='{$_POST["contraseña"]}' WHERE ID='{$_POST["ID"]}'";
        $resultado = $conexion->prepare($sql);
        $resultado->execute();
        $mensaje = "Actualizado OK";
    } else {
        $mensaje = "Las claves no son iguales, Intente de nuevo";
    }
}

?>
    <div>
        <div>
            <h3>Cambio de Contraseña</h3>
        </div>
        <div class="caja_credencial_base">
            <div class="caja_credencial">
            <div class="caja_credencial_arriba"></div>
            <div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="hidden" name="ID" value="<?php echo $_SESSION['ID']; ?>">
                    <div class="caja_credencial_input">Nueva Contraseña<input type="password" name="usuario" oninvalid="this.setCustomValidity('Ingresar Una Nueva Contraseña')" oninput="this.setCustomValidity('')" required></div>
                    <div class="caja_credencial_input">Confirmar Contraseña<input type="password" name="contraseña" oninvalid="this.setCustomValidity('Ingresar Una Contraseña a Confirmar')" oninput="this.setCustomValidity('')" required></div>
                    <div class="caja_credencial_submit"><input type="reset" Value="Cancelar">
                    <input type="submit" name="cambiar" Value="Aceptar"></div>
                </form>
            </div>
            </div>
        </div>
    </div>
    <script>
    <?php if (isset($mensaje)) {
        echo "alert('" . $mensaje . "');";
    } ?>
</script>
<?php include("../principal/abajo.php"); ?>