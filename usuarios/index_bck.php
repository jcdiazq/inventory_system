<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Lista de Usuarios</title>
<link rel="stylesheet" type="text/css" href="estiiilo.css">


</head>

<body>
<?PHP
include("../conexion.php");
/*$conexion=$base->query("SELECT * FROM usuarios");
$registros=$conexion->fetchAll(PDO::FETCH_OBJ);*/
$registros=$base->query("SELECT * FROM usuarios")->fetchAll(PDO::FETCH_OBJ);
if(isset($_POST["cr"])){

$ide=$_POST["ide"];
$tipodoc=$_POST["tipodoc"];
$nom=$_POST["nom"];  
$ape=$_POST["ape"];
$dir=$_POST["dir"];
$teluno=$_POST["teluno"];
$teldos=$_POST["teldos"];
$movil=$_POST["movil"];
$usuari=$_POST["usuari"];  
$contras=$_POST["contras"];
$rol=$_POST["rol"];

$sql="INSERT INTO usuarios (ID,TIPO_DOC,NOMBRES, APELLIDOS,DIRECCION,TELEFONO1,TELEFONO2,MOVIL,USUARIO,CONTRASEÑA,ID_ROL)VALUES(:ide,:tipodoc,:nom,:ape,:dir,:teluno,:teldos,:movil,:usuari,:contras,:rol)";

$resultado=$base-> prepare($sql);
$resultado-> execute(array( ":ide"=>$ide,":tipodoc"=>$tipodoc,":nom"=>$nom,":ape"=>$ape,":dir"=>$dir,":teluno"=>$teluno,":teldos"=>$teldos,":movil"=>$movil,":usuari"=>$usuari,":contras"=>$contras,":rol"=>$rol));
header("location:index.php");

}

?>

<h1>Lista de Usuarios</h1>
<form action="<?php echo $_SERVER ['PHP_SELF']; ?>" method="post">
  <table width="80%" border="0" align="center">
    <tr >
      <td class="primera_fila">ID</td>
      <td class="primera_fila">TIPO_DOC</td>
      <td class="primera_fila">NOMBRES</td>
      <td class="primera_fila">APELLIDOS</td>
      <td class="primera_fila">DIRECCION</td>
      <td class="primera_fila">TELEFONO1</td>
      <td class="primera_fila">TELEFONO2</td>
      <td class="primera_fila">MOVIL</td>
      <td class="primera_fila">USUARIO</td>
      <td class="primera_fila">CONTRASEÑA</td>
      <td class="primera_fila">ID_ROL</td>
      <td class="sin">&nbsp;</td>
      <td class="sin">&nbsp;</td>
      <td class="sin">&nbsp;</td>
      <td class="sin">&nbsp;</td>
      <td class="sin">&nbsp;</td>
      <td class="sin">&nbsp;</td>      
      <td class="sin">&nbsp;</td>
      <td class="sin">&nbsp;</td>
      <td class="sin">&nbsp;</td>      
      <td class="sin">&nbsp;</td>
      <td class="sin">&nbsp;</td>
    </tr> 
   
		<?PHP
        foreach($registros as $usuar):?>

   	<tr>
      <td><?php echo $usuar->ID?></td>
      <td><?php echo $usuar->TIPO_DOC?></td>
      <td><?php echo $usuar->NOMBRES?></td>
      <td><?php echo $usuar->APELLIDOS?></td>
      <td><?php echo $usuar->DIRECCION?></td>
      <td><?php echo $usuar->TELEFONO1?></td>
      <td><?php echo $usuar->TELEFONO2?></td>
      <td><?php echo $usuar->MOVIL?></td>
      <td><?php echo $usuar->USUARIO?></td>
      <td><?php echo $usuar->CONTRASEÑA?></td>
      <td><?php echo $usuar->ID_ROL?></td>

      <td class="bot"><a href="borrar.php?Id=<?php echo $usuar->ID?>"> <input type='button' name='del' id='del' value='Borrar'></a></td>

      <td class='bot'><a href="editar.php?Id=<?php echo $usuar ->ID?> 
      & tipo=<?php echo $usuar->TIPO_DOC?> & nom=<?php echo $usuar->NOMBRES?> & ape=<?php echo $usuar->APELLIDOS?> 
       & dir=<?php echo $usuar->DIRECCION?> 
       & teleuno=<?php echo $usuar->TELEFONO1?>
       & teledos=<?php echo $usuar->TELEFONO2?> 
       & mov=<?php echo $usuar->MOVIL?> 
       & usua=<?php echo $usuar->USUARIO?> 
       & cont=<?php echo $usuar->CONTRASEÑA?> 
       & rol=<?php echo $usuar->ID_ROL?>"> <input type='button' name='up' id='up' value='Actualizar'></a></td>

    </tr> 
<?php
endforeach;

?>
    
    
	<tr>
	<td><input type='text' name='ide'  class='centrado'></td>
      
     
      <td><input type='text' name='tipodoc'  class='centrado'></td>
      <td><input type='text' name='nom'  class='centrado'></td>
      <td><input type='text' name='ape'  class='centrado'></td>
      <td><input type='text' name='dir'  class='centrado'></td>
      <td><input type='phone' name='teluno'  class='centrado'></td>
      <td><input type='phone' name='teldos'  class='centrado'></td>
      <td><input type='phone' name='movil'  class='centrado'></td>
      <td><input type='text' name='usuari'  class='centrado'></td>
      <td><input type='password' name='contras'  class='centrado'></td>
      <td><input type='text' name='rol'  class='centrado'></td>
      <td class='bot'><input type='submit' name='cr' id='cr' value='Insertar'></td></tr>    
  </table>
  </form>
<p>&nbsp;</p>
</body>
</html>