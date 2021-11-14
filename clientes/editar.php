<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link rel="stylesheet" type="text/css" href="hoja.css">
</head>

<body>

<h1>ACTUALIZAR</h1>

<?php

use function PHPSTORM_META\sql_injection_subst;

include("../conexion.php");
  if(!isset($_POST ["bot_actualizar"])){

  $Id=$_GET["Id"];
  $Dv=$_GET["Dv"];
  $Tipo=$_GET["Tipo"];
  $Nom=$_GET["Nom"];
  $Razon=$_GET["Razon"];
  $Depto=$_GET  ["Depto"];
  $Ciud=$_GET["Ciud"];
  $Dir=$_GET["Dir"];
  $Telu=$_GET["Telu"];
  $Teld=$_GET["Teld"];
  $Mov=$_GET["Mov"];
  $Idus=$_GET["Idus"];
}else{
  $Id=$_POST["Id"];
  $Dv=$_POST["Dv"];
  $Tipo= $_POST["Tipo"]; 
  $Nom= $_POST["Nom"]; 
  $Razon= $_POST["Razon"]; 
  $Depto= $_POST["Depto"]; 
  $Ciud= $_POST["Ciud"]; 
  $Dir= $_POST["Dir"]; 
  $Telu= $_POST["Telu"]; 
  $Teld= $_POST["Teld"]; 
  $Mov= $_POST["Mov"];
  $Idus= $_POST["Idus"];
  $sql="UPDATE clientes SET DV=:miDV,TIPO_DOC=:miTIPD,NOMBRE=:miNOMB, RAZON_SOCIAL=:miRAZ,DEPARTAMENTO=:miDPT,CIUDAD=:miCIU, DIRECCION=:miDIRE,TELEFONO1=:miTELUN,TELEFONO2=:miTELDO,MOVIL=:miMOVI,ID_USUARIO=:miUSUR WHERE Id=:miID";
  $resultado=$base ->prepare($sql);
  $resultado->execute(array(":miID"=>$Id,":miDV"=>$Dv,":miTIPD"=> $Tipo,":miNOMB"=>$Nom,":miRAZ"=>$Razon,":miDPT"=>$Depto,":miCIU"=>$Ciud,":miDIRE"=>$Dir,":miTELUN"=>$Telu,":miTELDO"=>$Teld,":miMOVI"=>$mvil,":miUSUR"=> $Idus));
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
      <input type="text" name="Id" id="id" value="<?php echo $Id ?>">
    </tr>

    <tr>
      <td>DV</td>
      <td><label for="dv"></label>
      <input type="number" name="Dv" id="dv" value="<?php echo $Dv ?>"></td>
    </tr>

    <tr>
      <td>TIPO_DOC</td>
      <td><label for="Tdoc"></label>
      <input type="text" name="Tipo" id="Tdoc" value="<?php echo $Tipo ?>"></td>
    </tr>

    <tr>
      <td>NOMBRE</td>
      <td><label for="Nomb"></label>
      <input type="text" name="Nom" id="Nomb" value="<?php echo $Nom ?>"></td>
    </tr>
    <tr>
      <td>RAZON_SOCIAL</td>
      <td><label for="Rsoci"></label>
      <input type="text" name="Razon" id="Rsoci" value="<?php echo $Razon ?>"></td>
    </tr>
    <tr>
      <td>DEPARTAMENTO</td>
      <td><label for="Dpt"></label>
      <input type="text" name="Depto" id="Dpt" value="<?php echo $Depto ?>"></td>
    </tr>
    <tr>
      <td>CIUDAD</td>
      <td><label for="Ciu"></label>
      <input type="text" name="Ciud" id="Ciu" value="<?php echo $Ciud?>"></td>
    </tr>

    <tr>
      <td>DIRECCION</td>
      <td><label for="Dire"></label>
      <input type="text" name="Dir" id="Dire" value="<?php echo $Dir ?>"></td>
    </tr>


    <tr>
      <td>TELEFONO1</td>
      <td><label for="tuno"></label>
      <input type="phone" name="Telu" id="tuno" value="<?php echo $Telu ?>"></td>
    </tr>
    <tr>
      <td>TELEFONO2</td>
      <td><label for="tdos"></label>
      <input type="phone" name="Teld" id="tdos" value="<?php echo $Teld ?>"></td>
    </tr>
    <tr>
      <td>MOVIL</td>
      <td><label for="mvil"></label>
      <input type="phone" name="Mov" id="mvil" value="<?php echo $Mov ?>"></td>
    </tr>
    <tr>
      <td>ID_USUARIO</td>
      <td><label for="idu"></label>
      <input type="text" name="Idus" id="idu" value="<?php echo $Idus ?>"></td>
    </tr>


    <tr>
      <td colspan="2"><input type="submit" name="bot_actualizar" id="bot_actualizar" value="Actualizar"></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>