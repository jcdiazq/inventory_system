<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Lista de Usuarios</title>
<link rel="stylesheet" type="text/css" href="estiiilo.css">
</head>

<body>

<h1>ACTUALIZAR</h1>

<?php

use function PHPSTORM_META\sql_injection_subst;

include("conexion.php");
  if(!isset($_POST ["bot_actualizar"])){

  $Id=$_GET["Id"];
  $tipo=$_GET["tipo"];
  $nom=$_GET["nom"];
  $ape=$_GET["ape"];
  $dir=$_GET["dir"];
  $teleuno=$_GET  ["teleuno"];
  $teledos=$_GET["teledos"];
  $mov=$_GET["mov"];
  $usua=$_GET["usua"];
  $cont=$_GET["cont"];
  $rol=$_GET["rol"];
}else{
  $Id=$_POST["Id"];
  $tipo=$_POST["tipo"];
  $nom= $_POST["nom"]; 
  $ape= $_POST["ape"]; 
  $dir= $_POST["dir"]; 
  $teleuno= $_POST["teleuno"]; 
  $teledos= $_POST["teledos"]; 
  $mov= $_POST["mov"]; 
  $usua= $_POST["usua"]; 
  $cont= $_POST["cont"]; 
  $rol= $_POST["rol"];  
  $sql="UPDATE usuarios SET TIPO_DOC=:miTIPO,NOMBRES=:miNOM, APELLIDOS=:miAPE, DIRECCION=:miDIR,TELEFONO1=:miTELU,TELEFONO2=:miTELD,MOVIL=:miMOV,USUARIO=:miUSU,CONTRASEÑA=:miCONT,ID_ROL=:miROL WHERE Id=:miID";
  $resultado=$base ->prepare($sql);
  $resultado->execute(array(":miID"=>$Id,":miTIPO"=>$tipo,":miNOM"=>$nom,":miAPE"=>$ape,":miDIR"=>$dir,":miTELU"=>$teleuno,":miTELD"=>$teledos,":miMOV"=>$mov,":miUSU"=>$usua,":miCONT"=>$cont,":miROL"=>$rol));
  header("location:index.php");
}


?>

<p>
 
</p>
<p>&nbsp;</p>
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">;
  <table width="25%" border="0" align="center">
    <tr>
      <td>ID</td>
      <td><label for="id"></label>
      <input type="hidden" name="Id" id="id" value="<?php echo $Id ?>" ></td>
    </tr>
    <tr>
      <td>TIPO_DOC</td>
      <td><label for="Tipodoc"></label>
      <input type="text" name="tipo" id="Tipodoc" value="<?php echo $tipo?>" ></td>
    </tr>
    <tr>
      <td>NOMBRES</td>
      <td><label for="Nom"></label>
      <input type="text" name="nom" id="Nom" value="<?php echo $nom?>" ></td>
    </tr>
    <tr>
      <td>APELLIDOS</td>
      <td><label for="Ape"></label>
      <input type="text" name="ape" id="Ape" value="<?php echo $ape ?>" ></td>
    </tr>
    <tr>
      <td>DIRECCION</td>
      <td><label for="Dir"></label>
      <input type="text" name="dir" id="Dir" value="<?php echo $dir ?>" ></td>
    </tr>
    <tr>
      <td>TELEFONO1</td>
      <td><label for="Teluno"></label>
      <input type="phone" name="teleuno" id="Teluno" value="<?php echo $teleuno ?>" ></td>
    </tr>
    <tr>
      <td>TELEFONO2</td>
      <td><label for="Teldos"></label>
    <input type="phone" name="teledos" id="Teldos" value="<?php echo $teledos?>"></td>
    </tr>
    <tr>
      <td>MOVIL</td>
      <td><label for="Movil"></label>
      <input type="phone" name="mov" id="Movil" value="<?php echo $mov?>"></td>
    </tr>
    <tr>
      <td>USUARIO</td>
      <td><label for="Usuari"></label>
      <input type="text" name="usua" id="Usuari" value="<?php echo $usua?>"></td>
    </tr>
    <tr>
      <td>CONTRASEÑA</td>
      <td><label for="Contra"></label>
      <input type="password" name="cont" id="Contra" value="<?php echo $cont?>" ></td>
    </tr>
    <tr>
      <td>ID_ROL</td>
      <td><label for="Rol"></label>
      <input type="text" name="rol" id="Rol" value="<?php echo $rol ?>"></td>
    </tr>
    
      <td colspan="2"><input type="submit" name="bot_actualizar" id="bot_actualizar" value="Actualizar"></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
