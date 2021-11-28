<?PHP include("../principal/arriba.php"); 

if(isset($_POST["entrar"])){

    $usuario = $conexion->query("select * FROM usuarios WHERE USUARIO='{$_POST["usuario"]}' AND CONTRASEÑA='{$_POST["contraseña"]}'")->fetch(PDO::FETCH_OBJ);

    if (isset($usuario) && isset($usuario->USUARIO)) {
        $_SESSION['usuario']=$usuario->USUARIO;
        $_SESSION['ID_ROL']=$usuario->ID_ROL;
        $_SESSION['ID']=$usuario->ID;
        echo "<meta http-equiv='refresh' content='0;url=../'/>";
    }else{
        $mensaje = "Las credenciales no son validas";
    }


} elseif(isset($_GET["cerrar"])=="si"){
    // remover todas las variables
    session_unset();
    // destruir la sesión
    session_destroy();
    echo "<meta http-equiv='refresh' content='0;url=../'/>";
}

?>
    <div>
        <div>
            <h3>Inicie Sessión, Ingrese Usuario y Contraseña</h3>
        </div>
        <div class="caja_credencial_base">
            <div class="caja_credencial">
            <div class="caja_credencial_arriba"></div>
            <div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="caja_credencial_input">Usuario<input type="text" name="usuario" required oninvalid="this.setCustomValidity('Ingresar Un Usuario')" oninput="this.setCustomValidity('')"></div>
                    <div class="caja_credencial_input">Contraseña<input type="password" name="contraseña" required oninvalid="this.setCustomValidity('Ingresar Una Contraseña')" oninput="this.setCustomValidity('')"></div>
                    <div class="caja_credencial_submit"><input type="submit" name="entrar" Value="Enviar">
                    <input type="reset" Value="Limpiar"></div>
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