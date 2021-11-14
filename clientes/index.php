<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Lista de Clientes</title>
<link rel="stylesheet" type="text/css" href="hoja.css">


</head>

<body>
<?PHP
include("../conexion.php");
$registros=$base->query("SELECT * FROM clientes")->fetchAll(PDO::FETCH_OBJ);
if(isset($_POST["cr"])){

$Id=$_POST["Id"];
$Dv=$_POST["Dv"];
$Tipo=$_POST["Tipo"];  
$Nom=$_POST["Nom"];
$Razon=$_POST["Razon"];
$Depto=$_POST["Depto"];
$Ciud=$_POST["Ciud"];
$Dir=$_POST["Dir"];
$Telu=$_POST["Telu"];  
$Teld=$_POST["Teld"];
$Mov=$_POST["Mov"];
$Idus=$_POST["Idus"];
$sql="INSERT INTO clientes (ID,DV,TIPO_DOC,NOMBRE, RAZON_SOCIAL,DEPARTAMENTO,CIUDAD,DIRECCION,TELEFONO1,TELEFONO2,MOVIL,ID_USUARIO)VALUES(:Id,:Dv,:Tipo,:Nom,:Razon,:Depto,:Ciud,:Dir,:Telu,:Teld,:Mov,:Idus)";

$resultado=$base-> prepare($sql);
$resultado-> execute(array(":Id"=>$Id,":Dv"=>$Dv,":Tipo"=>$Tipo,":Nom"=>$Nom,":Razon"=>$Razon,":Depto"=>$Depto,":Ciud"=>$Ciud,":Dir"=>$Dir,":Telu"=>$Telu,":Teld"=>$Teld,":Mov"=>$Mov,":Idus"=>$Idus));
header("location:index.php");

}

?>

<h1>Lista de Clientes</h1>
<form action="<?php echo $_SERVER ['PHP_SELF']; ?>" method="post">
  <table width="80%" border="0" align="center">
    <tr >
      <td class="primera_fila">ID</td>
      <td class="primera_fila">DV</td>
      <td class="primera_fila">TIPO_DOC</td>
      <td class="primera_fila">NOMBRE</td>
      <td class="primera_fila">RAZON_SOCIAL</td>
      <td class="primera_fila">DEPARTAMENTO</td>
      <td class="primera_fila">CIUDAD</td>
      <td class="primera_fila">DIRECCION</td>
      <td class="primera_fila">TELEFONO1</td>
      <td class="primera_fila">TELEFONO2</td>
      <td class="primera_fila">MOVIL</td>
      <td class="primera_fila">ID_USUARIO</td>
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
      <td class="sin">&nbsp;</td>      
    </tr> 

    <?php
        foreach($registros as $clie):?>
		
   	<tr>
      <td><?php echo $clie->ID?></td>
      <td><?php echo $clie->DV?></td>
      <td><?php echo $clie->TIPO_DOC?></td>
      <td><?php echo $clie->NOMBRE?></td>
      <td><?php echo $clie->RAZON_SOCIAL?></td>
      <td><?php echo $clie->DEPARTAMENTO?></td>
      <td><?php echo $clie->CIUDAD?></td>
      <td><?php echo $clie->DIRECCION?></td>
      <td><?php echo $clie->TELEFONO1?></td>
      <td><?php echo $clie->TELEFONO2?></td>
      <td><?php echo $clie->MOVIL?></td>
      <td><?php echo $clie->ID_USUARIO?></td>      
 
     <td class="bot"><a href="borrar.php?Id=<?php echo $clie->ID?>"><input type='button' name='del' id='del' value='Borrar'></a></td>

      <td class='bot'><a href="editar.php?Id=<?php echo $clie->ID?> 
      & Dv=<?php echo $clie->DV?> 
      & Tipo=<?php echo $clie->TIPO_DOC?> 
      & Nom=<?php echo $clie->NOMBRE?> 
      & Razon=<?php echo $clie->RAZON_SOCIAL?> 
      & Depto=<?php echo $clie->DEPARTAMENTO?>
      & Ciud=<?php echo $clie->CIUDAD?> 
      & Dir=<?php echo $clie->DIRECCION?> 
      & Telu=<?php echo $clie->TELEFONO1?> 
      & Teld=<?php echo $clie->TELEFONO2?> 
      & Mov=<?php echo $clie->MOVIL?> 
      & Idus=<?php echo $clie->ID_USUARIO?>"><input type='button' name='up' id='up' value='Actualizar'></a></td>
    </tr>     
    <?php
      endforeach;

    ?>
    

	<tr>
	  <td><input type='text' name='Id' class='centrado'></td>
      <td><input type='text' name='Dv' class='centrado'></td>
      <td><input type='text' name='Tipo' class='centrado'></td>
      <td><input type='text' name='Nom' class='centrado'></td>
      <td><input type='text' name='Razon' class='centrado'></td>
      <td><input type='text' name='Depto' class='centrado'></td>
      <td><input type='text' name='Ciud' class='centrado'></td>
      <td><input type='text' name='Dir' class='centrado'></td>
      <td><input type='phone' name='Telu' class='centrado'></td>
      <td><input type='phone' name='Teld' class='centrado'></td>
      <td><input type='phone' name='Mov' class='centrado'></td>
      <td><input type='text' name='Idus' class='centrado'></td>
      <td class='bot'><input type='submit' name='cr' id='cr' value='Insertar'></td></tr>    
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>